# Capstone Session 6 Requirements

Source directions file: `Capstone_Session_6.pdf`
Source staged dataset: `adultcensusincome.csv`

## 1. Building an Income Classification Model

1a. Build a classification model for predicting income using the Adult Census Income dataset.
Status: The copied PDF states this modeling objective explicitly. No staged notebook, trained model, or output artifact is currently present in this capstone folder.

1b. Load the dataset `adultcensusincome.csv`.
Status: Supported by the copied dataset staged in this capstone folder.

1c. Check for null values in any columns.
Status: This PDF requirement is identified from the copied directions file. No staged audit artifact is currently present.

1d. Check for `?` values in any columns.
Status: This PDF requirement is identified from the copied directions file. No staged audit artifact is currently present.

1e. Handle the null values and `?` values.
Status: This PDF requirement is identified from the copied directions file. No staged cleaning artifact is currently present.

1f. Check the distribution of target variable `income`.
Status: Supported by the staged dataset column `income`. No staged distribution artifact is currently present.

1g. Identify whether the dataset is balanced.
Status: This PDF requirement is identified from the copied directions file. No staged balance-analysis artifact is currently present.

1h. Create a barplot for column `income`.
Status: Supported by the staged dataset column `income`. No staged figure artifact is currently present.

1i. Create a distribution plot for column `age`.
Status: Supported by the staged dataset column `age`. No staged figure artifact is currently present.

1j. Create a barplot for column `education`.
Status: Supported by the staged dataset column `education`. No staged figure artifact is currently present.

1k. Create a barplot for years of education using column `education.num`.
Status: Supported by the staged dataset column `education.num`. No staged figure artifact is currently present.

1l. Create a pie chart for marital status using column `marital.status`.
Status: Supported by the staged dataset column `marital.status`. No staged figure artifact is currently present.

1m. Create a countplot of income across columns age, education, marital status, and sex.
Status: Supported by the staged dataset columns `age`, `education`, `marital.status`, `sex`, and `income`. No staged bivariate plot artifact is currently present.

1n. Draw a heatmap of data correlation and identify the columns to which income is highly correlated.
Status: This PDF requirement is identified from the copied directions file. No staged correlation artifact is currently present.

1o. Prepare the dataset for modeling.
Status: This PDF requirement is identified from the copied directions file. No staged modeling-ready dataset artifact is currently present.

1p. Label encode all categorical columns.
Status: The copied PDF states this preprocessing step explicitly. No staged encoded dataset artifact is currently present.

1q. Prepare independent variables `X` and dependent variable `Y` (`Income`).
Status: Supported by the staged dataset and copied PDF wording. No staged train-ready artifact is currently present.

1r. Perform feature scaling using `StandardScaler`.
Status: The copied PDF states this preprocessing step explicitly. No staged scaling artifact is currently present.

1s. Fix the imbalance in the dataset using one technique such as `SMOTE` or `RandomOverSampler`.
Status: The copied PDF states this preprocessing step explicitly. No staged resampling artifact is currently present.

1t. Perform a train test split in the ratio 80:20 with `random_state 42`.
Status: This PDF requirement is identified from the copied directions file. No staged split artifact is currently present.

1u. Train a Logistic Regression model.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1v. Train a KNN Classifier model.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1w. Train an SVM Classifier model.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1x. Train a Naive Bayes Classifier model.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1y. Train a Decision Tree Classifier model.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1z. Train a Random Forest Classifier model.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1aa. Perform model evaluation on Accuracy and F1 score.
Status: This PDF requirement is identified from the copied directions file. No staged evaluation artifact is currently present.

1ab. Identify the best model.
Status: This PDF requirement is identified from the copied directions file. No staged comparison artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 6 directions file: 28
- Dataset-backed items currently supported by staged source files in this capstone folder: 9
- PDF-only items still awaiting notebook, figure, model, or output evidence: 19
