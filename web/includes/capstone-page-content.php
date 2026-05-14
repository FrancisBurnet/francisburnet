<?php

declare(strict_types=1);

require_once __DIR__ . '/artifact-helpers.php';

$capstoneProject = $capstoneProject ?? null;

if (!$capstoneProject) {
    throw new RuntimeException('Capstone project metadata is required.');
}

$heroTitle = $capstoneProject['heroTitle'];
$heroCaption = $capstoneProject['heroCaption'];
$heroImageAlt = $capstoneProject['label'] . ' infographic placeholder';
$capstoneRoot = capstone_relative_root($capstoneProject);
$artifactLinks = build_capstone_artifact_links($capstoneProject);
$interactiveLab = is_array($capstoneProject['interactiveLab'] ?? null) ? $capstoneProject['interactiveLab'] : null;
$interactiveLabEnabled = !empty($interactiveLab['enabled']) && !empty($interactiveLab['embedUrl']);
$interactiveLabPresets = $interactiveLabEnabled && !empty($interactiveLab['presets']) && is_array($interactiveLab['presets'])
    ? $interactiveLab['presets']
    : [];
$interactiveLabFrameId = 'interactive-lab-' . trim((string) preg_replace('/[^a-z0-9]+/i', '-', (string) ($capstoneProject['key'] ?? 'capstone')), '-');
$colabVerificationConfig = $colabVerificationConfig ?? [];
$capstonePageKey = pathinfo((string) ($_SERVER['SCRIPT_NAME'] ?? ''), PATHINFO_FILENAME);
$colabConfig = $colabVerificationConfig[$capstonePageKey] ?? [];
$verificationNotebookPath = project_first_matching_relative_path($capstoneRoot, ['*colab*.ipynb', '*verification*.ipynb']);
$sourceNotebookPath = project_first_matching_relative_path($capstoneRoot, ['*.ipynb']);
$previewNotebookPath = $verificationNotebookPath ?? $sourceNotebookPath;
$previewNotebookViewUrl = $previewNotebookPath ? project_artifact_url($previewNotebookPath, true) : null;
$previewNotebookAvailable = $previewNotebookPath !== null;
$previewNotebookPreviewUrl = $previewNotebookViewUrl;
if ($previewNotebookAvailable && $previewNotebookPath !== null && $previewNotebookPreviewUrl !== null) {
    $previewNotebookVersion = filemtime(project_artifact_fs_path($previewNotebookPath));
    if ($previewNotebookVersion !== false) {
        $previewNotebookPreviewUrl .= '&v=' . rawurlencode((string) $previewNotebookVersion);
    }
}
$previewNotebookEmbedUrl = $previewNotebookPreviewUrl !== null ? $previewNotebookPreviewUrl . '&embed=1' : null;
$previewNotebookHtml = $previewNotebookPath !== null ? project_render_notebook_html($previewNotebookPath) : null;
$projectPdfPath = project_first_matching_relative_path($capstoneRoot, ['Capstone_Session_*.pdf']);
$datasetPath = project_dataset_path($capstoneRoot);
$dataDirectoryEntries = [];
$dataDirectoryRelativePath = $capstoneRoot . '/data';
$dataDirectoryFsPath = project_artifact_fs_path($dataDirectoryRelativePath);
if (is_dir($dataDirectoryFsPath)) {
    $dataDirectoryNames = array_values(array_filter(scandir($dataDirectoryFsPath) ?: [], static fn(string $entry): bool => $entry !== '.' && $entry !== '..'));
    sort($dataDirectoryNames);

    foreach ($dataDirectoryNames as $entryName) {
        $entryFsPath = $dataDirectoryFsPath . DIRECTORY_SEPARATOR . $entryName;
        if (is_dir($entryFsPath)) {
            $directoryIterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($entryFsPath, FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );
            $fileCount = 0;
            foreach ($directoryIterator as $childEntry) {
                if ($childEntry->isFile()) {
                    $fileCount++;
                }
            }

            $dataDirectoryEntries[] = [
                'label' => $entryName,
                'summary' => $fileCount === 1
                    ? 'Extracted data folder with 1 file.'
                    : 'Extracted data folder with ' . $fileCount . ' files.',
            ];
            continue;
        }

        if (is_file($entryFsPath)) {
            $dataDirectoryEntries[] = [
                'label' => $entryName,
                'summary' => 'Staged data file inside the extracted data directory.',
            ];
        }
    }
}
$jsonOutputPath = project_first_matching_relative_path($capstoneRoot . '/outputs', ['*.json']);
$csvOutputPath = project_first_matching_relative_path($capstoneRoot . '/outputs', ['*.csv']);
$colabLaunchReady = !empty($colabConfig['launchUrl']);
$verificationFlow = [
    'Notebook preview and launch link.',
    'Source files and outputs.',
    'Project file links.',
    'Capstone notebook workspace.',
];
$verificationInputs = [];

