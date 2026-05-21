from __future__ import annotations

import json
import shutil
import tempfile
from pathlib import Path

import tensorflow as tf
import tf_keras

from export_session10_capstone_tfjs import build_tfjs_artifacts_from_h5


ROOT = Path(__file__).resolve().parents[1]
PROJECT_ROOT = ROOT / "Projects" / "Deep Learning Specialization" / "Automating Port Operations"
MODEL_ROOT = PROJECT_ROOT / "outputs" / "models" / "transfer_learning"
SOURCE_KERAS_PATH = MODEL_ROOT / "transfer_learning_model.keras"
SOURCE_METADATA_PATH = MODEL_ROOT / "metadata.json"
LOCAL_TFJS_DIR = MODEL_ROOT / "tfjs"
PUBLIC_TFJS_DIR = ROOT / "web" / "public" / "assets" / "models" / "automating-port-operations-transfer"
IMAGE_SIZE = (224, 224)


def build_export_model(num_classes: int) -> tf_keras.Model:
    base_model = tf_keras.applications.MobileNetV2(
        include_top=False,
        weights=None,
        input_shape=(IMAGE_SIZE[0], IMAGE_SIZE[1], 3),
    )
    base_model.trainable = False

    model = tf_keras.Sequential(
        [
            tf_keras.layers.Input(shape=(IMAGE_SIZE[0], IMAGE_SIZE[1], 3), name="transfer_input"),
            base_model,
            tf_keras.layers.GlobalAveragePooling2D(name="transfer_global_average_pooling"),
            tf_keras.layers.Dropout(0.2, name="transfer_dropout_1"),
            tf_keras.layers.Dense(256, activation="relu", name="transfer_dense_256"),
            tf_keras.layers.BatchNormalization(name="transfer_batch_norm_1"),
            tf_keras.layers.Dropout(0.1, name="transfer_dropout_2"),
            tf_keras.layers.Dense(128, activation="relu", name="transfer_dense_128"),
            tf_keras.layers.BatchNormalization(name="transfer_batch_norm_2"),
            tf_keras.layers.Dropout(0.1, name="transfer_dropout_3"),
            tf_keras.layers.Dense(num_classes, activation="softmax", name="transfer_output"),
        ],
        name="mobilenetv2_transfer_classifier",
    )
    model(tf.zeros((1, IMAGE_SIZE[0], IMAGE_SIZE[1], 3), dtype=tf.float32))
    return model


def main() -> None:
    if not SOURCE_KERAS_PATH.exists():
        raise FileNotFoundError(f"Missing saved Keras model: {SOURCE_KERAS_PATH}")
    if not SOURCE_METADATA_PATH.exists():
        raise FileNotFoundError(f"Missing metadata file: {SOURCE_METADATA_PATH}")

    metadata = json.loads(SOURCE_METADATA_PATH.read_text(encoding="utf-8"))
    labels = metadata.get("labels", [])
    if not labels:
        raise ValueError("Metadata file does not contain any labels.")

    source_model = tf.keras.models.load_model(SOURCE_KERAS_PATH, compile=False)
    export_model = build_export_model(num_classes=len(labels))
    export_model.set_weights(source_model.get_weights())

    if LOCAL_TFJS_DIR.exists():
        shutil.rmtree(LOCAL_TFJS_DIR)
    LOCAL_TFJS_DIR.mkdir(parents=True, exist_ok=True)

    with tempfile.NamedTemporaryFile(suffix=".h5", delete=False) as temp_handle:
        temp_h5_path = Path(temp_handle.name)

    try:
        export_model.save(temp_h5_path)
        build_tfjs_artifacts_from_h5(temp_h5_path, LOCAL_TFJS_DIR, metadata)
    finally:
        if temp_h5_path.exists():
            temp_h5_path.unlink()

    (LOCAL_TFJS_DIR / "metadata.json").write_text(json.dumps(metadata, indent=2), encoding="utf-8")

    if PUBLIC_TFJS_DIR.exists():
        shutil.rmtree(PUBLIC_TFJS_DIR)
    shutil.copytree(LOCAL_TFJS_DIR, PUBLIC_TFJS_DIR)
    (PUBLIC_TFJS_DIR / "metadata.json").write_text(json.dumps(metadata, indent=2), encoding="utf-8")

    print(f"Exported legacy TFJS layers model to: {LOCAL_TFJS_DIR}")
    print(f"Published legacy TFJS layers model to: {PUBLIC_TFJS_DIR}")
    print(f"Labels: {', '.join(labels)}")


if __name__ == "__main__":
    main()