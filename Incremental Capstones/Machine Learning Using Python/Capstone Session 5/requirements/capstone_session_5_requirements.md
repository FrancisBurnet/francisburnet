# Capstone Session 5 Requirements

Source directions file: `Capstone_Session_5.pdf`
Source staged dataset: `FloridaBikeRentals.csv`

## 1. Predicting Bike Rental Demand

1a. Build a model to predict the hourly rented bike count needed for a stable supply of rental bikes using rented bike count, hour of day, temperature, humidity, wind speed, rainfall, holidays, and other provided factors.
Status: The copied PDF states this modeling objective explicitly. No staged notebook, trained model, or output artifact is currently present in this capstone folder.

1b. Load the dataset `FloridaBikeRentals.csv`.
Status: Supported by the copied dataset staged in this capstone folder.

1c. Check for null values in any columns.
Status: This PDF requirement is identified from the copied directions file. No staged notebook or audit output is currently present in this capstone folder.

1d. Handle the missing values.
Status: This PDF requirement is identified from the copied directions file. No staged cleaning artifact is currently present in this capstone folder.

1e. Convert the `Date` column to date format.
Status: Supported by the staged dataset header, which includes a `Date` column. No staged transformation artifact is currently present.

1f. Extract day from the date column.
Status: This PDF requirement is identified from the copied directions file. No staged derived-column artifact is currently present.

1g. Extract month from the date column.
Status: This PDF requirement is identified from the copied directions file. No staged derived-column artifact is currently present.

1h. Extract day of week from the date column.
Status: This PDF requirement is identified from the copied directions file. No staged derived-column artifact is currently present.

1i. Extract a weekday or weekend flag from the date column.
Status: This PDF requirement is identified from the copied directions file. No staged derived-column artifact is currently present.

1j. Check feature correlation using a heatmap.
Status: This PDF requirement is identified from the copied directions file. No staged heatmap artifact is currently present.

1k. Plot the distribution plot of `Rented Bike Count`.
Status: Supported by the staged dataset header, which includes `Rented Bike Count`. No staged distribution plot is currently present.

1l. Plot the histogram of all numerical features.
Status: This PDF requirement is identified from the copied directions file. No staged histogram artifact is currently present.

1m. Plot the box plot of `Rented Bike Count` against all categorical features.
Status: Supported by the staged dataset columns `Seasons`, `Holiday`, and `Functioning Day`. No staged box-plot artifact is currently present.

1n. Plot the Seaborn catplot of `Rented Bike Count` against `Hour`, `Holiday`, `Rainfall(mm)`, `Snowfall (cm)`, weekdays, and weekend.
Status: Supported by the copied PDF task line and the staged dataset columns `Hour`, `Holiday`, `Rainfall(mm)`, and `Snowfall (cm)`. No staged catplot artifact is currently present.

1o. Record the inferences from the required catplot comparisons.
Status: This PDF requirement is identified from the copied directions file. No staged written inference artifact is currently present.

1p. Encode the categorical features into numerical features.
Status: This PDF requirement is identified from the copied directions file. No staged encoded dataset artifact is currently present.

1q. Use `get_dummies()` for categorical encoding.
Status: The copied PDF names `get_dummies()` explicitly. No staged notebook or script is currently present to show that implementation.

1r. Identify the target variable.
Status: Supported by the copied PDF task statement and the staged dataset column `Rented Bike Count`.

1s. Split the dataset into train and test using an 80:20 ratio and random state `1`.
Status: This PDF requirement is identified from the copied directions file. No staged split artifact is currently present.

1t. Perform standard scaling on the training dataset.
Status: This PDF requirement is identified from the copied directions file. No staged scaling artifact is currently present.

1u. Perform Linear Regression to predict the bike count required each hour.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1v. Perform Lasso Regression to predict the bike count required each hour.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1w. Perform Ridge Regression to predict the bike count required each hour.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1x. Compare the results from Linear Regression, Lasso Regression, and Ridge Regression.
Status: This PDF requirement is identified from the copied directions file. No staged model-comparison artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 5 directions file: 24
- Dataset-backed items currently supported by staged source files in this capstone folder: 6
- PDF-only items still awaiting notebook, plot, model, or output evidence: 18