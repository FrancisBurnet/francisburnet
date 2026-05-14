<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_10.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_10_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_10.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_10_summary.json';
$capstoneExportSummaryPath = $capstoneRoot . '/outputs/session_10_capstone_tfjs_export.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];
$capstoneExportSummaryData = file_exists(project_artifact_fs_path($capstoneExportSummaryPath))
    ? json_decode((string) file_get_contents(project_artifact_fs_path($capstoneExportSummaryPath)), true)
    : [];
$capstoneExportSummaryData = is_array($capstoneExportSummaryData) ? $capstoneExportSummaryData : [];
$bestModel = (string) ($summaryData['best_model']['model'] ?? 'Best model');
$capstoneExportAccuracy = (float) ($capstoneExportSummaryData['test_accuracy'] ?? $summaryData['best_model']['test_accuracy'] ?? 0.0);

$capstoneScopeIntro = 'Capstone 10 converts the copied face-mask transfer-learning assignment into an executed TensorFlow workflow with generated train/test folders, training histories, model comparison, and saved prediction examples.';
$capstoneScopeDetails = [
    'Primary staged source folders: data/with_mask, data/without_mask, and data/mask_worn_incorrect (labelled mask_weared_incorrect in the original source archive).',
    'The notebook resolves the source folder name via alias lookup and uses all 3 classes for generated train/test splits and model output.',
];

