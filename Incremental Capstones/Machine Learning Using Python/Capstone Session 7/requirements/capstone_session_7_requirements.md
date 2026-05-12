# Capstone Session 7 Requirements

Source directions file: `Capstone_Session_7.pdf`
Source staged dataset: `CC GENERAL.csv`

## 1. Clustering Credit Card Users with PCA and K-means

1a. Cluster the credit card users into different groups to find meaningful patterns.
Status: The copied PDF states this clustering objective explicitly. No staged notebook, cluster report, or output artifact is currently present.

1b. Use Principal Component Analysis (PCA) to reduce the dimension of the feature space.
Status: This PDF requirement is identified from the copied directions file. No staged PCA artifact is currently present.

1c. Use the K-means algorithm to find clusters.
Status: This PDF requirement is identified from the copied directions file. No staged clustering artifact is currently present.

1d. Import relevant Python libraries.
Status: This PDF requirement is identified from the copied directions file. No staged notebook or script is currently present.

1e. Load dataset `CC GENERAL.csv`.
Status: Supported by the copied dataset staged in this capstone folder.

1f. Check for null values.
Status: This PDF requirement is identified from the copied directions file. No staged data-audit artifact is currently present.

1g. Handle the null values.
Status: This PDF requirement is identified from the copied directions file. No staged cleaning artifact is currently present.

1h. Perform feature scaling using `StandardScaler`.
Status: The copied PDF states this preprocessing step explicitly. No staged scaling artifact is currently present.

1i. Perform PCA with all columns.
Status: Supported by the staged dataset, which includes 18 source columns. No staged PCA artifact is currently present.

1j. Plot number of components versus PCA cumulative explained variance.
Status: This PDF requirement is identified from the copied directions file. No staged explained-variance plot is currently present.

1k. Identify the number of components required to cover 85 percent of the variance.
Status: This PDF requirement is identified from the copied directions file. No staged PCA selection artifact is currently present.

1l. Perform PCA with 2 principal components for clustering visualization.
Status: This PDF requirement is identified from the copied directions file. No staged 2-component PCA artifact is currently present.

1m. Find the 2 columns that give the most covariances.
Status: This PDF requirement is identified from the copied directions file. No staged covariance artifact is currently present.

1n. Interpret the PCA results by looking at the covariance matrix using `get_covariance()`.
Status: The copied PDF states this interpretation step explicitly. No staged covariance interpretation artifact is currently present.

1o. Perform K Means clustering on the 2-component PCA transformed data with clusters ranging from 2 to 11.
Status: This PDF requirement is identified from the copied directions file. No staged clustering-run artifact is currently present.

1p. Plot K Means inertia against the number of clusters using the Elbow Method.
Status: This PDF requirement is identified from the copied directions file. No staged elbow plot artifact is currently present.

1q. Identify the ideal number of clusters from the elbow plot.
Status: This PDF requirement is identified from the copied directions file. No staged cluster-selection artifact is currently present.

1r. Perform K Means clustering on the 2-component PCA transformed data using the ideal number of clusters.
Status: This PDF requirement is identified from the copied directions file. No staged final clustering artifact is currently present.

1s. Visualize the clusters on a scatter plot between the 1st and 2nd PCA components using different colors for each cluster.
Status: This PDF requirement is identified from the copied directions file. No staged cluster-scatter artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 7 directions file: 19
- Dataset-backed items currently supported by staged source files in this capstone folder: 2
- PDF-only items still awaiting notebook, figure, clustering, or interpretation evidence: 17
