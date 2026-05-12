from __future__ import annotations

import os
import sys
from dataclasses import dataclass
from pathlib import Path

import nbformat as nbf
from nbconvert.preprocessors import ExecutePreprocessor


ROOT = Path(__file__).resolve().parents[1]


@dataclass(frozen=True)
class CapstonePaths:
    root: Path
    notebook: Path
    outputs: Path
    plots: Path


def ensure_dirs(*paths: Path) -> None:
    for path in paths:
        path.mkdir(parents=True, exist_ok=True)


def write_and_execute_notebook(paths: CapstonePaths, notebook: nbf.NotebookNode) -> None:
    ensure_dirs(paths.outputs, paths.plots)

    notebook.metadata["kernelspec"] = {
        "display_name": "Python 3",
        "language": "python",
        "name": "python3",
    }
    notebook.metadata["language_info"] = {
        "name": "python",
        "version": f"{sys.version_info.major}.{sys.version_info.minor}.{sys.version_info.micro}",
    }

    with paths.notebook.open("w", encoding="utf-8") as handle:
        nbf.write(notebook, handle)

    executor = ExecutePreprocessor(timeout=1800, kernel_name="python3")
    executor.preprocess(notebook, {"metadata": {"path": str(paths.root)}})

    with paths.notebook.open("w", encoding="utf-8") as handle:
        nbf.write(notebook, handle)


def build_session_9_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Deep Learning Specialization" / "Capstone Session 9"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        notebook=root / "capstone_session_9.ipynb",
        outputs=outputs,
        plots=plots,
    )


def build_session_11_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Deep Learning Specialization" / "Capstone Session 11"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        notebook=root / "capstone_session_11.ipynb",
        outputs=outputs,
        plots=plots,
    )


def build_session_10_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Deep Learning Specialization" / "Capstone Session 10"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        notebook=root / "capstone_session_10.ipynb",
        outputs=outputs,
        plots=plots,
    )


def build_session_12_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Deep Learning Specialization" / "Capstone Session 12"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        notebook=root / "capstone_session_12.ipynb",
        outputs=outputs,
        plots=plots,
    )


