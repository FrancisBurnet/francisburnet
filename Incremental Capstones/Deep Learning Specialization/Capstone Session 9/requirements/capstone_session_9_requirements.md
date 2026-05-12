# Capstone Session 9 Requirements

Source directions file: `Capstone_Session_9.pdf`
Source staged dataset: `Churn_Modeling.csv`

## 1. Predicting Customer Churn with Neural Networks

1a. Build an Artificial Neural Network to identify customers who will leave the bank based on customer data from the past three months.
Status: The copied PDF states this modeling objective explicitly. No staged notebook, model, or output artifact is currently present.

1b. Load the dataset.
Status: Supported by the copied dataset staged in this capstone folder. The staged filename is `Churn_Modeling.csv`, while the PDF text shows `Churn_Modelling.csv`.

1c. Drop the customers' personal data columns that are not useful for analysis, using the first three columns as the hint.
Status: Supported by the staged dataset columns `RowNumber`, `CustomerId`, and `Surname`. No staged transformed dataset artifact is currently present.

1d. Prepare independent variables `X` and dependent variable `Y` (`Exited`).
Status: Supported by the staged dataset column `Exited`. No staged train-ready dataset artifact is currently present.

1e. LabelEncode the `Gender` column.
Status: Supported by the staged dataset column `Gender`. No staged encoded dataset artifact is currently present.

1f. OneHotEncode the `Geography` column.
Status: Supported by the staged dataset column `Geography`. No staged encoded dataset artifact is currently present.

1g. Perform a train test split in the ratio 80:20 with `random_state 0`.
Status: This PDF requirement is identified from the copied directions file. No staged split artifact is currently present.

1h. Build a Keras Sequential model with a dense layer of 6 neurons and `relu` activation.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1i. Add a dense layer with 1 neuron and `sigmoid` activation.
Status: This PDF requirement is identified from the copied directions file. No staged model-definition artifact is currently present.

1j. Compile the model with Adam optimizer, `binary_crossentropy` loss, and metric `accuracy`.
Status: This PDF requirement is identified from the copied directions file. No staged compiled-model artifact is currently present.

1k. Train the model for 10 epochs with batch size 10.
Status: This PDF requirement is identified from the copied directions file. No staged training artifact is currently present.

1l. Evaluate the model on the test set and print the accuracy and confusion matrix.
Status: This PDF requirement is identified from the copied directions file. No staged evaluation artifact is currently present.

1m. Use the built ANN model to predict whether the specified customer will leave the bank.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1n. Use `Geography: France` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1o. Use `Credit Score: 600` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1p. Use `Gender: Male` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1q. Use `Age: 40 years` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1r. Use `Tenure: 3 years` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1s. Use `Balance: $60000` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1t. Use `Number of Products: 2` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1u. Use `Has Credit Card: Yes` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1v. Use `Is Active Member: Yes` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1w. Use `Estimated Salary: $50000` for the customer prediction input.
Status: This PDF requirement is identified from the copied directions file. No staged prediction artifact is currently present.

1x. Decide whether the customer should be allowed to go.
Status: This PDF requirement is identified from the copied directions file. No staged final prediction artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 9 directions file: 24
- Dataset-backed items currently supported by staged source files in this capstone folder: 5
- PDF-only items still awaiting notebook, model, evaluation, or prediction evidence: 19
