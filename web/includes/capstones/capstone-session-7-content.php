<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Machine Learning Using Python/Capstone Session 7';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_7.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_7_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_7.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_7_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];

$capstoneScopeIntro = 'Capstone 7 turns the copied clustering assignment into an executed PCA and KMeans workflow with saved variance, elbow, and cluster-scatter outputs.';
$capstoneScopeDetails = [
    'Primary staged dataset: CC GENERAL.csv.',
    'Notebook evidence plus covariance, cluster assignment, and summary exports are staged under outputs/.',
];

$walkthrough = [
    [
        'id' => '7a',
        'title' => 'Clean The Credit Card Dataset And Scale The Features',
        'notebookSection' => 'Load, null-handling, and scaling cells',
        'requirement' => 'Load the dataset, check nulls, handle missing values, and apply StandardScaler before PCA.',
        'summary' => 'The notebook removes the identifier column, fills the missing credit-limit and minimum-payment fields with medians, and scales the remaining numeric feature set for PCA.',
        'results' => [
            'Missing-value counts filled: ' . json_encode($summaryData['filled_missing_values'] ?? new stdClass()) . '.',
            'Scaling is applied to the full feature matrix before PCA fitting.',
        ],
        'code' => "working_df = df.drop(columns=['CUST_ID']).copy()\nfor column in working_df.columns:\n    if working_df[column].isna().any():\n        working_df[column] = working_df[column].fillna(working_df[column].median())\nscaled = scaler.fit_transform(working_df)",
    ],
    [
        'id' => '7b',
        'title' => 'Use PCA To Measure Variance Coverage And Covariance',
        'notebookSection' => 'Full PCA and covariance cells',
        'requirement' => 'Plot cumulative explained variance, identify the components covering 85% of variance, and inspect covariance structure.',
        'summary' => 'The notebook exports the cumulative explained-variance curve, records the component count needed to cover 85% variance, and saves the PCA covariance matrix as a CSV artifact.',
        'results' => [
            'Components needed to cover 85% variance: ' . (string) ($summaryData['components_for_85_percent_variance'] ?? 'n/a') . '.',
            'Top covariance pair: ' . implode(' and ', $summaryData['top_covariance_pair']['columns'] ?? ['n/a']) . '.',
        ],
        'code' => "pca_full = PCA()\npca_full.fit(scaled)\nexplained = np.cumsum(pca_full.explained_variance_ratio_)\ncomponents_needed = int(np.argmax(explained >= 0.85) + 1)",
        'artifacts' => [
            ['label' => 'PCA Explained Variance', 'path' => $capstoneRoot . '/outputs/plots/pca_explained_variance.png', 'summary' => 'Saved cumulative explained-variance chart.'],
            ['label' => 'KMeans Elbow', 'path' => $capstoneRoot . '/outputs/plots/kmeans_elbow.png', 'summary' => 'Saved elbow-method chart for cluster count selection.'],
        ],
    ],
    [
        'id' => '7c',
        'title' => 'Run KMeans And Visualize The Final Clusters',
        'notebookSection' => 'KMeans clustering and scatter-plot cells',
        'requirement' => 'Use the elbow method to select the cluster count, run KMeans on the 2-component PCA space, and plot the clusters.',
        'summary' => 'The notebook measures inertia across 2 to 11 clusters, selects the elbow point, and exports the final 2D PCA scatter plot plus the cluster assignments CSV.',
        'results' => [
            'Selected cluster count: ' . (string) ($summaryData['ideal_clusters'] ?? 'n/a') . '.',
            'Cluster-size summary: ' . json_encode($summaryData['cluster_sizes'] ?? new stdClass()) . '.',
            'Cluster assignments are exported as CSV for site review.',
        ],
        'code' => "final_model = KMeans(n_clusters=ideal_clusters, random_state=42, n_init=20)\nclusters = final_model.fit_predict(pca_features)\ncluster_df = pd.DataFrame({'pca_1': pca_features[:, 0], 'pca_2': pca_features[:, 1], 'cluster': clusters})",
        'artifacts' => [
            ['label' => 'Cluster Scatter Plot', 'path' => $capstoneRoot . '/outputs/plots/cluster_scatter.png', 'summary' => 'Saved 2D PCA cluster scatter plot.'],
        ],
    ],
];

$extraAssetLinks = [
    ['label' => 'Cluster Assignments CSV', 'path' => $capstoneRoot . '/outputs/session_7_cluster_assignments.csv', 'summary' => 'Exported cluster labels in PCA space.'],
    ['label' => 'Covariance Matrix CSV', 'path' => $capstoneRoot . '/outputs/session_7_covariance_matrix.csv', 'summary' => 'Exported PCA covariance matrix for the feature set.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_7_summary.json', 'summary' => 'Structured summary of PCA coverage, top covariance pair, and cluster sizes.'],
];

$verificationFlow = [
    'Null handling and feature scaling.',
    'PCA explained-variance review and covariance export.',
    'KMeans elbow analysis and final cluster scatter plot.',
    'Cluster assignment and summary exports.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 7 notebook for the copied PCA and KMeans workflow.'],
    ['label' => 'Source Dataset', 'url' => project_artifact_absolute_url($capstoneRoot . '/CC GENERAL.csv', false, true), 'note' => 'Original credit-card dataset staged with the copied capstone files.'],
    ['label' => 'Cluster Assignments CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/session_7_cluster_assignments.csv', false, true), 'note' => 'Exported cluster labels in the 2-component PCA space.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of variance coverage, covariance, and final cluster counts.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_7.ipynb.',
    'CSV exports include the covariance matrix and the final cluster assignments.',
    'Plot artifacts cover cumulative explained variance, elbow selection, and the final cluster scatter view.',
];

$keyFindings = [
    'The current 85% variance threshold is reached with ' . (string) ($summaryData['components_for_85_percent_variance'] ?? 'n/a') . ' components.',
    'The elbow-selection process currently lands on ' . (string) ($summaryData['ideal_clusters'] ?? 'n/a') . ' clusters.',
    'The page now surfaces both the PCA reasoning and the final cluster evidence from the copied Session 7 workflow.',
];

require __DIR__ . '/session-custom-renderer.php';
