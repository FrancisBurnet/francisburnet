# Capstone Session 10 Requirements

Source directions file: `Capstone_Session_10.pdf`
Source input policy: PDF tasks are the source of truth for requirements; approved GitHub-backed dataset files are the source of truth for notebook inputs.
Source staged dataset archive: `Face_mask_detection.zip`
Source extracted data folder: `data/`

## 1. Detecting Face Masks with Transfer Learning

1a. - [x] Build a transfer learning model to detect face masks on humans.
1b. - [x] Load image training and test datasets for Task A at image size `128 x 128 x 3`.
1c. - [x] Load Task A training dataset using Keras `ImageDataGenerator` with `validation_split=0.2`.
1d. - [x] Load Task A test dataset using Keras `ImageDataGenerator`.
1e. - [x] Build Task A transfer network using `EfficientNetB0` as initial layers.
1f. - [x] Add `GlobalAveragePooling2D` in Task A model.
1g. - [x] Add `Dropout(0.2)` in Task A model.
1h. - [x] Add final `SoftMax` dense output layer for class prediction in Task A.
1i. - [x] Compile Task A model with Adam, `categorical_crossentropy`, and `accuracy`.
1j. - [x] Train Task A model for up to 25 epochs with ReduceLROnPlateau and EarlyStopping on validation loss.
1k. - [x] Plot Task A training and validation accuracy/loss vs epochs.
1l. - [x] Load image training and test datasets for Task B at image size `128 x 128 x 3`.
1m. - [x] Load Task B training dataset using Keras `ImageDataGenerator` with `validation_split=0.2`.
1n. - [x] Load Task B test dataset using Keras `ImageDataGenerator`.
1o. - [x] Build Task B transfer network using `ResNet50` as initial layers.
1p. - [x] Add `GlobalAveragePooling2D` in Task B model.
1q. - [x] Add `Dropout(0.5)` in Task B model.
1r. - [x] Add final `SoftMax` dense output layer for class prediction in Task B.
1s. - [x] Compile Task B model with Adam, `categorical_crossentropy`, and `accuracy`.
1t. - [x] Train Task B model for up to 25 epochs with ReduceLROnPlateau and EarlyStopping on validation loss.
1u. - [x] Plot Task B training and validation accuracy/loss vs epochs.
1v. - [x] Predict on test set with best model and plot 10 test images with true vs predicted labels.
1w. - [x] Compare `EfficientNetB0` and `ResNet50` performance and identify best model.
1x. - [x] Provide best-model prediction evidence for test images in final outputs.

## 2. Source Governance and Compliance Rules

2a. - [x] Keep PDF task order and deliverables as source of truth for requirement coverage.
2b. - [x] Use approved GitHub-backed dataset artifacts as source of truth for notebook input files.
2c. - [x] Record any mismatch between PDF-expected class list and available staged source classes in notebook outputs.
2d. - [x] Generate runtime `train/` and `test/` folders when staged source is class-folder layout instead of pre-made split folders.
2e. - [x] Keep TensorFlow Playground and Teachable Machine website add-on as optional presentation layer that does not replace graded notebook evidence.

## 3. Current Dataset-Class Compliance Snapshot

3a. - [x] PDF expected class values recorded: `with_mask`, `without_mask`, `mask_worn_incorrect`.
3b. - [x] GitHub-backed staged source classes recorded from current archive/extracted data.
3c. - [x] Missing PDF-expected classes from source are reported in notebook summary metadata when absent.

## Requirements Extraction Counts

- Actionable requirement items from copied Session 10 directions: 24
- Governance and compliance control items added for Project_DEV_Rules alignment: 8
