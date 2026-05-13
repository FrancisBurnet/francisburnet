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

$teachableMachineProjectUrl = 'https://teachablemachine.withgoogle.com/train/image';
$teachableMachineGuideUrl = 'https://teachablemachine.withgoogle.com/';
?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Teachable Machine Add-On</h2>
    <p>This add-on turns the face-mask classification problem into a fast browser-based prototype so the Session 10 workflow can be tested with live camera samples before or after the transfer-learning notebook run.</p>
    <div class="row g-3 mt-1 mb-3">
        <div class="col-lg-4">
            <div class="artifact-card p-3 h-100">
                <span class="artifact-label mb-2">Rapid Prototype</span>
                <h3 class="h5">Embedded Trainer</h3>
                <p class="mb-3">The trainer below opens the live Teachable Machine image workflow directly on the page so users can see the two-class setup, sample gathering controls, and preview panel without leaving Session 10.</p>
                <div class="artifact-actions">
                    <a class="btn btn-primary" href="<?php echo htmlspecialchars($teachableMachineProjectUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Full Trainer</a>
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars($teachableMachineGuideUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Guide</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="artifact-card p-3 h-100">
                <span class="artifact-label mb-2">Preload Reality</span>
                <h3 class="h5">What Can Be Ready To Go</h3>
                <p class="mb-3">The generic Teachable Machine trainer can be embedded, but it is not exposing a URL-based way for this site to preload our mask and no-mask samples into the editable trainer. Without a saved Teachable Machine project link or a separately exported hosted model, the embed starts at the ready-to-configure training screen rather than with sample data already loaded.</p>
                <ul class="mb-0 ps-3">
                    <li>The embedded trainer is ready for immediate sample capture or upload.</li>
                    <li>Preloaded examples would require a saved Teachable Machine project or exported demo assets that are not currently staged in this repo.</li>
                    <li>A future hosted-model demo could show live predictions immediately if we decide to create and publish one.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="artifact-card p-3 h-100">
                <span class="artifact-label mb-2">Capstone Fit</span>
                <h3 class="h5">Map It Back To Session 10</h3>
                <p class="mb-3">Use the add-on as a lightweight preflight check for class separation, camera framing, and label quality, then compare that quick browser model against the stronger EfficientNetB0 and ResNet50 runs saved with this capstone.</p>
                <div class="artifact-actions">
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_absolute_url($summaryPath, false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Summary JSON</a>
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_absolute_url($capstoneRoot . '/outputs/session_10_model_comparison.csv', false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Model Comparison</a>
                </div>
            </div>
        </div>
    </div>
    <div class="interactive-lab-shell mb-3">
        <iframe class="teachable-machine-frame" src="<?php echo htmlspecialchars($teachableMachineProjectUrl, ENT_QUOTES, 'UTF-8'); ?>" title="Session 10 Teachable Machine Trainer" loading="lazy"></iframe>
    </div>
    <div class="evidence-card p-3 mt-3">
        <span class="artifact-label mb-2">Suggested Validation Flow</span>
        <ol class="mb-0 ps-3">
            <li>Review the embedded trainer layout so users can immediately see the two default classes, sample controls, and preview/export areas.</li>
            <li>Create a two-class Teachable Machine image project for mask and no-mask samples by adding webcam or uploaded examples.</li>
            <li>Capture examples under different lighting and camera angles to stress-test class separation.</li>
            <li>Review the Session 10 notebook outputs and compare where the browser prototype fails versus the transfer-learning models.</li>
            <li>Use the differences to explain why the notebook-backed models are the formal capstone solution.</li>
        </ol>
    </div>
</section>
