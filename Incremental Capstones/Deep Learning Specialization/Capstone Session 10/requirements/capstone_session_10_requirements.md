# Capstone Session 10 Requirements

Source directions file: `Capstone_Session_10.pdf`
Source staged dataset archive: `Face_mask_detection.zip`
Source extracted data folder: `data/`

## 1. Detecting Face Masks with Transfer Learning

1a. Build a transfer learning model to detect face masks on humans.
Status: The copied PDF states this modeling objective explicitly. No staged notebook, trained model, or plot artifact is currently present.

1b. Load the image training and test datasets from the `train` and `test` folders for Task A using images of size `128 x 128 x 3`.
Status: The copied PDF requires `train` and `test` folders, but the copied capstone currently stages `Face_mask_detection.zip` and extracted `data/with_mask` and `data/without_mask` folders only. No staged `train/` or `test/` folder is currently present.

1c. Load the training dataset using Keras `ImageDataGenerator` with `validation_split=0.2` for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged notebook or training loader artifact is currently present.

1d. Load the test dataset using Keras `ImageDataGenerator` for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged test-loader artifact is currently present.

1e. Build a transfer learning network using `EfficientNetB0` as the first layers for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1f. Add a `GlobalAveragePooling2D` layer for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1g. Add `Dropout(0.2)` for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1h. Add a dense layer with 3 neurons and `SoftMax` activation for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1i. Compile the Task A model with Adam optimizer, `categorical_crossentropy` loss, and metric `accuracy`.
Status: This PDF requirement is identified from the copied directions file. No staged compiled-model artifact is currently present.

1j. Train the Task A model for 25 epochs with callbacks Reduce Learning Rate on Plateau and early stopping while monitoring validation loss.
Status: This PDF requirement is identified from the copied directions file. No staged training artifact is currently present.

1k. Plot training and validation accuracy and loss against epochs for Task A.
Status: This PDF requirement is identified from the copied directions file. No staged figure artifact is currently present.

1l. Load the image training and test datasets from the `train` and `test` folders for Task B using images of size `128 x 128 x 3`.
Status: The copied PDF requires `train` and `test` folders, but the copied capstone currently stages the archive plus extracted `data/` class folders only. No staged `train/` or `test/` folder is currently present.

1m. Load the training dataset using Keras `ImageDataGenerator` with `validation_split=0.2` for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged notebook or training loader artifact is currently present.

1n. Load the test dataset using Keras `ImageDataGenerator` for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged test-loader artifact is currently present.

1o. Build a transfer learning network using `ResNet50` as the first layers for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1p. Add a `GlobalAveragePooling2D` layer for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1q. Add `Dropout(0.5)` for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1r. Add a dense layer with 3 neurons and `SoftMax` activation for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1s. Compile the Task B model with Adam optimizer, `categorical_crossentropy` loss, and metric `accuracy`.
Status: This PDF requirement is identified from the copied directions file. No staged compiled-model artifact is currently present.

1t. Train the Task B model for 25 epochs with callbacks Reduce Learning Rate on Plateau and early stopping while monitoring validation loss.
Status: This PDF requirement is identified from the copied directions file. No staged training artifact is currently present.

1u. Plot training and validation accuracy and loss against epochs for Task B.
Status: This PDF requirement is identified from the copied directions file. No staged figure artifact is currently present.

1v. Using the best model, predict on the test dataset and plot 10 images from the test set with true and predicted labels.
Status: This PDF requirement is identified from the copied directions file. No staged prediction figure artifact is currently present.

1w. Compare `EfficientNetB0` and `ResNet50` performance and identify the best model.
Status: This PDF requirement is identified from the copied directions file. No staged model-comparison artifact is currently present.

1x. Using the best model, predict the test dataset and plot 10 images from the test set with true and predicted labels.
Status: This PDF requirement is repeated in Task C of the copied directions file. No staged prediction figure artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 10 directions file: 24
- Dataset-backed items currently supported by staged source files in this capstone folder: 2
- PDF-only items still awaiting notebook, model, plot, or train/test-folder evidence: 22