if ($datasetPath !== null) {
    $verificationInputs[] = [
        'label' => project_dataset_label($datasetPath),
        'url' => project_artifact_absolute_url($datasetPath, false, true),
        'note' => project_dataset_note($datasetPath),
    ];
}

if ($sourceNotebookPath !== null) {
    $verificationInputs[] = [
        'label' => 'Notebook File',
        'url' => project_artifact_absolute_url($sourceNotebookPath, false, true),
        'note' => 'Notebook source file from this capstone.',
    ];
}

if ($verificationNotebookPath !== null) {
    $verificationInputs[] = [
        'label' => 'Colab Notebook',
        'url' => project_artifact_absolute_url($verificationNotebookPath, false, true),
        'note' => 'Colab-oriented notebook artifact when a dedicated notebook file is available for this capstone.',
    ];
}

if ($csvOutputPath !== null) {
    $verificationInputs[] = [
        'label' => 'CSV Output',
        'url' => project_artifact_absolute_url($csvOutputPath, false, true),
        'note' => 'CSV output published with this capstone.',
    ];
}

if ($jsonOutputPath !== null) {
    $verificationInputs[] = [
        'label' => 'JSON Output',
        'url' => project_artifact_absolute_url($jsonOutputPath, false, true),
        'note' => 'Optional generated artifact when JSON export is part of the capstone.',
    ];
}

if (!empty($colabConfig['publicDatasetMirrorUrl'])) {
    $verificationInputs[] = [
        'label' => 'Public Dataset Mirror',
        'url' => $colabConfig['publicDatasetMirrorUrl'],
        'note' => 'Optional public dataset mirror when a secondary Colab-friendly source is needed.',
    ];
}

$publicDatasetRepoNote = 'The notebook opens in Google Colab, and the project files and outputs remain available here on the site.';
require __DIR__ . '/page-hero.php';
?>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title"><?php echo htmlspecialchars($capstoneProject['label'], ENT_QUOTES, 'UTF-8'); ?></h2>
    <p><?php echo htmlspecialchars($capstoneProject['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p class="mb-1">Source folder mapped for this project: <?php echo htmlspecialchars($capstoneProject['sourceFolder'], ENT_QUOTES, 'UTF-8'); ?></p>
    <p class="mb-0">Build standard: PHP capstone page driven by extracted directions and the translated project rules prompt.</p>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h3 class="h5">1) Objective</h3>
    <p>State the requirement-aligned objective, inputs used, and expected deliverables for <?php echo htmlspecialchars($capstoneProject['label'], ENT_QUOTES, 'UTF-8'); ?>.</p>
    <?php if ($projectPdfPath !== null): ?>
        <h3 class="h5 mt-4">2) Original Project PDF</h3>
        <p>Read the project directions first, then use the checklist below.</p>
        <div class="pdf-embed-frame mt-3">
            <iframe
                src="<?php echo htmlspecialchars(project_artifact_url($projectPdfPath, true, false, current_request_return_path()) . '&embed=1', ENT_QUOTES, 'UTF-8'); ?>"
                title="Original Project PDF"
                loading="lazy"
            ></iframe>
        </div>
    <?php endif; ?>
    <h3 class="h5 mt-4">3) Requirement Checklist</h3>
    <p>Render the project requirements in strict order using the same grading-first standard applied across the site.</p>
    <h3 class="h5 mt-4">4) Code Walkthrough</h3>
    <p>Display requirement-by-requirement notebook, script, PHP, and output evidence with explanations and result summaries.</p>
    <h3 class="h5 mt-4">5) Data and Artifact Links</h3>
    <p>Open the dataset, notebook, directions file, screenshots, and exported artifacts used by this capstone.</p>
    <h3 class="h5 mt-4">6) Run Controls or Execution Notes</h3>
    <p>Expose only approved parameters and supported backend calls through the PHP site; otherwise document the intended run flow explicitly.</p>
    <h3 class="h5 mt-4">7) Outputs</h3>
    <p>Show metrics, figures, saved artifacts, and narrative summaries for this capstone.</p>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Project Readiness</h2>
    <div class="row row-cols-1 row-cols-md-3 g-3 mt-1">
        <div class="col">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Requirements Mapping</span>
                <p class="mb-0">This capstone still uses the generic template. Replace the placeholder walkthrough only after the PDF directions have been extracted and mapped in strict order.</p>
            </div>
        </div>
        <div class="col">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Notebook Flow</span>
                <p class="mb-0">I use the site to present the notebook and artifacts clearly, and I keep notebook execution in Colab instead of turning the site into a server-side runner.</p>
            </div>
        </div>
        <div class="col">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Dataset Sourcing</span>
                <p class="mb-0">When a dataset is available for this capstone, it appears here with the notebook and outputs.</p>
            </div>
        </div>
    </div>