$walkthrough = [
    [
        'id' => '10a',
        'title' => 'Generate The Missing Train And Test Folders From The Staged Source Images',
        'notebookSection' => 'Generated split cells',
        'requirement' => 'Prepare train and test folder structure for transfer-learning experiments.',
        'summary' => 'The notebook uses all 3 GitHub-backed class folders (with_mask, without_mask, mask_worn_incorrect) to create a fixed generated train/test split and records the counts in the split manifest.',
        'results' => [
            'Source image counts: ' . json_encode($summaryData['source_counts'] ?? new stdClass()) . '.',
            'Generated split counts: ' . json_encode($summaryData['generated_counts'] ?? new stdClass()) . '.',
        ],
        'code' => "for class_name in CLASS_NAMES:  # ['with_mask', 'without_mask', 'mask_worn_incorrect']\n    train_files = source_files[:TRAIN_IMAGES_PER_CLASS]\n    test_files = source_files[TRAIN_IMAGES_PER_CLASS:TRAIN_IMAGES_PER_CLASS + TEST_IMAGES_PER_CLASS]\n    shutil.copy2(file_path, GENERATED_SPLIT_DIR / 'train' / class_name / file_path.name)",
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
        'code' => "base_model = tf.keras.applications.EfficientNetB0(include_top=False, weights='imagenet', input_shape=(128, 128, 3))\nmodel = tf.keras.Sequential([tf.keras.layers.Input(shape=(128, 128, 3)), tf.keras.layers.Lambda(preprocess), base_model, tf.keras.layers.GlobalAveragePooling2D(), tf.keras.layers.Dropout(dropout_rate), tf.keras.layers.Dense(NUM_CLASSES, activation='softmax')])  # NUM_CLASSES=3",
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
$teachableMachineDemoUrl = '/assets/demos/session-10-maskdetector.html';
$teachableMachineHostedModelUrl = '/assets/models/session-10-tm/';
$capstoneModelUrl = '/assets/models/session-10-capstone-resnet50/';
$teachableMachineDemoEmbedUrl = $teachableMachineDemoUrl . '?' . http_build_query([
    'engine' => 'tm',
    'frameId' => 'session10-demo-frame-tm',
    'model' => $teachableMachineHostedModelUrl,
    'eyebrow' => 'Teachable Machine',
    'title' => 'Teachable Machine Demo',
], '', '&', PHP_QUERY_RFC3986);
$capstoneDemoEmbedUrl = $teachableMachineDemoUrl . '?' . http_build_query([
    'engine' => 'capstone',
    'frameId' => 'session10-demo-frame-capstone',
    'model' => $capstoneModelUrl,
    'eyebrow' => 'Our Model',
    'title' => 'Capstone ResNet50 Demo',
], '', '&', PHP_QUERY_RFC3986);
?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Live Mask Detection Demo</h2>
    <p>This section keeps both browser demos visible at once so visitors can compare the hosted Teachable Machine version against the exported Session 10 capstone model using the same sample images, uploads, and optional webcam flow.</p>
    <div class="row g-3 align-items-start mb-3">
        <div class="col-xl-6">
            <div class="interactive-lab-shell h-100">
                <div class="lab-header">
                    <span class="artifact-label">Teachable Machine</span>
                    <p class="mb-0">Hosted browser model for the lightweight comparison path.</p>
                </div>
                <iframe id="session10-demo-frame-tm" data-session10-demo-frame class="teachable-machine-frame teachable-machine-frame--demo" src="<?php echo htmlspecialchars($teachableMachineDemoEmbedUrl, ENT_QUOTES, 'UTF-8'); ?>" title="Session 10 Teachable Machine Demo" loading="lazy" allow="camera; microphone; autoplay" scrolling="no"></iframe>
            </div>
            <div class="artifact-card p-3 mt-3 h-100">
                <span class="artifact-label mb-2">Comparison Card</span>
                <h3 class="h5">Teachable Machine Model</h3>
                <p class="mb-3">This version stays online as the fast hosted benchmark. It remains useful because the sample gallery, uploads, and webcam flow are already tuned for a low-friction public interaction.</p>
                <div class="artifact-actions">
                    <a class="btn btn-primary" href="<?php echo htmlspecialchars($teachableMachineHostedModelUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Hosted Model</a>
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars($teachableMachineProjectUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Trainer Workspace</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="interactive-lab-shell h-100">
                <div class="lab-header">
                    <span class="artifact-label">Capstone Export</span>
                    <p class="mb-0">Actual Session 10 ResNet50 weights exported for in-browser comparison.</p>
                </div>
                <iframe id="session10-demo-frame-capstone" data-session10-demo-frame class="teachable-machine-frame teachable-machine-frame--demo" src="<?php echo htmlspecialchars($capstoneDemoEmbedUrl, ENT_QUOTES, 'UTF-8'); ?>" title="Session 10 Capstone ResNet50 Demo" loading="lazy" allow="camera; microphone; autoplay" scrolling="no"></iframe>
            </div>
            <div class="artifact-card p-3 mt-3 h-100">
                <span class="artifact-label mb-2">Our Model</span>
                <h3 class="h5"><?php echo htmlspecialchars($bestModel, ENT_QUOTES, 'UTF-8'); ?> Browser Export</h3>
                <p class="mb-3">This panel uses the actual Session 10 ResNet50 transfer-learning export. The current browser-ready checkpoint tested at <?php echo htmlspecialchars((string) round($capstoneExportAccuracy, 4), ENT_QUOTES, 'UTF-8'); ?>, so visitors can compare the hosted model against the capstone weights directly on the same page.</p>
                <div class="artifact-actions">
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_absolute_url($notebookPath, false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Notebook</a>
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_absolute_url($summaryPath, false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Saved Metrics</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-lg-6">
            <div class="artifact-card p-3 h-100">
                <span class="artifact-label mb-2">Privacy-Friendly</span>
                <h3 class="h5">No Camera Required</h3>
                <p class="mb-3">The primary flow is sample-driven and upload-first, so both demos still work for visitors who do not want to use their webcam or personal photos.</p>
                <ul class="mb-0 ps-3">
                    <li>Built-in sample thumbnails trigger predictions immediately.</li>
                    <li>Uploading one image is optional, not required.</li>
                    <li>Webcam remains available as a secondary action only.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="artifact-card p-3 h-100">
                <span class="artifact-label mb-2">Capstone Fit</span>
                <h3 class="h5">Same Page, Same Story</h3>
                <p class="mb-3">The paired demos sit directly beside the capstone evidence so users can test the hosted Teachable Machine model and the exported capstone model without leaving the Session 10 story.</p>
                <div class="artifact-actions">
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_absolute_url($summaryPath, false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Summary JSON</a>
                    <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_absolute_url($capstoneRoot . '/outputs/session_10_model_comparison.csv', false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Model Comparison</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var iframes = Array.prototype.slice.call(document.querySelectorAll('[data-session10-demo-frame]'));
    if (!iframes.length) {
        return;
    }

    function setHeight(iframe, height) {
        if (!height || Number.isNaN(height)) {
            return;
        }
        iframe.style.height = Math.max(480, Math.ceil(height)) + 'px';
    }

    function resizeFromIframeDocument(iframe) {
        try {
            var doc = iframe.contentDocument || iframe.contentWindow.document;
            if (!doc) {
                return;
            }
            var nextHeight = Math.max(
                doc.body ? doc.body.scrollHeight : 0,
                doc.documentElement ? doc.documentElement.scrollHeight : 0
            );
            setHeight(iframe, nextHeight);
        } catch (error) {
            // Cross-document access is not expected here, but ignore if it happens.
        }
    }

    iframes.forEach(function (iframe) {
        iframe.addEventListener('load', function () {
            resizeFromIframeDocument(iframe);
            window.setTimeout(function () { resizeFromIframeDocument(iframe); }, 200);
            window.setTimeout(function () { resizeFromIframeDocument(iframe); }, 800);
        });
    });

    window.addEventListener('resize', function () {
        iframes.forEach(resizeFromIframeDocument);
    });
    window.addEventListener('message', function (event) {
        if (!event.data || event.data.type !== 'session10-demo-height') {
            return;
        }
        var targetIframe = iframes.find(function (iframe) {
            return iframe.id === event.data.frameId;
        }) || iframes[0];
        setHeight(targetIframe, Number(event.data.height));
    });
});
</script>
