from __future__ import annotations

import json
import os
import tempfile
from pathlib import Path

import h5py
import numpy as np
import tensorflow as tf
import tf_keras


ROOT = Path(__file__).resolve().parents[1]
CAPSTONE_ROOT = ROOT / "Incremental Capstones" / "Deep Learning Specialization" / "Capstone Session 10"
OUTPUTS_DIR = CAPSTONE_ROOT / "outputs"
GENERATED_SPLIT_DIR = OUTPUTS_DIR / "generated_split"
MODEL_OUTPUT_DIR = ROOT / "web" / "public" / "assets" / "models" / "session-10-capstone-resnet50"
SUMMARY_PATH = OUTPUTS_DIR / "session_10_capstone_tfjs_export.json"
IMAGE_SIZE = (128, 128)
BATCH_SIZE = 16
EPOCHS = 25


def as_text(value: bytes | str, encoding: str = "utf-8") -> str:
    if isinstance(value, str):
        return value
    if isinstance(value, bytes):
        return value.decode(encoding)
    raise TypeError(f"Expected bytes or str, got {type(value)!r}")


def normalize_weight_name(weight_name: str) -> str:
    return weight_name[:-2] if weight_name.endswith(":0") else weight_name


def ensure_json_dict(item: dict[str, object] | bytes | str) -> dict[str, object]:
    return item if isinstance(item, dict) else json.loads(as_text(item))


def convert_h5_group(group: h5py.Group) -> list[dict[str, object]]:
    group_out: list[dict[str, object]] = []
    if "weight_names" in group.attrs:
        names = [as_text(name) for name in group.attrs["weight_names"].tolist()]
        for weight_name in names:
            weight_value = np.array(group[weight_name])
            group_out.append({
                "name": normalize_weight_name(weight_name),
                "data": weight_value,
            })
        return group_out

    for key in group.keys():
        group_out.extend(convert_h5_group(group[key]))
    return group_out


def build_tfjs_artifacts_from_h5(h5_path: Path, output_dir: Path, metadata: dict[str, object]) -> None:
    with h5py.File(h5_path, "r") as h5_file:
        topology = {
            "keras_version": as_text(h5_file.attrs["keras_version"]),
            "backend": as_text(h5_file.attrs["backend"]),
            "model_config": ensure_json_dict(h5_file.attrs["model_config"]),
        }
        if "training_config" in h5_file.attrs:
            topology["training_config"] = ensure_json_dict(h5_file.attrs["training_config"])

        weight_groups = [convert_h5_group(h5_file["model_weights"])]

    output_dir.mkdir(parents=True, exist_ok=True)
    shard_name = "group1-shard1of1.bin"
    shard_path = output_dir / shard_name
    weights_manifest: list[dict[str, object]] = []

    with shard_path.open("wb") as handle:
        for entry in weight_groups[0]:
            array = entry["data"]
            if not isinstance(array, np.ndarray):
                continue
            handle.write(array.tobytes(order="C"))
            weights_manifest.append(
                {
                    "name": entry["name"],
                    "shape": list(array.shape),
                    "dtype": array.dtype.name,
                }
            )

    model_json = {
        "format": "layers-model",
        "generatedBy": f"keras v{topology['keras_version']}",
        "convertedBy": "Custom Session 10 export",
        "modelTopology": topology,
        "weightsManifest": [{"paths": [shard_name], "weights": weights_manifest}],
        "userDefinedMetadata": metadata,
    }

    with (output_dir / "model.json").open("w", encoding="utf-8") as handle:
        json.dump(model_json, handle)


def ensure_paths() -> None:
    if not GENERATED_SPLIT_DIR.exists():
        raise FileNotFoundError(
            "Expected generated split at "
            f"{GENERATED_SPLIT_DIR}. Run the Session 10 notebook first."
        )
    MODEL_OUTPUT_DIR.mkdir(parents=True, exist_ok=True)


