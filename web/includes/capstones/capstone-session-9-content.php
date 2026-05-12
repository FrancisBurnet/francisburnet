<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Deep Learning Specialization/Capstone Session 9';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_9.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_9_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_9.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_9_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];

$capstoneScopeIntro = 'Capstone 9 converts the copied churn-prediction assignment into an executed TensorFlow ANN workflow with saved training history, confusion-matrix evidence, and sample-customer scoring.';
$capstoneScopeDetails = [
    'Primary staged dataset: Churn_Modeling.csv.',
    'Training history, prediction samples, and summary outputs are staged under outputs/.',
];

$walkthrough = [
    [
        'id' => '9a',
        'title' => 'Prepare The Churn Dataset For ANN Training',
        'notebookSection' => 'Load, drop, encode, and split cells',
        'requirement' => 'Drop personal-data columns, encode Geography and Gender, and split the dataset 80:20 with random_state 0.',
        'summary' => 'The notebook removes RowNumber, CustomerId, and Surname, applies scaling plus one-hot encoding, and prepares the processed feature matrix for the ANN.',
        'results' => [
            'Dataset shape is ' . json_encode($summaryData['dataset_shape'] ?? []) . '.',
            'Processed feature count is ' . (string) ($summaryData['processed_feature_count'] ?? 'n/a') . '.',
        ],
        'code' => "working_df = df.drop(columns=['RowNumber', 'CustomerId', 'Surname']).copy()\npreprocessor = ColumnTransformer([...])\nX_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=0, stratify=y)",
    ],
    [
        'id' => '9b',
        'title' => 'Build And Train The Required ANN',
        'notebookSection' => 'Sequential-model and fit cells',
        'requirement' => 'Create the ANN with a 6-neuron ReLU dense layer, a 1-neuron sigmoid output layer, and train it with Adam and binary_crossentropy.',
        'summary' => 'The notebook trains the ANN for the copied Session 9 workflow and exports a training-history CSV plus the line chart used by the site page.',
        'results' => [
            'The training-history CSV is exported as session_9_training_history.csv.',
            'Accuracy and loss histories are saved as plot artifacts for the page.',
        ],
        'code' => "model = tf.keras.Sequential([tf.keras.layers.Input(shape=(X_train_processed.shape[1],)), tf.keras.layers.Dense(6, activation='relu'), tf.keras.layers.Dense(1, activation='sigmoid')])\nmodel.compile(optimizer='adam', loss='binary_crossentropy', metrics=['accuracy'])",
        'artifacts' => [
            ['label' => 'Training History', 'path' => $capstoneRoot . '/outputs/plots/training_history.png', 'summary' => 'Saved accuracy and loss curves across epochs.'],
            ['label' => 'Confusion Matrix', 'path' => $capstoneRoot . '/outputs/plots/confusion_matrix.png', 'summary' => 'Saved confusion-matrix heatmap for the held-out test set.'],
        ],
    ],
    [
        'id' => '9c',
        'title' => 'Evaluate The Test Set And Score The Sample Customer',
        'notebookSection' => 'Evaluation and sample-prediction cells',
        'requirement' => 'Evaluate the ANN on the test set and predict whether the specified customer should be allowed to go.',
        'summary' => 'The notebook exports prediction samples for the held-out split and also scores the exact sample customer required by the copied PDF.',
        'results' => [
            'Test accuracy is ' . (string) round((float) ($summaryData['test_accuracy'] ?? 0.0), 4) . '.',
            'Sample-customer decision: ' . (string) ($summaryData['sample_customer_decision'] ?? 'n/a') . '.',
        ],
        'code' => "test_probabilities = model.predict(X_test_processed, verbose=0).ravel()\nsample_probability = float(model.predict(sample_processed, verbose=0).ravel()[0])\nsample_decision = 'Do not allow to go' if sample_prediction == 1 else 'Allow to stay'",
    ],
];

$extraAssetLinks = [
    ['label' => 'Training History CSV', 'path' => $capstoneRoot . '/outputs/session_9_training_history.csv', 'summary' => 'Exported epoch-by-epoch loss and accuracy history.'],
    ['label' => 'Prediction Samples CSV', 'path' => $capstoneRoot . '/outputs/session_9_prediction_samples.csv', 'summary' => 'Exported sample predictions for the held-out test set.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_9_summary.json', 'summary' => 'Structured summary of evaluation metrics and sample-customer scoring.'],
];

$verificationFlow = [
    'Feature preparation and encoded churn inputs.',
    'ANN architecture and training-history outputs.',
    'Held-out confusion-matrix and prediction-sample exports.',
    'Sample-customer decision for the copied PDF prompt.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 9 TensorFlow notebook.'],
    ['label' => 'Source Dataset', 'url' => project_artifact_absolute_url($capstoneRoot . '/Churn_Modeling.csv', false, true), 'note' => 'Staged churn-modeling dataset used for the ANN workflow.'],
    ['label' => 'Training History CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/session_9_training_history.csv', false, true), 'note' => 'Exported epoch-by-epoch training history.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of ANN evaluation metrics and sample-customer decision.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_9.ipynb.',
    'Training-history and confusion-matrix PNGs are staged for direct review.',
    'Prediction samples and structured summary exports are staged under outputs/.',
];

$keyFindings = [
    'Held-out test accuracy is ' . (string) round((float) ($summaryData['test_accuracy'] ?? 0.0), 4) . '.',
    'The sample customer is currently classified as ' . (string) ($summaryData['sample_customer_decision'] ?? 'n/a') . '.',
    'TensorFlow Playground remains an optional concept lab while the notebook and saved artifacts stay the grading evidence.',
];

require __DIR__ . '/session-custom-renderer.php';
