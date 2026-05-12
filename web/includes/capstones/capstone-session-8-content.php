<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Machine Learning Using Python/Capstone Session 8';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_8.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_8_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_8.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_8_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];
$bestModel = (string) ($summaryData['best_model']['model'] ?? 'Best model');

$capstoneScopeIntro = 'Capstone 8 turns the copied recommendation assignment into an executed notebook with user-based, item-based, and model-based recommendation outputs staged for the site workflow.';
$capstoneScopeDetails = [
    'Primary staged datasets: movies.csv and ratings.csv.',
    'The notebook exports recommendation outputs, model-cross-validation results, and a structured summary JSON.',
];

$walkthrough = [
    [
        'id' => '8a',
        'title' => 'Merge The Ratings Data And Build The User-Item Matrix',
        'notebookSection' => 'Load, merge, and pivot-table cells',
        'requirement' => 'Load both CSV files, merge on movieId, and create the user-item matrix required for collaborative filtering.',
        'summary' => 'The notebook merges ratings with movie titles and creates the full user-item matrix that anchors the user-based, item-based, and model-based recommendation steps.',
        'results' => [
            'The staged movie with movieId 32 is ' . (string) ($summaryData['movie_id_32_title'] ?? 'n/a') . '.',
            'User-based and item-based recommendation steps both start from the same merged pivot-table structure.',
        ],
        'code' => "merged = ratings.merge(movies[['movieId', 'title']], on='movieId', how='left')\nuser_item = merged.pivot_table(index='userId', columns='title', values='rating')",
    ],
    [
        'id' => '8b',
        'title' => 'Run User-Based And Item-Based Collaborative Filtering',
        'notebookSection' => 'Correlation and recommendation cells',
        'requirement' => 'Compute user correlations for User 1, predict the rating for movieId 32, and find 10 movies similar to Jurassic Park (1993).',
        'summary' => 'The notebook fills row-wise and column-wise NaN values, computes the required correlation views, predicts User 1 rating for movieId 32, and exports the top similar movies for Jurassic Park.',
        'results' => [
            'Predicted User 1 rating for movieId 32: ' . (string) ($summaryData['predicted_user_1_rating_for_movie_32'] ?? 'n/a') . '.',
            'Similar-movie results for Jurassic Park are exported as CSV.',
        ],
        'code' => "user_corr = user_filled.T.corr()\njurassic_similar = movie_corr['Jurassic Park (1993)'].drop(index='Jurassic Park (1993)').dropna().sort_values(ascending=False).head(10)",
        'artifacts' => [
            ['label' => 'Model-Based RMSE Comparison', 'path' => $capstoneRoot . '/outputs/plots/model_based_rmse.png', 'summary' => 'Saved comparison chart for the model-based recommendation workflows.'],
        ],
    ],
    [
        'id' => '8c',
        'title' => 'Evaluate The Model-Based Recommendation Workflows',
        'notebookSection' => 'KNN-style MSD, SVD, and NMF evaluation cells',
        'requirement' => 'Evaluate the model-based recommendation approaches and compare the best RMSE result.',
        'summary' => 'The notebook records a compatible environment fallback for the unavailable scikit-surprise wheel, then evaluates KNN-style MSD, SVD, and NMF over 5-fold RMSE using the staged ratings matrix.',
        'results' => [
            'Current best model by average RMSE: ' . $bestModel . '.',
            'The environment note explains why scikit-surprise could not be built in the current Windows Python 3.12 environment.',
        ],
        'code' => "kf = KFold(n_splits=5, shuffle=True, random_state=42)\nfold_results = pd.DataFrame(fold_records)\nsummary_results = fold_results.groupby(['model', 'parameters'], as_index=False)['rmse'].mean()",
    ],
];

$extraAssetLinks = [
    ['label' => 'Top 50 User Correlations CSV', 'path' => $capstoneRoot . '/outputs/session_8_top_50_user_correlations.csv', 'summary' => 'Exported top-50 user-correlation table for User 1.'],
    ['label' => 'Similar Movies CSV', 'path' => $capstoneRoot . '/outputs/session_8_similar_movies.csv', 'summary' => 'Exported list of 10 movies similar to Jurassic Park (1993).'],
    ['label' => 'Model CV Results CSV', 'path' => $capstoneRoot . '/outputs/session_8_model_cv_results.csv', 'summary' => 'Exported 5-fold RMSE results for the model-based recommendation workflows.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_8_summary.json', 'summary' => 'Structured summary of user-based predictions, item-based results, and model comparison.'],
];

$verificationFlow = [
    'Merged ratings matrix and pivot-table setup.',
    'User-based rating prediction for movieId 32.',
    'Item-based similar-movie search for Jurassic Park (1993).',
    'Model-based RMSE comparison with environment-note fallback.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 8 notebook for the copied recommendation workflow.'],
    ['label' => 'Movies CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/movies.csv', false, true), 'note' => 'Staged movie-title source file.'],
    ['label' => 'Ratings CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/ratings.csv', false, true), 'note' => 'Staged movie-ratings source file.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of predictions, similar movies, and best model.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_8.ipynb.',
    'CSV exports capture the top-50 user correlations, the Jurassic Park similar-movie list, and the model-CV RMSE table.',
    'The site now has a saved comparison chart for the model-based recommendation workflows.',
];

$keyFindings = [
    'MovieId 32 maps to ' . (string) ($summaryData['movie_id_32_title'] ?? 'n/a') . '.',
    'The current best model-based recommendation result is ' . $bestModel . '.',
    'The environment note is preserved in the outputs so the site explains the scikit-surprise build constraint directly instead of hiding it.',
];

require __DIR__ . '/session-custom-renderer.php';
