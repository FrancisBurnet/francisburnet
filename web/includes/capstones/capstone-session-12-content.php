<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Deep Learning Specialization/Capstone Session 12';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_12.pdf';
$requirementsPath = $capstoneRoot . '/requirements/capstone_session_12_requirements.md';
$notebookPath = $capstoneRoot . '/capstone_session_12.ipynb';
$summaryPath = $capstoneRoot . '/outputs/session_12_summary.json';
$summaryData = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true) ?: [];

$capstoneScopeIntro = 'Capstone 12 converts the copied dental-autoencoder assignment into an executed denoising notebook with grayscale preparation, training-history outputs, and noisy-versus-denoised evidence panels.';
$capstoneScopeDetails = [
    'Primary staged dataset: Dental-Panaromic-Autoencoder.npz.',
    'The notebook records the RGB-to-grayscale handling needed to satisfy the copied decoder requirement and stages the comparison visuals under outputs/plots/.',
];

$walkthrough = [
    [
        'id' => '12a',
        'title' => 'Load The NPZ Dataset And Create The Noisy Inputs',
        'notebookSection' => 'NPZ load and noise-generation cells',
        'requirement' => 'Load the NPZ file, extract the arrays, add noise with factor 0.2, and clip the signals between 0 and 1.',
        'summary' => 'The notebook loads the staged arrays, converts the RGB inputs to grayscale to satisfy the copied single-filter decoder requirement, and generates the noisy train/test inputs.',
        'results' => [
            'Original shapes: ' . json_encode($summaryData['original_shapes'] ?? new stdClass()) . '.',
            'Noise factor: ' . (string) ($summaryData['noise_factor'] ?? 'n/a') . '.',
        ],
        'code' => "data = np.load(DATA_PATH)\nx_train_gray = x_train.mean(axis=-1, keepdims=True)\nx_train_noisy = np.clip(x_train_gray + noise_factor * np.random.normal(...), 0.0, 1.0)",
        'artifacts' => [
            ['label' => 'Original vs Noisy Train Images', 'path' => $capstoneRoot . '/outputs/plots/original_vs_noisy_train.png', 'summary' => 'Saved panel comparing original and noisy training images.'],
        ],
    ],
    [
        'id' => '12b',
        'title' => 'Build And Train The Denoising Autoencoder',
        'notebookSection' => 'Model-class and fit cells',
        'requirement' => 'Define the Denoise model, compile it with Adam and MeanSquaredError, and train it on noisy versus original images.',
        'summary' => 'The notebook implements the Denoise model class with the copied encoder and decoder structure and exports the loss and MAE history for review.',
        'results' => [
            'Encoded shape: ' . json_encode($summaryData['encoded_shape'] ?? []) . '.',
            'Decoded shape: ' . json_encode($summaryData['decoded_shape'] ?? []) . '.',
        ],
        'code' => "class Denoise(tf.keras.Model):\n    def __init__(self):\n        ...\nautoencoder.compile(optimizer='adam', loss=tf.keras.losses.MeanSquaredError(), metrics=['mae'])\nhistory = autoencoder.fit(...)",
        'artifacts' => [
            ['label' => 'Training History', 'path' => $capstoneRoot . '/outputs/plots/training_history.png', 'summary' => 'Saved loss and MAE curves across training epochs.'],
        ],
    ],
    [
        'id' => '12c',
        'title' => 'Evaluate The Autoencoder And Show Denoised Outputs',
        'notebookSection' => 'Evaluation and reconstruction cells',
        'requirement' => 'Evaluate the autoencoder, pass x_test through encoder and decoder, and plot noisy versus denoised outputs.',
        'summary' => 'The notebook evaluates the model on the noisy test set and exports a side-by-side panel of noisy and reconstructed images for the site evidence layer.',
        'results' => [
            'Test loss is ' . (string) round((float) ($summaryData['test_loss'] ?? 0.0), 6) . '.',
            'Test MAE is ' . (string) round((float) ($summaryData['test_mae'] ?? 0.0), 6) . '.',
        ],
        'code' => "evaluation = autoencoder.evaluate(x_test_noisy, x_test_gray, verbose=0)\nencoded_images = autoencoder.encoder(x_test_noisy).numpy()\ndecoded_images = autoencoder.decoder(encoded_images).numpy()",
        'artifacts' => [
            ['label' => 'Noisy vs Denoised Test Images', 'path' => $capstoneRoot . '/outputs/plots/noisy_vs_denoised_test.png', 'summary' => 'Saved panel comparing noisy and reconstructed test images.'],
        ],
    ],
];

$extraAssetLinks = [
    ['label' => 'Training History CSV', 'path' => $capstoneRoot . '/outputs/session_12_training_history.csv', 'summary' => 'Exported epoch-by-epoch loss and MAE history.'],
    ['label' => 'Summary JSON', 'path' => $capstoneRoot . '/outputs/session_12_summary.json', 'summary' => 'Structured summary of shapes, noise factor, and evaluation metrics.'],
];

$verificationFlow = [
    'NPZ load, grayscale conversion, and noise generation.',
    'Denoise model definition and autoencoder training.',
    'Loss/MAE history export.',
    'Noisy-versus-denoised image comparison outputs.',
];

$verificationInputs = [
    ['label' => 'Notebook File', 'url' => project_artifact_absolute_url($notebookPath, false, true), 'note' => 'Executed Session 12 denoising-autoencoder notebook.'],
    ['label' => 'Source NPZ', 'url' => project_artifact_absolute_url($capstoneRoot . '/Dental-Panaromic-Autoencoder.npz', false, true), 'note' => 'Original staged NPZ source file.'],
    ['label' => 'Training History CSV', 'url' => project_artifact_absolute_url($capstoneRoot . '/outputs/session_12_training_history.csv', false, true), 'note' => 'Exported epoch-by-epoch loss and MAE history.'],
    ['label' => 'Summary JSON', 'url' => project_artifact_absolute_url($summaryPath, false, true), 'note' => 'Structured summary of shapes, noise factor, and evaluation metrics.'],
];

$keyOutputs = [
    'Executed notebook artifact saved as capstone_session_12.ipynb.',
    'Training-history, original-vs-noisy, and noisy-vs-denoised PNGs are staged for the site workflow.',
    'The summary JSON preserves the grayscale conversion and evaluation metrics explicitly.',
];

$keyFindings = [
    'Test loss is ' . (string) round((float) ($summaryData['test_loss'] ?? 0.0), 6) . ' and test MAE is ' . (string) round((float) ($summaryData['test_mae'] ?? 0.0), 6) . '.',
    'The staged RGB dataset is converted to grayscale so the executed model can satisfy the copied single-filter decoder requirement.',
    'TensorFlow Playground remains optional concept support while the notebook and reconstruction outputs remain the evidence layer.',
];

require __DIR__ . '/session-custom-renderer.php';