</section>

<section id="data-artifact-links" class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Data and Artifact Links</h2>
    <p>These cards use the shared view-first pattern across capstone pages. Open artifacts in the browser for review first, or download the original file when needed.</p>
    <?php if ($artifactLinks !== []): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mt-1">
            <?php foreach ($artifactLinks as $artifact): ?>
                <div class="col">
                    <div class="artifact-card p-3">
                        <span class="artifact-label mb-2">Artifact</span>
                        <h3 class="h5"><?php echo htmlspecialchars($artifact['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="mb-3"><?php echo htmlspecialchars($artifact['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="artifact-actions">
                            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars($artifact['viewHref'], ENT_QUOTES, 'UTF-8'); ?>">View</a>
                            <a class="btn btn-primary" href="<?php echo htmlspecialchars($artifact['downloadHref'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="status-note p-3 mt-3">
            <p class="mb-0">Artifact links are not available for this capstone yet.</p>
        </div>
    <?php endif; ?>

    <?php if ($dataDirectoryEntries !== []): ?>
        <div class="status-note p-3 mt-4">
            <p class="mb-0">The extracted <code>data/</code> directory is staged for this capstone and the top-level contents are listed below.</p>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mt-1">
            <?php foreach ($dataDirectoryEntries as $dataEntry): ?>
                <div class="col">
                    <div class="evidence-card p-3">
                        <span class="artifact-label mb-2">Data Folder</span>
                        <h3 class="h5"><?php echo htmlspecialchars($dataEntry['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="mb-0"><?php echo htmlspecialchars($dataEntry['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php if ($interactiveLabEnabled): ?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title"><?php echo htmlspecialchars((string) ($interactiveLab['heading'] ?? 'Interactive Lab'), ENT_QUOTES, 'UTF-8'); ?></h2>
    <p><?php echo htmlspecialchars((string) ($interactiveLab['summary'] ?? 'Explore an interactive concept demo that supports this capstone.'), ENT_QUOTES, 'UTF-8'); ?></p>
    <?php if ($interactiveLabPresets !== []): ?>
        <div class="interactive-lab-presets mt-3 mb-3">
            <?php foreach ($interactiveLabPresets as $presetIndex => $preset): ?>
                <?php $presetUrl = (string) ($preset['url'] ?? ''); ?>
                <?php if ($presetUrl === '') { continue; } ?>
                <a
                    class="btn <?php echo $presetIndex === 0 ? 'btn-primary' : 'btn-outline-dark'; ?>"
                    href="<?php echo htmlspecialchars($presetUrl, ENT_QUOTES, 'UTF-8'); ?>"
                    target="<?php echo htmlspecialchars($interactiveLabFrameId, ENT_QUOTES, 'UTF-8'); ?>"
                >
                    <?php echo htmlspecialchars((string) ($preset['label'] ?? 'Preset'), ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-3 mb-3">
            <?php foreach ($interactiveLabPresets as $preset): ?>
                <?php if (empty($preset['summary'])) { continue; } ?>
                <div class="col">
                    <div class="evidence-card p-3">
                        <span class="artifact-label mb-2">Preset</span>
                        <h3 class="h6"><?php echo htmlspecialchars((string) ($preset['label'] ?? 'Preset'), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="mb-0"><?php echo htmlspecialchars((string) $preset['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <p class="embed-orientation-hint mb-2">On mobile, swipe left/right to use the full TensorFlow embed. For the best experience, rotate your phone 90 degrees to landscape.</p>
    <div class="interactive-lab-shell">
        <iframe
            class="interactive-lab-frame"
            name="<?php echo htmlspecialchars($interactiveLabFrameId, ENT_QUOTES, 'UTF-8'); ?>"
            src="<?php echo htmlspecialchars((string) $interactiveLab['embedUrl'], ENT_QUOTES, 'UTF-8'); ?>"
            title="<?php echo htmlspecialchars($capstoneProject['label'] . ' Interactive Lab', ENT_QUOTES, 'UTF-8'); ?>"
            loading="lazy"
        ></iframe>
    </div>
    <div class="artifact-actions mt-3">
        <?php if (!empty($interactiveLab['launchUrl'])): ?>
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $interactiveLab['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                <?php echo htmlspecialchars((string) ($interactiveLab['launchLabel'] ?? 'Open Interactive Lab'), ENT_QUOTES, 'UTF-8'); ?>
            </a>
        <?php endif; ?>
    </div>
    <?php if (!empty($interactiveLab['note'])): ?>
        <div class="status-note p-3 mt-3">
            <p class="mb-0"><?php echo htmlspecialchars((string) $interactiveLab['note'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
</section>
<?php endif; ?>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Colab Notebook</h2>
    <p>This section brings the notebook preview, the Colab launch link, and the main project files together in one place.</p>
    <p class="text-muted mb-0"><?php echo htmlspecialchars($publicDatasetRepoNote, ENT_QUOTES, 'UTF-8'); ?></p>
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="integration-console">
                <div class="console-toolbar">
                    <div class="console-lights" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="console-title"><?php echo htmlspecialchars($capstoneProject['label'], ENT_QUOTES, 'UTF-8'); ?> Notebook Workspace</div>
                    <?php if ($colabLaunchReady): ?>
                        <a class="console-launch" href="<?php echo htmlspecialchars((string) $colabConfig['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Launch Colab</a>
                    <?php else: ?>
                        <div class="console-state is-pending">Colab Pending</div>
                    <?php endif; ?>
                </div>
                <div class="console-body">
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Embedded Notebook Preview</span>
                        <?php if ($previewNotebookHtml !== null): ?>
                            <div class="console-notebook-preview">
                                <?php echo $previewNotebookHtml; ?>
                            </div>
                        <?php else: ?>
                            <div class="console-placeholder">
                                A notebook is not available for this capstone yet.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Project Notes</span>
                        <ul class="console-list mb-0">
                            <?php foreach ($verificationFlow as $flowItem): ?>
                                <li><?php echo htmlspecialchars($flowItem, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="artifact-card p-3">
                <span class="artifact-label mb-2">Launch Controls</span>
                <h3 class="h5">Notebook Launch</h3>
                <p class="mb-3">This capstone can launch directly into Google Colab when a notebook URL is configured for the page.</p>
                <div class="artifact-actions">
                    <?php if ($colabLaunchReady): ?>
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $colabConfig['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Launch Colab</a>
                    <?php else: ?>
                        <span class="btn btn-secondary disabled">Colab Launch Pending</span>
                    <?php endif; ?>
                    <?php if (!empty($colabConfig['publicNotebookSourceUrl'])): ?>
                        <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $colabConfig['publicNotebookSourceUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">View Notebook Source</a>
                    <?php endif; ?>
                </div>
                <div class="evidence-card p-3 mt-3">
                    <span class="artifact-label mb-2">Project File Links</span>
                    <?php if ($verificationInputs !== []): ?>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($verificationInputs as $input): ?>
                                <li>
                                    <strong><?php echo htmlspecialchars($input['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong>
                                    <?php if (!empty($input['url'])): ?>
                                        <a href="<?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open <?php echo htmlspecialchars((string) $input['label'], ENT_QUOTES, 'UTF-8'); ?></a>
                                    <?php else: ?>
                                        <span>Available after the live public domain and staging files are in place.</span>
                                    <?php endif; ?>
                                    <div class="text-muted small mt-1"><?php echo htmlspecialchars($input['note'], ENT_QUOTES, 'UTF-8'); ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="mb-0">Project file links appear here when the notebook, dataset, and outputs are available.</p>
                    <?php endif; ?>
                </div>
                <p class="mb-0 mt-3 text-muted">This launch area updates when notebook and output artifacts are available.</p>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5">
    <h2 class="section-title">Execution Notes</h2>
    <div class="status-note p-3">
        <p class="mb-2"><strong>Current mode:</strong> shared template with review-first artifact access and no direct server-side execution endpoint.</p>
        <p class="mb-2">This page surfaces the files and project context that are available for the capstone.</p>
        <p class="mb-0">As each capstone is customized from its PDF source, this shared section can be replaced with requirement-specific logic and a live Colab launch target.</p>
    </div>
</section>