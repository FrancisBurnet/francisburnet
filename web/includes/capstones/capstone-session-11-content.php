<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Deep Learning Specialization/Capstone Session 11';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_11.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_11_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_11.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_11_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];

$capstoneScopeIntro = 'Capstone 11 converts the copied review-classification assignment into an executed CNN-LSTM notebook with a converted CSV handoff, training history, prediction samples, and saved summary outputs.';
$capstoneScopeDetails = [
    'Primary staged source file: GrammarandProductReviews.xlsx.',
    'The executed notebook converts the workbook to CSV first and preserves that conversion as an output artifact for the site workflow.',
];

$walkthrough = [
    [
        'id' => '11a',
        'title' => 'Load The Workbook And Create The Target Column',
        'notebookSection' => 'Workbook load and target-engineering cells',
        'requirement' => 'Load the staged review data, reconcile the workbook-versus-CSV mismatch, and create the target column from reviews.rating.',
        'summary' => 'The notebook reads the staged workbook, exports a converted CSV for the site, and creates the binary target the copied PDF describes from reviews.rating.',
        'results' => [
            'Converted CSV artifact: ' . (string) ($summaryData['converted_csv_path'] ?? 'n/a') . '.',
            'Target distribution is ' . json_encode($summaryData['target_distribution'] ?? new stdClass()) . '.',
        ],
        'code' => "df = pd.read_excel(WORKBOOK_PATH)\ndf.to_csv(converted_csv_path, index=False)\ndf['target'] = (df['reviews.rating'] > 3).astype(int)",
    ],
    [
        'id' => '11b',
        'title' => 'Tokenize And Pad The Review Text',
        'notebookSection' => 'Tokenizer and sequence-preparation cells',
        'requirement' => 'Tokenize the text with MAX_NB_WORDS = 20000 and pad the train/test sequences to MAX_SEQUENCE_LENGTH = 150.',
        'summary' => 'The notebook follows the copied PDF constants directly and prepares padded train/test tensors before the CNN-LSTM model is built.',
        'results' => [
            'MAX_NB_WORDS = ' . (string) ($summaryData['max_nb_words'] ?? 'n/a') . '.',
            'MAX_SEQUENCE_LENGTH = ' . (string) ($summaryData['max_sequence_length'] ?? 'n/a') . '.',
        ],
        'code' => "tokenizer = tf.keras.preprocessing.text.Tokenizer(num_words=MAX_NB_WORDS)\ntokenizer.fit_on_texts(X_train)\nX_train_pad = tf.keras.preprocessing.sequence.pad_sequences(X_train_seq, maxlen=MAX_SEQUENCE_LENGTH)",
    ],
    [
        'id' => '11c',
        'title' => 'Train And Evaluate The CNN-LSTM Hybrid Model',
        'notebookSection' => 'Model build, fit, and evaluation cells',
        'requirement' => 'Build the CNN-LSTM hybrid network, train it for 5 epochs with batch size 64, and report the test loss and accuracy.',
        'summary' => 'The notebook exports training history, prediction samples, and the final evaluation summary for the copied CNN-LSTM workflow.',
        'results' => [
            'Test accuracy is ' . (string) round((float) ($summaryData['test_accuracy'] ?? 0.0), 4) . '.',
            'Test loss is ' . (string) round((float) ($summaryData['test_loss'] ?? 0.0), 4) . '.',
        ],
        'code' => "model = tf.keras.Sequential([... tf.keras.layers.Conv1D(...), tf.keras.layers.LSTM(64), tf.keras.layers.Dense(2, activation='softmax')])\nhistory = model.fit(...)\ntest_loss, test_accuracy = model.evaluate(X_test_pad, y_test_onehot, verbose=0)",
        'artifacts' => [
            ['label' => 'Training History', 'path' => $capstoneRoot . '/outputs/plots/training_history.png', 'summary' => 'Saved accuracy and loss curves for the CNN-LSTM run.'],
        ],
    ],
];

$extraAssetLinks = [
    ['label' => 'Converted CSV', 'path' => $capstoneRoot . '/outputs/GrammarandProductReviews_converted.csv', 'summary' => 'CSV export created from the staged workbook source.'],
    ['label' => 'Training History CSV', 'path' => $capstoneRoot . '/outputs/session_11_training_history.csv', 'summary' => 'Exported epoch-by-epoch loss and accuracy history.'],
    ['label' => 'Prediction Samples CSV', 'path' => $capstoneRoot . '/outputs/session_11_prediction_samples.csv', 'summary' => 'Exported sample review predictions from the test split.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_11_summary.json', 'summary' => 'Structured summary of target distribution and evaluation metrics.'],
];

$verificationFlow = [
    'Workbook-to-CSV conversion and target creation.',
    'Tokenizer, sequence, and padding preparation.',
    'CNN-LSTM training-history export.',
    'Prediction-sample and evaluation-summary outputs.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 11 CNN-LSTM notebook.'],
    ['label' => 'Source Workbook', 'url' => project_artifact_absolute_url($capstoneRoot . '/GrammarandProductReviews.xlsx', false, true), 'note' => 'Original staged workbook source file.'],
    ['label' => 'Converted CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/GrammarandProductReviews_converted.csv', false, true), 'note' => 'Converted CSV created by the executed notebook.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of target distribution and test metrics.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_11.ipynb.',
    'The workbook-to-CSV conversion is preserved as a staged output artifact.',
    'Training-history and prediction-sample exports are staged for the site workflow.',
];

$keyFindings = [
    'Test accuracy is ' . (string) round((float) ($summaryData['test_accuracy'] ?? 0.0), 4) . '.',
    'The workbook-versus-CSV mismatch is resolved explicitly by exporting a converted CSV artifact.',
    'TensorFlow Playground remains optional concept support while the notebook and outputs remain the evidence layer.',
];

require __DIR__ . '/session-custom-renderer.php';