def build_generators() -> tuple[tf.keras.preprocessing.image.DirectoryIterator, tf.keras.preprocessing.image.DirectoryIterator, tf.keras.preprocessing.image.DirectoryIterator]:
    train_datagen = tf.keras.preprocessing.image.ImageDataGenerator(
        rescale=1.0 / 255.0,
        validation_split=0.2,
    )
    test_datagen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1.0 / 255.0)

    train_generator = train_datagen.flow_from_directory(
        GENERATED_SPLIT_DIR / "train",
        target_size=IMAGE_SIZE,
        batch_size=BATCH_SIZE,
        class_mode="categorical",
        subset="training",
        shuffle=True,
    )
    validation_generator = train_datagen.flow_from_directory(
        GENERATED_SPLIT_DIR / "train",
        target_size=IMAGE_SIZE,
        batch_size=BATCH_SIZE,
        class_mode="categorical",
        subset="validation",
        shuffle=False,
    )
    test_generator = test_datagen.flow_from_directory(
        GENERATED_SPLIT_DIR / "test",
        target_size=IMAGE_SIZE,
        batch_size=BATCH_SIZE,
        class_mode="categorical",
        shuffle=False,
    )

    return train_generator, validation_generator, test_generator


def build_resnet50_model(
    keras_api: object = tf.keras,
    *,
    include_preprocess: bool = True,
    base_weights: str | None = "imagenet",
    num_classes: int = 2,
) -> tf.keras.Model:
    base_model = keras_api.applications.ResNet50(
        include_top=False,
        weights=base_weights,
        input_shape=(128, 128, 3),
    )
    base_model.trainable = False

    layers = [keras_api.layers.Input(shape=(128, 128, 3))]
    if include_preprocess:
        layers.append(keras_api.layers.Lambda(keras_api.applications.resnet50.preprocess_input))
    layers.extend(
        [
            base_model,
            keras_api.layers.GlobalAveragePooling2D(),
            keras_api.layers.Dropout(0.5),
            keras_api.layers.Dense(num_classes, activation="softmax"),
        ]
    )

    model = keras_api.Sequential(layers)
    model.compile(optimizer="adam", loss="categorical_crossentropy", metrics=["accuracy"])
    return model


def export_capstone_model() -> dict[str, object]:
    os.environ["TF_CPP_MIN_LOG_LEVEL"] = "2"
    tf.keras.utils.set_random_seed(42)
    np.random.seed(42)

    ensure_paths()
    train_generator, validation_generator, test_generator = build_generators()

    callbacks = [
        tf.keras.callbacks.ReduceLROnPlateau(monitor="val_loss", factor=0.5, patience=2, verbose=1),
        tf.keras.callbacks.EarlyStopping(monitor="val_loss", patience=4, restore_best_weights=True, verbose=1),
    ]

    model = build_resnet50_model()
    history = model.fit(
        train_generator,
        validation_data=validation_generator,
        epochs=EPOCHS,
        callbacks=callbacks,
        verbose=1,
    )

    test_loss, test_accuracy = model.evaluate(test_generator, verbose=0)

    class_labels = [label for label, _ in sorted(train_generator.class_indices.items(), key=lambda item: item[1])]
    metadata = {
        "modelType": "capstone-resnet50",
        "labels": class_labels,
        "imageSize": list(IMAGE_SIZE),
        "source": "Session 10 capstone TensorFlow workflow",
        "preprocessing": "resnet50_caffe_after_div255",
        "testLoss": float(test_loss),
        "testAccuracy": float(test_accuracy),
        "epochsRan": int(len(history.history.get("loss", []))),
    }

    export_model = build_resnet50_model(
        keras_api=tf_keras,
        include_preprocess=False,
        base_weights=None,
    )
    export_model.set_weights(model.get_weights())

    with tempfile.NamedTemporaryFile(suffix=".h5", delete=False) as temp_handle:
        temp_h5_path = Path(temp_handle.name)

    try:
        export_model.save(temp_h5_path)
        build_tfjs_artifacts_from_h5(temp_h5_path, MODEL_OUTPUT_DIR, metadata)
    finally:
        if temp_h5_path.exists():
            temp_h5_path.unlink()

    with (MODEL_OUTPUT_DIR / "metadata.json").open("w", encoding="utf-8") as handle:
        json.dump(metadata, handle, indent=2)

    export_summary = {
        "model": "ResNet50",
        "test_loss": float(test_loss),
        "test_accuracy": float(test_accuracy),
        "epochs_ran": int(len(history.history.get("loss", []))),
        "labels": class_labels,
        "output_dir": str(MODEL_OUTPUT_DIR),
    }
    with SUMMARY_PATH.open("w", encoding="utf-8") as handle:
        json.dump(export_summary, handle, indent=2)

    return export_summary


if __name__ == "__main__":
    summary = export_capstone_model()
    print(json.dumps(summary, indent=2))