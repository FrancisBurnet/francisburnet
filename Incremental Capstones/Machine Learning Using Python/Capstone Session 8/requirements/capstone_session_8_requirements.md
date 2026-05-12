# Capstone Session 8 Requirements

Source directions file: `Capstone_Session_8.pdf`
Source staged datasets: `movies.csv`, `ratings.csv`

## 1. Movie Recommendation Techniques

1a. Study the recommendation techniques for recommending movies using `movies.csv` and `ratings.csv`.
Status: The copied PDF states this recommendation objective explicitly. No staged notebook or evaluation artifact is currently present.

1b. Load `movies.csv` and `ratings.csv`.
Status: Supported by the copied datasets staged in this capstone folder.

1c. Merge both dataframes on `movieId`.
Status: Supported by the staged dataset columns `movieId` in both CSV files. No staged merged-data artifact is currently present.

1d. Create the user-item matrix using `pivot_table` with index `userId`, columns `title`, and values `rating`.
Status: Supported by the staged dataset columns `userId`, `title`, and `rating`. No staged user-item-matrix artifact is currently present.

1e. Perform user-based collaborative filtering.
Status: This PDF requirement is identified from the copied directions file. No staged collaborative-filtering artifact is currently present.

1f. Fill row-wise NaN values in the user-item matrix with the corresponding user's mean ratings.
Status: This PDF requirement is identified from the copied directions file. No staged imputed user-item matrix is currently present.

1g. Find the Pearson correlation between users.
Status: This PDF requirement is identified from the copied directions file. No staged user-correlation artifact is currently present.

1h. Choose the correlation of all users with only User 1.
Status: This PDF requirement is identified from the copied directions file. No staged user-correlation subset is currently present.

1i. Sort the User 1 correlation in descending order.
Status: This PDF requirement is identified from the copied directions file. No staged sorted-correlation artifact is currently present.

1j. Drop the NaN values generated in the correlation matrix.
Status: This PDF requirement is identified from the copied directions file. No staged cleaned-correlation artifact is currently present.

1k. Choose the top 50 users that are highly correlated to User 1.
Status: This PDF requirement is identified from the copied directions file. No staged top-user artifact is currently present.

1l. Predict the rating that User 1 might give for the movie with `movieId 32` based on the top 50 user correlation matrix.
Status: Supported by the copied PDF task line. No staged prediction artifact is currently present.

1m. Perform item-based collaborative filtering.
Status: This PDF requirement is identified from the copied directions file. No staged item-filtering artifact is currently present.

1n. Fill column-wise NaN values in the user-item matrix with the corresponding movie mean ratings.
Status: This PDF requirement is identified from the copied directions file. No staged imputed item matrix is currently present.

1o. Find the Pearson correlation between movies.
Status: This PDF requirement is identified from the copied directions file. No staged movie-correlation artifact is currently present.

1p. Choose the correlation of all movies with `Jurassic Park (1993)` only.
Status: This PDF requirement is identified from the copied directions file. No staged movie-correlation subset is currently present.

1q. Sort the `Jurassic Park (1993)` movie correlation in descending order.
Status: This PDF requirement is identified from the copied directions file. No staged sorted movie-correlation artifact is currently present.

1r. Drop the NaN values generated in the movie correlation matrix.
Status: This PDF requirement is identified from the copied directions file. No staged cleaned movie-correlation artifact is currently present.

1s. Find 10 movies similar to `Jurassic Park (1993)`.
Status: This PDF requirement is identified from the copied directions file. No staged similar-movies artifact is currently present.

1t. Perform KNNBasic model-based collaborative filtering.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1u. Initialize KNNBasic with Mean Squared Distance Similarity (`msd`), 20 neighbors, and 5-fold cross-validation against RMSE.
Status: The copied PDF states these model settings explicitly. No staged cross-validation artifact is currently present.

1v. Initialize Singular Value Decomposition (SVD) and cross-validate 5 folds against RMSE.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1w. Initialize Non-Negative Matrix Factorization (NMF) and cross-validate 5 folds against RMSE.
Status: This PDF requirement is identified from the copied directions file. No staged model artifact is currently present.

1x. Print the best score and best parameters from cross validation on all built models.
Status: This PDF requirement is identified from the copied directions file. No staged comparison artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 8 directions file: 24
- Dataset-backed items currently supported by staged source files in this capstone folder: 4
- PDF-only items still awaiting notebook, recommendation, model, or evaluation evidence: 20