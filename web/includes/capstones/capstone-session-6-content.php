<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Machine Learning Using Python/Capstone Session 6';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_6.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_6_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_6.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_6_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];
$bestModel = (string) ($summaryData['best_model']['model'] ?? 'Best model');

$capstoneScopeIntro = 'Capstone 6 converts the copied Adult Census classification requirements into an executed notebook with cleaning, imbalance repair, exploratory plots, and six-model comparison outputs.';
$capstoneScopeDetails = [
    'Primary staged dataset: adultcensusincome.csv.',
    'The notebook exports model metrics and a structured summary JSON for the site workflow.',
];

$walkthrough = [
    [
        'id' => '6a',
        'title' => 'Audit Nulls And Question-Mark Values',
        'notebookSection' => 'Load, audit, and cleaning cells',
        'requirement' => 'Load the dataset, detect nulls and ? markers, and clean the categorical columns before modeling.',
        'summary' => 'The notebook explicitly records the question-mark counts in workclass, occupation, and native.country, then fills the missing values before downstream analysis.',
        'results' => [
            'Question-mark counts are exported in the summary JSON.',
            'The cleaning step leaves zero missing values for the model pipeline.',
            'The cleaned dataframe is used for all plots and model training steps.',
        ],
        'code' => "df = df.replace(' ?', np.nan).replace('?', np.nan)\nfor column in object_columns:\n    if df[column].isna().any():\n        df[column] = df[column].fillna(df[column].mode().iloc[0])",
        'artifacts' => [
            ['label' => 'Correlation Heatmap', 'path' => $capstoneRoot . '/outputs/plots/correlation_heatmap.png', 'summary' => 'Saved encoded-feature correlation heatmap for the income target review.'],
        ],
    ],
    [
        'id' => '6b',
        'title' => 'Produce The Required Income And Demographic Charts',
        'notebookSection' => 'Distribution and count-plot cells',
        'requirement' => 'Create the income, age, education, marital-status, and grouped count plots required by the copied PDF.',
        'summary' => 'The notebook exports the full demographic plot bundle so the site can show the income balance view, age distribution, and the grouped categorical comparisons directly.',
        'results' => [
            'The class balance summary is recorded as ' . json_encode($summaryData['balance_summary']['class_counts'] ?? new stdClass()) . '.',
            'The plot bundle includes income, age, education, marital status, and grouped income-by-category visuals.',
        ],
        'code' => "income_counts = df['income'].value_counts()\nsns.barplot(x=income_counts.index, y=income_counts.values)\nsns.histplot(df['age'], kde=True)",
        'artifacts' => [
            ['label' => 'Income Barplot', 'path' => $capstoneRoot . '/outputs/plots/income_barplot.png', 'summary' => 'Saved income class count chart.'],
            ['label' => 'Age Distribution', 'path' => $capstoneRoot . '/outputs/plots/age_distribution.png', 'summary' => 'Saved age distribution plot.'],
            ['label' => 'Education Barplot', 'path' => $capstoneRoot . '/outputs/plots/education_barplot.png', 'summary' => 'Saved bar chart for education category counts.'],
            ['label' => 'Education Level Barplot', 'path' => $capstoneRoot . '/outputs/plots/education_num_barplot.png', 'summary' => 'Saved bar chart for the numeric education-level distribution.'],
            ['label' => 'Marital Status Distribution', 'path' => $capstoneRoot . '/outputs/plots/marital_status_pie.png', 'summary' => 'Saved pie chart for the marital status breakdown.'],
            ['label' => 'Income by Education', 'path' => $capstoneRoot . '/outputs/plots/income_by_education.png', 'summary' => 'Saved grouped chart for income distribution by education level.'],
            ['label' => 'Income by Marital Status', 'path' => $capstoneRoot . '/outputs/plots/income_by_marital_status.png', 'summary' => 'Saved grouped chart for income by marital status.'],
            ['label' => 'Income by Sex', 'path' => $capstoneRoot . '/outputs/plots/income_by_sex.png', 'summary' => 'Saved grouped chart for income by gender.'],
            ['label' => 'Income by Age Band', 'path' => $capstoneRoot . '/outputs/plots/income_by_age_band.png', 'summary' => 'Saved grouped chart for income by age band.'],
            ['label' => 'Model Comparison', 'path' => $capstoneRoot . '/outputs/plots/model_comparison.png', 'summary' => 'Saved comparison chart for model accuracy and F1 score.'],
        ],
    ],
    [
        'id' => '6c',
        'title' => 'Encode, Balance, Scale, And Compare Classifiers',
        'notebookSection' => 'Encoding, resampling, and model-training cells',
        'requirement' => 'Label-encode categorical columns, apply StandardScaler, fix class imbalance, and compare Logistic Regression, KNN, SVM, Naive Bayes, Decision Tree, and Random Forest.',
        'summary' => 'The notebook label-encodes the cleaned dataset, uses RandomOverSampler as the explicit imbalance fix, and exports a six-model comparison table scored by accuracy and F1.',
        'results' => [
            'Balanced training distribution is ' . json_encode($summaryData['balanced_train_distribution'] ?? new stdClass()) . '.',
            'Best model by F1/accuracy ranking: ' . $bestModel . '.',
            'The comparison table is exported as session_6_model_metrics.csv.',
        ],
        'code' => "sampler = RandomOverSampler(random_state=42)\nX_train_balanced, y_train_balanced = sampler.fit_resample(X_train_scaled, y_train)\nmodel.fit(X_train_balanced, y_train_balanced)",
    ],
];

$extraAssetLinks = [
    ['label' => 'Model Metrics CSV', 'path' => $capstoneRoot . '/outputs/session_6_model_metrics.csv', 'summary' => 'Exported accuracy and F1 comparison for the six classifiers.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_6_summary.json', 'summary' => 'Structured summary of cleaning counts, class balance, correlations, and best model.'],
    ['label' => 'Correlation Heatmap', 'path' => $capstoneRoot . '/outputs/plots/correlation_heatmap.png', 'summary' => 'Saved encoded-feature correlation heatmap for the income target review.'],
];

$verificationFlow = [
    'Question-mark and null-value audit.',
    'Demographic and target-distribution plot bundle.',
    'Encoded feature correlation review.',
    'Imbalance repair and six-model comparison outputs.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 6 notebook for the copied Adult Census workflow.'],
    ['label' => 'Source Dataset', 'url' => project_artifact_absolute_url($capstoneRoot . '/adultcensusincome.csv', false, true), 'note' => 'Original Adult Census dataset staged with the copied capstone files.'],
    ['label' => 'Model Metrics CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/session_6_model_metrics.csv', false, true), 'note' => 'Accuracy and F1 export for the six evaluated classifiers.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of cleaning counts, class balance, and best model.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_6.ipynb.',
    'The model comparison export ranks six classifiers by accuracy and F1 score.',
    'The plot bundle covers target distribution, age, education, marital status, grouped income counts, and encoded correlation.',
];

$keyFindings = [
    'The class imbalance remains visible in the raw data with counts ' . json_encode($summaryData['balance_summary']['class_counts'] ?? new stdClass()) . '.',
    'The current best model is ' . $bestModel . '.',
    'The page now exposes both the preprocessing evidence and the final classification comparison artifacts.',
];

require __DIR__ . '/session-custom-renderer.php';
