<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Machine Learning Using Python/Capstone Session 5';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_5.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_5_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_5.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_5_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];
$bestModel = (string) ($summaryData['best_model']['model'] ?? 'Best model');

$capstoneScopeIntro = 'Capstone 5 converts the copied bike-rental regression directions into an executed notebook with exploratory plots, encoded feature preparation, exported metrics, and prediction samples.';
$capstoneScopeDetails = [
    'Primary staged dataset: FloridaBikeRentals.csv.',
    'Notebook evidence plus CSV and JSON outputs are staged under outputs/.',
];

$walkthrough = [
    [
        'id' => '5a',
        'title' => 'Load The Dataset And Build The Required Date Features',
        'notebookSection' => 'Load, audit, and feature-engineering cells',
        'requirement' => 'Load the dataset, audit nulls, convert Date, and derive day, month, weekday, and weekend features.',
        'summary' => 'The notebook loads the staged CSV with Latin-1 handling, audits missing values, and derives the calendar fields required by the copied PDF before modeling begins.',
        'results' => [
            'Dataset shape is ' . json_encode($summaryData['dataset_shape'] ?? []) . '.',
            'Derived fields include day, month, day_of_week, and is_weekend.',
            'The null-value audit is recorded before model training.',
        ],
        'code' => "df = pd.read_csv(DATASET_PATH, encoding='latin1')\ndf['Date'] = pd.to_datetime(df['Date'], dayfirst=True)\ndf['day'] = df['Date'].dt.day\ndf['month'] = df['Date'].dt.month\ndf['day_of_week'] = df['Date'].dt.day_name()\ndf['is_weekend'] = df['Date'].dt.dayofweek >= 5",
    ],
    [
        'id' => '5b',
        'title' => 'Produce The Required Exploratory Charts',
        'notebookSection' => 'Correlation, histogram, box-plot, and catplot cells',
        'requirement' => 'Create the heatmap, target distribution plot, histograms, categorical box plots, and the required catplot comparisons.',
        'summary' => 'The notebook exports the full exploratory plot bundle directly into outputs/plots so the site can surface the exact evidence files rather than describing them abstractly.',
        'results' => [
            'The plot bundle includes a correlation heatmap, target distribution plot, histograms, box plots, and feature comparison charts.',
            'Catplot inference notes are exported in the summary JSON for Hour, Holiday, Rainfall, Snowfall, weekday, and weekend comparisons.',
        ],
        'code' => "sns.heatmap(numeric_df.corr(numeric_only=True), cmap='coolwarm', center=0)\nsns.histplot(df['Rented Bike Count'], kde=True)\nfor column in ['Seasons', 'Holiday', 'Functioning Day']:\n    sns.boxplot(data=df, x=column, y='Rented Bike Count')",
        'artifacts' => [
            ['label' => 'Correlation Heatmap', 'path' => $capstoneRoot . '/outputs/plots/correlation_heatmap.png', 'summary' => 'Saved heatmap for the numeric feature correlation scan.'],
            ['label' => 'Target Distribution', 'path' => $capstoneRoot . '/outputs/plots/rented_bike_count_distribution.png', 'summary' => 'Saved distribution plot for the target variable.'],
            ['label' => 'Model Error Comparison', 'path' => $capstoneRoot . '/outputs/plots/model_error_comparison.png', 'summary' => 'Saved comparison plot for RMSE and MAE values.'],
        ],
    ],
    [
        'id' => '5c',
        'title' => 'Encode Features, Scale Inputs, And Compare Regression Models',
        'notebookSection' => 'Model-preparation and model-comparison cells',
        'requirement' => 'Encode categorical features, split the data 80:20 with random_state 1, standard-scale the inputs, and compare Linear, Lasso, and Ridge Regression.',
        'summary' => 'The notebook stages a get_dummies preview, then trains the three required regression models inside a scaled preprocessing pipeline and exports the comparison metrics.',
        'results' => [
            'Best model by RMSE: ' . $bestModel . '.',
            'Train rows: ' . (string) ($summaryData['train_rows'] ?? 'n/a') . '; test rows: ' . (string) ($summaryData['test_rows'] ?? 'n/a') . '.',
            'Model metrics and prediction samples are exported as CSV artifacts.',
        ],
        'code' => "X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=1)\npipeline = Pipeline([('preprocessor', preprocessor), ('model', estimator)])\npipeline.fit(X_train, y_train)\npredictions = pipeline.predict(X_test)",
    ],
];

$extraAssetLinks = [
    ['label' => 'Model Metrics CSV', 'path' => $capstoneRoot . '/outputs/session_5_model_metrics.csv', 'summary' => 'Exported RMSE, MAE, and R2 comparison for the three regression models.'],
    ['label' => 'Prediction Samples CSV', 'path' => $capstoneRoot . '/outputs/session_5_prediction_samples.csv', 'summary' => 'Sample prediction rows from the held-out test set.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_5_summary.json', 'summary' => 'Structured summary of dataset shape, best model, and catplot inference notes.'],
    ['label' => 'Histogram Bundle', 'path' => $capstoneRoot . '/outputs/plots/numeric_feature_histograms.png', 'summary' => 'Saved histograms for the numeric feature set.'],
];

$verificationFlow = [
    'Dataset audit and date-feature engineering.',
    'Exploratory plot bundle and catplot inference notes.',
    'Regression model comparison outputs.',
    'Notebook plus CSV and JSON exports.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 5 notebook used as the main evidence source for this page.'],
    ['label' => 'Source Dataset', 'url' => project_artifact_absolute_url($capstoneRoot . '/FloridaBikeRentals.csv', false, true), 'note' => 'Original bike-rental dataset staged with the copied capstone files.'],
    ['label' => 'Model Metrics CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/session_5_model_metrics.csv', false, true), 'note' => 'Exported comparison metrics for Linear, Lasso, and Ridge Regression.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of shapes, best model, and feature-level inference notes.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_5.ipynb.',
    'CSV exports include model metrics and prediction samples for the held-out split.',
    'Plot artifacts cover correlation, distribution, histograms, box plots, and model-comparison visuals.',
];

$keyFindings = [
    'The current best model by RMSE is ' . $bestModel . '.',
    'The exported summary records the strongest hourly demand peak at Hour = ' . (string) (($summaryData['catplot_inferences'][0]['highest_mean_group'] ?? 'n/a')) . '.',
    'The page now surfaces both the exploratory evidence and the model-comparison outputs from the copied Session 5 workflow.',
];

require __DIR__ . '/session-custom-renderer.php';
