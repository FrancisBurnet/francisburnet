# Capstone Session 11 Requirements

Source directions file: `Capstone_Session_11.pdf`
Source staged dataset: `GrammarandProductReviews.xlsx`

## 1. Classifying Product Reviews with CNN-LSTM

1a. Build a CNN-LSTM hybrid model to classify customer product reviews into good or bad.
Status: The copied PDF states this modeling objective explicitly. No staged notebook, model, or evaluation artifact is currently present.

1b. Load `GrammarandProductReviews.csv`.
Status: The copied PDF names `GrammarandProductReviews.csv`, but the copied capstone folder stages `GrammarandProductReviews.xlsx`. No staged converted CSV or notebook is currently present to reconcile that difference.

1c. Create a feature named `target` using `reviews.rating`, where ratings higher than 3 represent a pleased customer and ratings below 4 represent a customer who does not like the product.
Status: Supported by the staged workbook header, which includes `reviews.rating`. No staged transformed dataset artifact is currently present.

1d. Create `X` using column `reviews.text` and `Y` using column `target`.
Status: Supported by the staged workbook header, which includes `reviews.text`. No staged train-ready dataset artifact is currently present.

1e. Split the dataset into train and test in the ratio 80:20.
Status: This PDF requirement is identified from the copied directions file. No staged split artifact is currently present.

1f. Use a tokenizer from Keras to vectorize the text samples into a 2D integer tensor with 20000 words.
Status: This PDF requirement is identified from the copied directions file. No staged tokenizer artifact is currently present.

1g. Fit the tokenizer on train data with `MAX_NB_WORDS = 20000`.
Status: This PDF requirement is identified from the copied directions file. No staged tokenizer-fit artifact is currently present.

1h. Convert train texts to sequences using `texts_to_sequences`.
Status: This PDF requirement is identified from the copied directions file. No staged sequence artifact is currently present.

1i. Convert test texts to sequences using `texts_to_sequences`.
Status: This PDF requirement is identified from the copied directions file. No staged sequence artifact is currently present.

1j. Pad train and test sequences to length 150 using `MAX_SEQUENCE_LENGTH = 150`.
Status: This PDF requirement is identified from the copied directions file. No staged padded-sequence artifact is currently present.

1k. One-hot encode the output classes (`True/False`).
Status: This PDF requirement is identified from the copied directions file. No staged encoded-output artifact is currently present.

1l. Build a CNN-LSTM hybrid model with an input layer using shape `MAX_SEQUENCE_LENGTH` and dtype `int32`.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1m. Add an embedding layer with input dimension `MAX_NB_WORDS`, output dimension `50`, and input length `MAX_SEQUENCE_LENGTH`.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1n. Add a `Conv1D` layer with 64 filters, kernel size 5, activation `relu`, followed by `MaxPooling1D(pool_size=5)`.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1o. Add `Dropout(0.2)` after the first convolution block.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1p. Add a second `Conv1D` layer with 64 filters, kernel size 5, activation `relu`, followed by `MaxPooling1D(pool_size=5)`.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1q. Add `Dropout(0.2)` after the second convolution block.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1r. Add an `LSTM` layer with 64 units.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1s. Add a dense layer with 2 neurons and `softmax` activation.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1t. Compile the model with Adam optimizer and metric `accuracy`.
Status: This PDF requirement is identified from the copied directions file. No staged compiled-model artifact is currently present.

1u. Train the model for 5 epochs with batch size 64.
Status: This PDF requirement is identified from the copied directions file. No staged training artifact is currently present.

1v. Evaluate the model on test text and print the test loss and accuracy.
Status: This PDF requirement is identified from the copied directions file. No staged evaluation artifact is currently present.

1w. As a future or take-home task, train the model with the full dataset available from the referenced Kaggle link.
Status: This copied PDF item is explicitly marked as a future or take-home task. No full external dataset is staged in this capstone folder.

1x. Evaluate the model on the full test data and compare the performance improvement from a subset of the full dataset.
Status: This copied PDF item is explicitly tied to the take-home full-dataset task. No staged full-dataset evaluation artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 11 directions file: 24
- Dataset-backed items currently supported by staged source files in this capstone folder: 3
- PDF-only items still awaiting notebook, converted-data, model, or evaluation evidence: 21
