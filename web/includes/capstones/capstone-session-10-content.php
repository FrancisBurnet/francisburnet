<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_10.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_10_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_10.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_10_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];
$bestModel = (string) ($summaryData['best_model']['model'] ?? 'Best model');

$capstoneScopeIntro = 'Capstone 10 converts the copied face-mask transfer-learning assignment into an executed TensorFlow workflow with generated train/test folders, training histories, model comparison, and saved prediction examples.';
$capstoneScopeDetails = [
    'Primary staged source folders: data/with_mask and data/without_mask.',
    'The notebook records the PDF mismatch around train/test folders and 3-class output directly in the saved summary JSON.',
];

$walkthrough = [
    [
        'id' => '10a',
        'title' => 'Generate The Missing Train And Test Folders From The Staged Source Images',
        'notebookSection' => 'Generated split cells',
        'requirement' => 'Prepare train and test folder structure for transfer-learning experiments.',
        'summary' => 'Because the copied capstone only stages data/with_mask and data/without_mask, the notebook creates a fixed generated train/test split and records the counts in the split manifest.',
        'results' => [
            'Source image counts: ' . json_encode($summaryData['source_counts'] ?? new stdClass()) . '.',
            'Generated split counts: ' . json_encode($summaryData['generated_counts'] ?? new stdClass()) . '.',
        ],
        'code' => "for class_name in ['with_mask', 'without_mask']:\n    train_files = source_files[:TRAIN_IMAGES_PER_CLASS]\n    test_files = source_files[TRAIN_IMAGES_PER_CLASS:TRAIN_IMAGES_PER_CLASS + TEST_IMAGES_PER_CLASS]\n    shutil.copy2(file_path, GENERATED_SPLIT_DIR / 'train' / class_name / file_path.name)",
    ],
    [
        'id' => '10b',
        'title' => 'Train EfficientNetB0 And ResNet50 Transfer Models',
        'notebookSection' => 'Model build and fit cells',
        'requirement' => 'Build the two transfer-learning models, add the pooling/dropout head, and compare their test performance.',
        'summary' => 'The notebook freezes the pretrained bases, uses the copied 128x128 image size, trains both models with ReduceLROnPlateau and EarlyStopping, and exports both training histories.',
        'results' => [
            'Best current model by test accuracy: ' . $bestModel . '.',
            'The saved outputs preserve both EfficientNetB0 and ResNet50 histories for direct comparison.',
        ],
        'code' => "base_model = tf.keras.applications.EfficientNetB0(include_top=False, weights='imagenet', input_shape=(128, 128, 3))\nmodel = tf.keras.Sequential([tf.keras.layers.Input(shape=(128, 128, 3)), tf.keras.layers.Lambda(preprocess), base_model, tf.keras.layers.GlobalAveragePooling2D(), tf.keras.layers.Dropout(dropout_rate), tf.keras.layers.Dense(2, activation='softmax')])",
        'artifacts' => [
            ['label' => 'EfficientNetB0 History', 'path' => $capstoneRoot . '/outputs/plots/efficientnetb0_training_history.png', 'summary' => 'Saved training history for the EfficientNetB0 run.'],
            ['label' => 'ResNet50 History', 'path' => $capstoneRoot . '/outputs/plots/resnet50_training_history.png', 'summary' => 'Saved training history for the ResNet50 run.'],
            ['label' => 'Model Comparison', 'path' => $capstoneRoot . '/outputs/plots/model_comparison.png', 'summary' => 'Saved test-accuracy comparison across the two transfer models.'],
        ],
    ],
    [
        'id' => '10c',
        'title' => 'Export Prediction Examples And Record The PDF Mismatch Notes',
        'notebookSection' => 'Summary and prediction-example cells',
        'requirement' => 'Compare the models, select the best one, and surface prediction examples from the held-out test images.',
        'summary' => 'The notebook exports a best-model prediction panel plus a JSON summary that preserves the two-class versus three-neuron mismatch and the generated-split note explicitly.',
        'results' => [
            'Best-model prediction examples are saved as a PNG artifact.',
            'The mismatch notes are preserved in session_10_summary.json instead of being hidden or guessed away.',
        ],
        'code' => "summary = {'pdf_mismatch_notes': [...], 'model_results': evaluations, 'best_model': evaluations_df.iloc[0].to_dict()}\njson.dump(summary, handle, indent=2)",
        'artifacts' => [
            ['label' => 'Best-Model Predictions', 'path' => $capstoneRoot . '/outputs/plots/best_model_prediction_examples.png', 'summary' => 'Saved panel showing true and predicted labels for sample test images.'],
        ],
    ],
];

$extraAssetLinks = [
    ['label' => 'Split Manifest JSON', 'path' => $capstoneRoot . '/outputs/session_10_split_manifest.json', 'summary' => 'Exported generated train/test split counts and source totals.'],
    ['label' => 'Model Comparison CSV', 'path' => $capstoneRoot . '/outputs/session_10_model_comparison.csv', 'summary' => 'Exported test-loss and test-accuracy comparison for EfficientNetB0 and ResNet50.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_10_summary.json', 'summary' => 'Structured summary of source mismatch notes, model results, and best-model prediction examples.'],
];

$verificationFlow = [
    'Generated train/test split from the staged source folders.',
    'EfficientNetB0 and ResNet50 transfer-learning runs.',
    'Saved training histories and model-comparison outputs.',
    'Best-model prediction examples and explicit PDF mismatch notes.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 10 transfer-learning notebook.'],
    ['label' => 'Source ZIP', 'url' => project_artifact_absolute_url($capstoneRoot . '/Face_mask_detection.zip', false, true), 'note' => 'Original staged ZIP archive for the face-mask images.'],
    ['label' => 'Split Manifest JSON', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/session_10_split_manifest.json', false, true), 'note' => 'Generated train/test split manifest based on the staged source images.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of mismatch notes, model results, and best-model evidence.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_10.ipynb.',
    'Generated train/test image folders are staged under outputs/generated_split/.',
    'Training histories, model comparison, and best-model prediction examples are saved as reviewable artifacts.',
];

$keyFindings = [
    'The current best transfer-learning result is ' . $bestModel . ' with accuracy ' . (string) round((float) ($summaryData['best_model']['test_accuracy'] ?? 0.0), 4) . '.',
    'The page now surfaces the train/test-folder and class-count mismatches explicitly rather than guessing away the copied-source differences.',
    'TensorFlow Playground remains optional concept support; the notebook and saved outputs are the actual evidence layer.',
];

require __DIR__ . '/session-custom-renderer.php';
