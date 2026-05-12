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
$colabVerificationConfig = $colabVerificationConfig ?? [];
$capstonePageKey = pathinfo((string) ($_SERVER['SCRIPT_NAME'] ?? ''), PATHINFO_FILENAME);
$colabConfig = $colabVerificationConfig[$capstonePageKey] ?? [];
$verificationNotebookPath = project_first_matching_relative_path($capstoneRoot, ['*colab*.ipynb', '*verification*.ipynb']);
$sourceNotebookPath = project_first_matching_relative_path($capstoneRoot, ['*.ipynb']);
$previewNotebookPath = $verificationNotebookPath ?? $sourceNotebookPath;
$previewNotebookViewUrl = $previewNotebookPath ? project_artifact_url($previewNotebookPath, true) : null;
$datasetPath = project_first_matching_relative_path($capstoneRoot, ['*.csv']);
$jsonOutputPath = project_first_matching_relative_path($capstoneRoot . '/outputs', ['*.json']);
$csvOutputPath = project_first_matching_relative_path($capstoneRoot . '/outputs', ['*.csv']);
$colabLaunchReady = !empty($colabConfig['launchUrl']);
$verificationFlow = [
    'I use this page to present the notebook, data, and outputs for the capstone in one place.',
    'When a Colab link is available, it opens the same notebook I publish from the project source.',
    'The live dataset and exported files on this site stay aligned with the capstone materials in the repository.',
    'This section is here to show the working notebook path and the project files that go with it.',
];
$verificationInputs = [];

if ($datasetPath !== null) {
    $verificationInputs[] = [
        'label' => 'Live Dataset URL',
        'url' => project_artifact_absolute_url($datasetPath, false, true),
        'note' => 'Dataset file served from the FrancisBurnet site when this capstone includes a staged CSV dataset.',
    ];
}

if ($sourceNotebookPath !== null) {
    $verificationInputs[] = [
        'label' => 'Notebook Download URL',
        'url' => project_artifact_absolute_url($sourceNotebookPath, false, true),
        'note' => 'Notebook source file from this capstone.',
    ];
}

if ($verificationNotebookPath !== null) {
    $verificationInputs[] = [
        'label' => 'Colab Notebook URL',
        'url' => project_artifact_absolute_url($verificationNotebookPath, false, true),
        'note' => 'Colab-oriented notebook artifact when a dedicated notebook file is staged for this capstone.',
    ];
}

if ($csvOutputPath !== null) {
    $verificationInputs[] = [
        'label' => 'CSV Output URL',
        'url' => project_artifact_absolute_url($csvOutputPath, false, true),
        'note' => 'CSV output published with this capstone.',
    ];
}

if ($jsonOutputPath !== null) {
    $verificationInputs[] = [
        'label' => 'JSON Output URL',
        'url' => project_artifact_absolute_url($jsonOutputPath, false, true),
        'note' => 'Optional generated artifact when JSON export is part of the capstone.',
    ];
}

if (!empty($colabConfig['publicDatasetMirrorUrl'])) {
    $verificationInputs[] = [
        'label' => 'Public Dataset Mirror URL',
        'url' => $colabConfig['publicDatasetMirrorUrl'],
        'note' => 'Optional public GitHub dataset source when I want a mirrored fetch path for Colab.',
    ];
}

$publicDatasetRepoNote = 'I can also publish a lightweight public dataset mirror on the FrancisBurnet account when that makes the Colab workflow cleaner, while the live site continues to host the project artifacts.';
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
    <h3 class="h5 mt-4">2) Requirement Checklist</h3>
    <p>Render the project requirements in strict order using the same grading-first standard applied across the site.</p>
    <h3 class="h5 mt-4">3) Code Walkthrough</h3>
    <p>Display requirement-by-requirement notebook, script, PHP, and output evidence with explanations and result summaries.</p>
    <h3 class="h5 mt-4">4) Data and Artifact Links</h3>
    <p>Link the copied dataset, notebook, directions file, screenshots, and exported artifacts used by this capstone.</p>
    <h3 class="h5 mt-4">5) Run Controls or Execution Notes</h3>
    <p>Expose only approved parameters and supported backend calls through the PHP site; otherwise document the intended run flow explicitly.</p>
    <h3 class="h5 mt-4">6) Outputs</h3>
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
                <p class="mb-0"><?php echo htmlspecialchars($publicDatasetRepoNote, ENT_QUOTES, 'UTF-8'); ?></p>
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
            <p class="mb-0">Artifact links have not been staged for this capstone yet. As source files are organized under the mapped capstone folder, they will appear here automatically.</p>
        </div>
    <?php endif; ?>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Colab Notebook</h2>
    <p>I use the same site-native notebook console pattern across capstones so the notebook preview, launch link, and published files stay together on the page.</p>
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
                    <div class="console-state <?php echo $colabLaunchReady ? 'is-ready' : 'is-pending'; ?>"><?php echo $colabLaunchReady ? 'Colab Launch Ready' : 'Colab Launch Pending'; ?></div>
                </div>
                <div class="console-body">
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Embedded Notebook Preview</span>
                        <?php if ($previewNotebookViewUrl !== null): ?>
                            <iframe
                                class="console-frame"
                                src="<?php echo htmlspecialchars($previewNotebookViewUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                title="<?php echo htmlspecialchars($capstoneProject['label'], ENT_QUOTES, 'UTF-8'); ?> notebook preview"
                                loading="lazy"
                            ></iframe>
                        <?php else: ?>
                            <div class="console-placeholder">
                                A staged notebook is not available for this capstone yet. Once the notebook is copied into the mapped capstone folder, the preview will appear here automatically.
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
                <p class="mb-3">This capstone can launch directly into Google Colab when a notebook URL is configured for the page. The default source-controlled URL can point straight at the public GitHub notebook for the project.</p>
                <div class="artifact-actions">
                    <?php if ($colabLaunchReady): ?>
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $colabConfig['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open in Colab</a>
                    <?php else: ?>
                        <span class="btn btn-secondary disabled">Open in Colab Pending Notebook URL</span>
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
                                        <a href="<?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer"><?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?></a>
                                    <?php else: ?>
                                        <span>Available after the live public domain and staging files are in place.</span>
                                    <?php endif; ?>
                                    <div class="text-muted small mt-1"><?php echo htmlspecialchars($input['note'], ENT_QUOTES, 'UTF-8'); ?></div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="mb-0">Project file links will appear automatically as the notebook, dataset, and generated outputs are staged under the mapped capstone folder.</p>
                    <?php endif; ?>
                </div>
                <p class="mb-0 mt-3 text-muted">I keep the default launch URL in source control and can override it with environment variables when the notebook path or repository changes.</p>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5">
    <h2 class="section-title">Execution Notes</h2>
    <div class="status-note p-3">
        <p class="mb-2"><strong>Current mode:</strong> shared template with review-first artifact access and no direct server-side execution endpoint.</p>
        <p class="mb-2">This generic page intentionally avoids fake runtime controls. It surfaces only the files and project context that are actually staged for the capstone.</p>
        <p class="mb-0">As each capstone is customized from its PDF source, this shared section can be replaced with requirement-specific logic and a live Colab launch target.</p>
    </div>
</section>