def write_session_9_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 9\n\n"
            "This notebook is generated from the copied `Capstone_Session_9.pdf` directions and the staged `Churn_Modeling.csv` dataset."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Build the required artificial neural network for customer churn prediction, evaluate it on the held-out test set, and score the specified sample customer."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "import os\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "import tensorflow as tf\n"
            "from IPython.display import display\n"
            "from sklearn.compose import ColumnTransformer\n"
            "from sklearn.metrics import accuracy_score, confusion_matrix\n"
            "from sklearn.model_selection import train_test_split\n"
            "from sklearn.pipeline import Pipeline\n"
            "from sklearn.preprocessing import OneHotEncoder, StandardScaler\n"
            "\n"
            "os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'\n"
            "tf.keras.utils.set_random_seed(42)\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "DATASET_PATH = BASE_DIR / 'Churn_Modeling.csv'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')\n"
            "pd.set_option('display.max_columns', 100)"
        ),
        nbf.v4.new_code_cell(
            "df = pd.read_csv(DATASET_PATH)\n"
            "display(df.head())\n"
            "print('Shape:', df.shape)\n"
            "print('Target distribution:', df['Exited'].value_counts().to_dict())"
        ),
        nbf.v4.new_code_cell(
            "working_df = df.drop(columns=['RowNumber', 'CustomerId', 'Surname']).copy()\n"
            "X = working_df.drop(columns=['Exited'])\n"
            "y = working_df['Exited']\n"
            "categorical_columns = ['Geography', 'Gender']\n"
            "numeric_columns = [column for column in X.columns if column not in categorical_columns]\n"
            "\n"
            "preprocessor = ColumnTransformer([\n"
            "    ('num', StandardScaler(), numeric_columns),\n"
            "    ('cat', OneHotEncoder(handle_unknown='ignore', sparse_output=False), categorical_columns),\n"
            "])\n"
            "\n"
            "X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=0, stratify=y)\n"
            "X_train_processed = preprocessor.fit_transform(X_train)\n"
            "X_test_processed = preprocessor.transform(X_test)\n"
            "print('Processed train shape:', X_train_processed.shape)\n"
            "print('Processed test shape:', X_test_processed.shape)"
        ),
        nbf.v4.new_code_cell(
            "model = tf.keras.Sequential([\n"
            "    tf.keras.layers.Input(shape=(X_train_processed.shape[1],)),\n"
            "    tf.keras.layers.Dense(6, activation='relu'),\n"
            "    tf.keras.layers.Dense(1, activation='sigmoid'),\n"
            "])\n"
            "model.compile(optimizer='adam', loss='binary_crossentropy', metrics=['accuracy'])\n"
            "history = model.fit(\n"
            "    X_train_processed,\n"
            "    y_train,\n"
            "    epochs=10,\n"
            "    batch_size=10,\n"
            "    validation_split=0.2,\n"
            "    verbose=0,\n"
            ")\n"
            "pd.DataFrame(history.history).head()"
        ),
        nbf.v4.new_code_cell(
            "test_probabilities = model.predict(X_test_processed, verbose=0).ravel()\n"
            "test_predictions = (test_probabilities >= 0.5).astype(int)\n"
            "test_accuracy = float(accuracy_score(y_test, test_predictions))\n"
            "test_confusion = confusion_matrix(y_test, test_predictions)\n"
            "print('Test accuracy:', round(test_accuracy, 4))\n"
            "print('Confusion matrix:', test_confusion.tolist())"
        ),
        nbf.v4.new_code_cell(
            "fig, axes = plt.subplots(1, 2, figsize=(12, 4))\n"
            "axes[0].plot(history.history['accuracy'], label='train')\n"
            "axes[0].plot(history.history['val_accuracy'], label='validation')\n"
            "axes[0].set_title('Accuracy by Epoch')\n"
            "axes[0].legend()\n"
            "axes[1].plot(history.history['loss'], label='train')\n"
            "axes[1].plot(history.history['val_loss'], label='validation')\n"
            "axes[1].set_title('Loss by Epoch')\n"
            "axes[1].legend()\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'training_history.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "\n"
            "fig, ax = plt.subplots(figsize=(5, 4))\n"
            "sns.heatmap(test_confusion, annot=True, fmt='d', cmap='Blues', ax=ax)\n"
            "ax.set_title('Confusion Matrix')\n"
            "ax.set_xlabel('Predicted')\n"
            "ax.set_ylabel('Actual')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'confusion_matrix.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "sample_customer = pd.DataFrame([{\n"
            "    'CreditScore': 600,\n"
            "    'Geography': 'France',\n"
            "    'Gender': 'Male',\n"
            "    'Age': 40,\n"
            "    'Tenure': 3,\n"
            "    'Balance': 60000,\n"
            "    'NumOfProducts': 2,\n"
            "    'HasCrCard': 1,\n"
            "    'IsActiveMember': 1,\n"
            "    'EstimatedSalary': 50000,\n"
            "}])\n"
            "sample_processed = preprocessor.transform(sample_customer)\n"
            "sample_probability = float(model.predict(sample_processed, verbose=0).ravel()[0])\n"
            "sample_prediction = int(sample_probability >= 0.5)\n"
            "sample_decision = 'Do not allow to go' if sample_prediction == 1 else 'Allow to stay'\n"
            "{\n"
            "    'sample_probability': round(sample_probability, 4),\n"
            "    'sample_prediction': sample_prediction,\n"
            "    'sample_decision': sample_decision,\n"
            "}"
        ),
        nbf.v4.new_code_cell(
            "history_df = pd.DataFrame(history.history)\n"
            "history_df.to_csv(OUTPUTS_DIR / 'session_9_training_history.csv', index=False)\n"
            "prediction_frame = pd.DataFrame({\n"
            "    'actual': y_test.reset_index(drop=True),\n"
            "    'predicted_probability': test_probabilities,\n"
            "    'predicted_label': test_predictions,\n"
            "})\n"
            "prediction_frame.head(100).to_csv(OUTPUTS_DIR / 'session_9_prediction_samples.csv', index=False)\n"
            "summary = {\n"
            "    'dataset_shape': list(df.shape),\n"
            "    'target_distribution': df['Exited'].value_counts().to_dict(),\n"
            "    'processed_feature_count': int(X_train_processed.shape[1]),\n"
            "    'test_accuracy': test_accuracy,\n"
            "    'confusion_matrix': test_confusion.tolist(),\n"
            "    'sample_customer_probability': sample_probability,\n"
            "    'sample_customer_prediction': sample_prediction,\n"
            "    'sample_customer_decision': sample_decision,\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_9_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def write_session_10_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 10\n\n"
            "This notebook is generated from the copied `Capstone_Session_10.pdf` directions and the staged extracted image folders under `data/`."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Build transfer-learning classifiers for face-mask detection, compare EfficientNetB0 and ResNet50, and save prediction evidence for the staged website workflow."
        ),
        nbf.v4.new_markdown_cell(
            "## Source Mismatch Note\n\n"
            "The copied PDF calls for pre-existing `train/` and `test/` folders and a 3-neuron softmax head. The staged source only contains `data/with_mask` and `data/without_mask`, which is a 2-class dataset. This notebook creates generated `train/` and `test/` folders from the staged source and uses a 2-neuron softmax head so the model output matches the actual copied data."
        ),
        nbf.v4.new_markdown_cell(
            "## Runtime Scope Note\n\n"
            "To keep the transfer-learning runs executable on the current CPU-only Windows environment, the generated split uses a fixed stratified sample from the staged image folders. The full extracted dataset remains staged in `data/`, and the split manifest is saved in `outputs/`."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "import os\n"
            "import random\n"
            "import shutil\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "import tensorflow as tf\n"
            "\n"
            "os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'\n"
            "tf.keras.utils.set_random_seed(42)\n"
            "random.seed(42)\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "SOURCE_DATA_DIR = BASE_DIR / 'data'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "GENERATED_SPLIT_DIR = OUTPUTS_DIR / 'generated_split'\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')\n"
            "IMAGE_SIZE = (128, 128)\n"
            "BATCH_SIZE = 16\n"
            "TRAIN_IMAGES_PER_CLASS = 120\n"
            "TEST_IMAGES_PER_CLASS = 30"
        ),
        nbf.v4.new_code_cell(
            "if GENERATED_SPLIT_DIR.exists():\n"
            "    shutil.rmtree(GENERATED_SPLIT_DIR)\n"
            "\n"
            "split_manifest = {'source_counts': {}, 'generated_counts': {}}\n"
            "for split_name in ['train', 'test']:\n"
            "    for class_name in ['with_mask', 'without_mask']:\n"
            "        (GENERATED_SPLIT_DIR / split_name / class_name).mkdir(parents=True, exist_ok=True)\n"
            "\n"
            "for class_name in ['with_mask', 'without_mask']:\n"
            "    source_files = sorted([path for path in (SOURCE_DATA_DIR / class_name).iterdir() if path.is_file()])\n"
            "    split_manifest['source_counts'][class_name] = len(source_files)\n"
            "    random.shuffle(source_files)\n"
            "    train_files = source_files[:TRAIN_IMAGES_PER_CLASS]\n"
            "    test_files = source_files[TRAIN_IMAGES_PER_CLASS:TRAIN_IMAGES_PER_CLASS + TEST_IMAGES_PER_CLASS]\n"
            "    split_manifest['generated_counts'][class_name] = {'train': len(train_files), 'test': len(test_files)}\n"
            "    for file_path in train_files:\n"
            "        shutil.copy2(file_path, GENERATED_SPLIT_DIR / 'train' / class_name / file_path.name)\n"
            "    for file_path in test_files:\n"
            "        shutil.copy2(file_path, GENERATED_SPLIT_DIR / 'test' / class_name / file_path.name)\n"
            "\n"
            "with open(OUTPUTS_DIR / 'session_10_split_manifest.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(split_manifest, handle, indent=2)\n"
            "split_manifest"
        ),
        nbf.v4.new_code_cell(
            "train_datagen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1.0 / 255.0, validation_split=0.2)\n"
            "test_datagen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1.0 / 255.0)\n"
            "\n"
            "train_generator = train_datagen.flow_from_directory(\n"
            "    GENERATED_SPLIT_DIR / 'train',\n"
            "    target_size=IMAGE_SIZE,\n"
            "    batch_size=BATCH_SIZE,\n"
            "    class_mode='categorical',\n"
            "    subset='training',\n"
            "    shuffle=True,\n"
            ")\n"
            "validation_generator = train_datagen.flow_from_directory(\n"
            "    GENERATED_SPLIT_DIR / 'train',\n"
            "    target_size=IMAGE_SIZE,\n"
            "    batch_size=BATCH_SIZE,\n"
            "    class_mode='categorical',\n"
            "    subset='validation',\n"
            "    shuffle=False,\n"
            ")\n"
            "test_generator = test_datagen.flow_from_directory(\n"
            "    GENERATED_SPLIT_DIR / 'test',\n"
            "    target_size=IMAGE_SIZE,\n"
            "    batch_size=BATCH_SIZE,\n"
            "    class_mode='categorical',\n"
            "    shuffle=False,\n"
            ")\n"
            "class_indices = train_generator.class_indices\n"
            "class_labels = {index: label for label, index in class_indices.items()}\n"
            "class_indices"
        ),
        nbf.v4.new_code_cell(
            "callbacks = [\n"
            "    tf.keras.callbacks.ReduceLROnPlateau(monitor='val_loss', factor=0.5, patience=2, verbose=0),\n"
            "    tf.keras.callbacks.EarlyStopping(monitor='val_loss', patience=4, restore_best_weights=True, verbose=0),\n"
            "]\n"
            "\n"
            "def build_transfer_model(base_model_name):\n"
            "    if base_model_name == 'EfficientNetB0':\n"
            "        preprocess = tf.keras.applications.efficientnet.preprocess_input\n"
            "        base_model = tf.keras.applications.EfficientNetB0(include_top=False, weights='imagenet', input_shape=(128, 128, 3))\n"
            "        dropout_rate = 0.2\n"
            "    elif base_model_name == 'ResNet50':\n"
            "        preprocess = tf.keras.applications.resnet50.preprocess_input\n"
            "        base_model = tf.keras.applications.ResNet50(include_top=False, weights='imagenet', input_shape=(128, 128, 3))\n"
            "        dropout_rate = 0.5\n"
            "    else:\n"
            "        raise ValueError(base_model_name)\n"
            "\n"
            "    base_model.trainable = False\n"
            "    model = tf.keras.Sequential([\n"
            "        tf.keras.layers.Input(shape=(128, 128, 3)),\n"
            "        tf.keras.layers.Lambda(preprocess),\n"
            "        base_model,\n"
            "        tf.keras.layers.GlobalAveragePooling2D(),\n"
            "        tf.keras.layers.Dropout(dropout_rate),\n"
            "        tf.keras.layers.Dense(2, activation='softmax'),\n"
            "    ])\n"
            "    model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])\n"
            "    return model"
        ),
        nbf.v4.new_code_cell(
            "histories = {}\n"
            "evaluations = []\n"
            "prediction_examples = {}\n"
            "for model_name in ['EfficientNetB0', 'ResNet50']:\n"
            "    tf.keras.backend.clear_session()\n"
            "    train_generator.reset()\n"
            "    validation_generator.reset()\n"
            "    test_generator.reset()\n"
            "    model = build_transfer_model(model_name)\n"
            "    history = model.fit(\n"
            "        train_generator,\n"
            "        validation_data=validation_generator,\n"
            "        epochs=25,\n"
            "        callbacks=callbacks,\n"
            "        verbose=0,\n"
            "    )\n"
            "    histories[model_name] = pd.DataFrame(history.history)\n"
            "    test_loss, test_accuracy = model.evaluate(test_generator, verbose=0)\n"
            "    test_generator.reset()\n"
            "    probabilities = model.predict(test_generator, verbose=0)\n"
            "    predicted_labels = np.argmax(probabilities, axis=1)\n"
            "    true_labels = test_generator.classes.copy()\n"
            "    evaluations.append({\n"
            "        'model': model_name,\n"
            "        'epochs_ran': int(len(histories[model_name])),\n"
            "        'test_loss': float(test_loss),\n"
            "        'test_accuracy': float(test_accuracy),\n"
            "    })\n"
            "    prediction_examples[model_name] = {\n"
            "        'filenames': test_generator.filenames[:10],\n"
            "        'true_labels': [class_labels[index] for index in true_labels[:10]],\n"
            "        'predicted_labels': [class_labels[index] for index in predicted_labels[:10]],\n"
            "    }\n"
            "evaluations_df = pd.DataFrame(evaluations).sort_values('test_accuracy', ascending=False).reset_index(drop=True)\n"
            "evaluations_df"
        ),
        nbf.v4.new_code_cell(
            "for model_name, history_df in histories.items():\n"
            "    history_df.to_csv(OUTPUTS_DIR / f'{model_name.lower()}_history.csv', index=False)\n"
            "    fig, axes = plt.subplots(1, 2, figsize=(12, 4))\n"
            "    axes[0].plot(history_df['accuracy'], label='train')\n"
            "    axes[0].plot(history_df['val_accuracy'], label='validation')\n"
            "    axes[0].set_title(f'{model_name} Accuracy by Epoch')\n"
            "    axes[0].legend()\n"
            "    axes[1].plot(history_df['loss'], label='train')\n"
            "    axes[1].plot(history_df['val_loss'], label='validation')\n"
            "    axes[1].set_title(f'{model_name} Loss by Epoch')\n"
            "    axes[1].legend()\n"
            "    fig.tight_layout()\n"
            "    fig.savefig(PLOTS_DIR / f'{model_name.lower()}_training_history.png', dpi=150)\n"
            "    plt.show()\n"
            "    plt.close(fig)\n"
            "\n"
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "evaluations_df.plot(x='model', y='test_accuracy', kind='bar', ax=ax, color=['#1f77b4', '#ff7f0e'])\n"
            "ax.set_title('Session 10 Model Comparison')\n"
            "ax.set_ylim(0, 1.0)\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'model_comparison.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "best_model_name = evaluations_df.iloc[0]['model']\n"
            "example_info = prediction_examples[best_model_name]\n"
            "figure, axes = plt.subplots(2, 5, figsize=(16, 7))\n"
            "for axis, filename, true_label, predicted_label in zip(axes.flatten(), example_info['filenames'], example_info['true_labels'], example_info['predicted_labels']):\n"
            "    image_path = GENERATED_SPLIT_DIR / 'test' / filename\n"
            "    image = tf.keras.utils.load_img(image_path, target_size=IMAGE_SIZE)\n"
            "    axis.imshow(image)\n"
            "    axis.set_title(f'T:{true_label}\\nP:{predicted_label}', fontsize=10)\n"
            "    axis.axis('off')\n"
            "figure.tight_layout()\n"
            "figure.savefig(PLOTS_DIR / 'best_model_prediction_examples.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(figure)"
        ),
        nbf.v4.new_code_cell(
            "evaluations_df.to_csv(OUTPUTS_DIR / 'session_10_model_comparison.csv', index=False)\n"
            "summary = {\n"
            "    'source_counts': split_manifest['source_counts'],\n"
            "    'generated_counts': split_manifest['generated_counts'],\n"
            "    'class_indices': class_indices,\n"
            "    'pdf_mismatch_notes': [\n"
            "        'The copied PDF expects train/test folders, but the staged source only provided data/with_mask and data/without_mask.',\n"
            "        'The copied PDF expects a 3-neuron softmax head, but the staged source is a 2-class dataset, so the executed models use a 2-neuron softmax head.',\n"
            "        'The generated train/test split is a fixed stratified sample to keep transfer-learning runs executable on the current CPU-only environment.',\n"
            "    ],\n"
            "    'model_results': evaluations,\n"
            "    'best_model': evaluations_df.iloc[0].to_dict(),\n"
            "    'best_model_example_predictions': prediction_examples[best_model_name],\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_10_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def write_session_11_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 11\n\n"
            "This notebook is generated from the copied `Capstone_Session_11.pdf` directions and the staged `GrammarandProductReviews.xlsx` dataset."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Build the required CNN-LSTM hybrid model to classify product reviews as positive or negative using the staged workbook data."
        ),
        nbf.v4.new_markdown_cell(
            "## Source Note\n\n"
            "The copied PDF names `GrammarandProductReviews.csv`, but the staged source file is `GrammarandProductReviews.xlsx`. This notebook loads the workbook and exports a converted CSV artifact for the website evidence flow before training the model."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "import os\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "import tensorflow as tf\n"
            "from IPython.display import display\n"
            "from sklearn.model_selection import train_test_split\n"
            "from sklearn.metrics import accuracy_score\n"
            "\n"
            "os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'\n"
            "tf.keras.utils.set_random_seed(42)\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "WORKBOOK_PATH = BASE_DIR / 'GrammarandProductReviews.xlsx'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')"
        ),
        nbf.v4.new_code_cell(
            "df = pd.read_excel(WORKBOOK_PATH)\n"
            "converted_csv_path = OUTPUTS_DIR / 'GrammarandProductReviews_converted.csv'\n"
            "df.to_csv(converted_csv_path, index=False)\n"
            "df['reviews.text'] = df['reviews.text'].fillna('').astype(str)\n"
            "df['target'] = (df['reviews.rating'] > 3).astype(int)\n"
            "display(df[['reviews.rating', 'reviews.text', 'target']].head())\n"
            "print('Shape:', df.shape)\n"
            "print('Target distribution:', df['target'].value_counts().to_dict())"
        ),
        nbf.v4.new_code_cell(
            "X_train, X_test, y_train, y_test = train_test_split(\n"
            "    df['reviews.text'],\n"
            "    df['target'],\n"
            "    test_size=0.2,\n"
            "    random_state=42,\n"
            "    stratify=df['target'],\n"
            ")\n"
            "MAX_NB_WORDS = 20000\n"
            "MAX_SEQUENCE_LENGTH = 150\n"
            "tokenizer = tf.keras.preprocessing.text.Tokenizer(num_words=MAX_NB_WORDS)\n"
            "tokenizer.fit_on_texts(X_train)\n"
            "X_train_seq = tokenizer.texts_to_sequences(X_train)\n"
            "X_test_seq = tokenizer.texts_to_sequences(X_test)\n"
            "X_train_pad = tf.keras.preprocessing.sequence.pad_sequences(X_train_seq, maxlen=MAX_SEQUENCE_LENGTH)\n"
            "X_test_pad = tf.keras.preprocessing.sequence.pad_sequences(X_test_seq, maxlen=MAX_SEQUENCE_LENGTH)\n"
            "y_train_onehot = tf.keras.utils.to_categorical(y_train, num_classes=2)\n"
            "y_test_onehot = tf.keras.utils.to_categorical(y_test, num_classes=2)\n"
            "print('Padded train shape:', X_train_pad.shape)\n"
            "print('Padded test shape:', X_test_pad.shape)"
        ),
        nbf.v4.new_code_cell(
            "model = tf.keras.Sequential([\n"
            "    tf.keras.layers.Input(shape=(MAX_SEQUENCE_LENGTH,), dtype='int32'),\n"
            "    tf.keras.layers.Embedding(input_dim=MAX_NB_WORDS, output_dim=50, input_length=MAX_SEQUENCE_LENGTH),\n"
            "    tf.keras.layers.Conv1D(64, 5, activation='relu'),\n"
            "    tf.keras.layers.MaxPooling1D(pool_size=5),\n"
            "    tf.keras.layers.Dropout(0.2),\n"
            "    tf.keras.layers.Conv1D(64, 5, activation='relu'),\n"
            "    tf.keras.layers.MaxPooling1D(pool_size=5),\n"
            "    tf.keras.layers.Dropout(0.2),\n"
            "    tf.keras.layers.LSTM(64),\n"
            "    tf.keras.layers.Dense(2, activation='softmax'),\n"
            "])\n"
            "model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])\n"
            "history = model.fit(\n"
            "    X_train_pad,\n"
            "    y_train_onehot,\n"
            "    epochs=5,\n"
            "    batch_size=64,\n"
            "    validation_split=0.2,\n"
            "    verbose=0,\n"
            ")\n"
            "pd.DataFrame(history.history).head()"
        ),
        nbf.v4.new_code_cell(
            "test_probabilities = model.predict(X_test_pad, verbose=0)\n"
            "test_predictions = np.argmax(test_probabilities, axis=1)\n"
            "test_loss, test_accuracy = model.evaluate(X_test_pad, y_test_onehot, verbose=0)\n"
            "print('Test loss:', round(float(test_loss), 4))\n"
            "print('Test accuracy:', round(float(test_accuracy), 4))\n"
            "print('Sklearn accuracy:', round(float(accuracy_score(y_test, test_predictions)), 4))"
        ),
        nbf.v4.new_code_cell(
            "fig, axes = plt.subplots(1, 2, figsize=(12, 4))\n"
            "axes[0].plot(history.history['accuracy'], label='train')\n"
            "axes[0].plot(history.history['val_accuracy'], label='validation')\n"
            "axes[0].set_title('Accuracy by Epoch')\n"
            "axes[0].legend()\n"
            "axes[1].plot(history.history['loss'], label='train')\n"
            "axes[1].plot(history.history['val_loss'], label='validation')\n"
            "axes[1].set_title('Loss by Epoch')\n"
            "axes[1].legend()\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'training_history.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "history_df = pd.DataFrame(history.history)\n"
            "history_df.to_csv(OUTPUTS_DIR / 'session_11_training_history.csv', index=False)\n"
            "prediction_samples = pd.DataFrame({\n"
            "    'review_text': X_test.reset_index(drop=True).head(100),\n"
            "    'actual': y_test.reset_index(drop=True).head(100),\n"
            "    'predicted': pd.Series(test_predictions).head(100),\n"
            "})\n"
            "prediction_samples.to_csv(OUTPUTS_DIR / 'session_11_prediction_samples.csv', index=False)\n"
            "summary = {\n"
            "    'dataset_shape': list(df.shape),\n"
            "    'converted_csv_path': converted_csv_path.name,\n"
            "    'target_distribution': df['target'].value_counts().to_dict(),\n"
            "    'test_loss': float(test_loss),\n"
            "    'test_accuracy': float(test_accuracy),\n"
            "    'max_nb_words': MAX_NB_WORDS,\n"
            "    'max_sequence_length': MAX_SEQUENCE_LENGTH,\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_11_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def write_session_12_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 12\n\n"
            "This notebook is generated from the copied `Capstone_Session_12.pdf` directions and the staged `Dental-Panaromic-Autoencoder.npz` dataset."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Build the required denoising autoencoder, train it on the staged dental X-ray data, and compare noisy versus reconstructed outputs."
        ),
        nbf.v4.new_markdown_cell(
            "## Shape Note\n\n"
            "The staged arrays are RGB-shaped `(256, 256, 3)`, while the copied PDF also specifies a final decoder layer with 1 filter. This notebook converts the staged RGB arrays to grayscale before training so the model can satisfy the single-channel decoder requirement without inventing a third output convention."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "import os\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import tensorflow as tf\n"
            "\n"
            "os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'\n"
            "tf.keras.utils.set_random_seed(42)\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "DATA_PATH = BASE_DIR / 'Dental-Panaromic-Autoencoder.npz'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)"
        ),
        nbf.v4.new_code_cell(
            "data = np.load(DATA_PATH)\n"
            "x_train = data['x_train'].astype('float32') / 255.0 if data['x_train'].max() > 1 else data['x_train'].astype('float32')\n"
            "x_test = data['x_test'].astype('float32') / 255.0 if data['x_test'].max() > 1 else data['x_test'].astype('float32')\n"
            "x_train_gray = x_train.mean(axis=-1, keepdims=True)\n"
            "x_test_gray = x_test.mean(axis=-1, keepdims=True)\n"
            "noise_factor = 0.2\n"
            "x_train_noisy = np.clip(x_train_gray + noise_factor * np.random.normal(loc=0.0, scale=1.0, size=x_train_gray.shape), 0.0, 1.0)\n"
            "x_test_noisy = np.clip(x_test_gray + noise_factor * np.random.normal(loc=0.0, scale=1.0, size=x_test_gray.shape), 0.0, 1.0)\n"
            "print({'x_train': x_train.shape, 'x_train_gray': x_train_gray.shape, 'x_test': x_test.shape, 'x_test_gray': x_test_gray.shape})"
        ),
        nbf.v4.new_code_cell(
            "fig, axes = plt.subplots(2, 5, figsize=(14, 6))\n"
            "for index in range(5):\n"
            "    axes[0, index].imshow(x_train_gray[index].squeeze(), cmap='gray')\n"
            "    axes[0, index].axis('off')\n"
            "    axes[0, index].set_title(f'Original {index + 1}')\n"
            "    axes[1, index].imshow(x_train_noisy[index].squeeze(), cmap='gray')\n"
            "    axes[1, index].axis('off')\n"
            "    axes[1, index].set_title(f'Noisy {index + 1}')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'original_vs_noisy_train.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "class Denoise(tf.keras.Model):\n"
            "    def __init__(self):\n"
            "        super().__init__()\n"
            "        self.encoder = tf.keras.Sequential([\n"
            "            tf.keras.layers.Input(shape=(256, 256, 1)),\n"
            "            tf.keras.layers.Conv2D(64, (3, 3), activation='relu', padding='same', strides=2),\n"
            "            tf.keras.layers.Conv2D(32, (3, 3), activation='relu', padding='same', strides=2),\n"
            "        ])\n"
            "        self.decoder = tf.keras.Sequential([\n"
            "            tf.keras.layers.Conv2DTranspose(32, kernel_size=3, strides=2, activation='relu', padding='same'),\n"
            "            tf.keras.layers.Conv2DTranspose(64, kernel_size=3, strides=2, activation='relu', padding='same'),\n"
            "            tf.keras.layers.Conv2D(1, kernel_size=(3, 3), activation='sigmoid', padding='same'),\n"
            "        ])\n"
            "\n"
            "    def call(self, inputs):\n"
            "        encoded = self.encoder(inputs)\n"
            "        decoded = self.decoder(encoded)\n"
            "        return decoded\n"
            "\n"
            "autoencoder = Denoise()\n"
            "autoencoder.compile(optimizer='adam', loss=tf.keras.losses.MeanSquaredError(), metrics=['mae'])"
        ),
        nbf.v4.new_code_cell(
            "history = autoencoder.fit(\n"
            "    x_train_noisy,\n"
            "    x_train_gray,\n"
            "    epochs=50,\n"
            "    batch_size=8,\n"
            "    shuffle=True,\n"
            "    validation_data=(x_test_noisy, x_test_gray),\n"
            "    verbose=0,\n"
            ")\n"
            "pd.DataFrame(history.history).tail()"
        ),
        nbf.v4.new_code_cell(
            "evaluation = autoencoder.evaluate(x_test_noisy, x_test_gray, verbose=0)\n"
            "encoded_images = autoencoder.encoder(x_test_noisy).numpy()\n"
            "decoded_images = autoencoder.decoder(encoded_images).numpy()\n"
            "print({'test_loss': float(evaluation[0]), 'test_mae': float(evaluation[1]), 'encoded_shape': encoded_images.shape, 'decoded_shape': decoded_images.shape})"
        ),
        nbf.v4.new_code_cell(
            "fig, axes = plt.subplots(2, 10, figsize=(18, 5))\n"
            "for index in range(10):\n"
            "    axes[0, index].imshow(x_test_noisy[index].squeeze(), cmap='gray')\n"
            "    axes[0, index].axis('off')\n"
            "    axes[0, index].set_title(f'Noisy {index + 1}')\n"
            "    axes[1, index].imshow(decoded_images[index].squeeze(), cmap='gray')\n"
            "    axes[1, index].axis('off')\n"
            "    axes[1, index].set_title(f'Denoised {index + 1}')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'noisy_vs_denoised_test.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "fig, axes = plt.subplots(1, 2, figsize=(12, 4))\n"
            "axes[0].plot(history.history['mae'], label='train')\n"
            "axes[0].plot(history.history['val_mae'], label='validation')\n"
            "axes[0].set_title('MAE by Epoch')\n"
            "axes[0].legend()\n"
            "axes[1].plot(history.history['loss'], label='train')\n"
            "axes[1].plot(history.history['val_loss'], label='validation')\n"
            "axes[1].set_title('Loss by Epoch')\n"
            "axes[1].legend()\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'training_history.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "history_df = pd.DataFrame(history.history)\n"
            "history_df.to_csv(OUTPUTS_DIR / 'session_12_training_history.csv', index=False)\n"
            "summary = {\n"
            "    'original_shapes': {'x_train': list(x_train.shape), 'x_test': list(x_test.shape)},\n"
            "    'grayscale_shapes': {'x_train_gray': list(x_train_gray.shape), 'x_test_gray': list(x_test_gray.shape)},\n"
            "    'noise_factor': noise_factor,\n"
            "    'test_loss': float(evaluation[0]),\n"
            "    'test_mae': float(evaluation[1]),\n"
            "    'encoded_shape': list(encoded_images.shape),\n"
            "    'decoded_shape': list(decoded_images.shape),\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_12_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def main() -> int:
    if len(sys.argv) != 2:
        print("Usage: generate_deep_learning_capstone_artifacts.py session-9|session-10|session-11|session-12")
        return 1

    target = sys.argv[1].strip().lower()
    os.environ.setdefault("TF_CPP_MIN_LOG_LEVEL", "2")

    if target == "session-9":
        paths = build_session_9_paths()
        write_session_9_notebook(paths)
    elif target == "session-10":
        paths = build_session_10_paths()
        write_session_10_notebook(paths)
    elif target == "session-11":
        paths = build_session_11_paths()
        write_session_11_notebook(paths)
    elif target == "session-12":
        paths = build_session_12_paths()
        write_session_12_notebook(paths)
    else:
        print(f"Unsupported target: {target}")
        return 1

    print(f"Generated {paths.notebook}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())