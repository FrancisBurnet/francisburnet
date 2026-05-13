<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

if (!function_exists('session_custom_parse_requirements')) {
    function session_custom_parse_requirements(string $relativePath): array
    {
        if (!project_artifact_exists($relativePath)) {
            return [];
        }

        $lines = file(project_artifact_fs_path($relativePath), FILE_IGNORE_NEW_LINES);
        if ($lines === false) {
            return [];
        }

        $requirements = [];
        $current = null;

        foreach ($lines as $line) {
            $trimmed = trim((string) $line);
            if ($trimmed === '') {
                continue;
            }

            if (preg_match('/^([0-9]+[a-z]+)\.\s+(.*)$/i', $trimmed, $matches) === 1) {
                if ($current !== null) {
                    $requirements[] = $current;
                }

                $current = [
                    'id' => $matches[1],
                    'text' => $matches[2],
                    'evidence' => '',
                ];
                continue;
            }

            if ($current !== null && str_starts_with($trimmed, 'Status:')) {
                $current['evidence'] = trim(substr($trimmed, 7));
            }
        }

        if ($current !== null) {
            $requirements[] = $current;
        }

        return $requirements;
    }
}

if (!function_exists('session_custom_build_asset_link')) {
    function session_custom_build_asset_link(array $asset, ?string $returnPath): ?array
    {
        $path = (string) ($asset['path'] ?? '');
        if ($path === '' || !project_artifact_exists($path)) {
            return null;
        }

        return [
            'label' => (string) ($asset['label'] ?? basename($path)),
            'summary' => (string) ($asset['summary'] ?? 'Open the staged artifact for this capstone.'),
            'viewHref' => project_artifact_url($path, true, false, $returnPath),
            'downloadHref' => project_artifact_url($path, false, true),
        ];
    }
}

$capstoneProject = $capstoneProject ?? null;
if (!$capstoneProject) {
    throw new RuntimeException('Capstone project metadata is required.');
}

$capstoneRoot = $capstoneRoot ?? capstone_relative_root($capstoneProject);
$artifactSectionReturnPath = anchored_return_path('data-artifact-links');
$colabVerificationConfig = $colabVerificationConfig ?? [];
$colabConfig = $colabVerificationConfig[$capstoneProject['key']] ?? [];
$requirementsPath = $requirementsPath ?? project_first_matching_relative_path($capstoneRoot . '/requirements', ['*.md']);
$projectPdfPath = $projectPdfPath ?? project_first_matching_relative_path($capstoneRoot, ['Capstone_Session_*.pdf']);
$notebookPath = $notebookPath ?? project_first_matching_relative_path($capstoneRoot, ['*.ipynb']);
$summaryPath = $summaryPath ?? project_first_matching_relative_path($capstoneRoot . '/outputs', ['*summary.json']);
$capstoneScopeIntro = $capstoneScopeIntro ?? 'This capstone page surfaces the copied directions, executed notebook, staged outputs, and reviewable evidence together in one place.';
$capstoneScopeDetails = isset($capstoneScopeDetails) && is_array($capstoneScopeDetails) ? $capstoneScopeDetails : [];
$walkthrough = isset($walkthrough) && is_array($walkthrough) ? $walkthrough : [];
$extraAssetLinks = isset($extraAssetLinks) && is_array($extraAssetLinks) ? $extraAssetLinks : [];
$verificationFlow = isset($verificationFlow) && is_array($verificationFlow) ? $verificationFlow : [];
$verificationInputs = isset($verificationInputs) && is_array($verificationInputs) ? $verificationInputs : [];
$keyOutputs = isset($keyOutputs) && is_array($keyOutputs) ? $keyOutputs : [];
$keyFindings = isset($keyFindings) && is_array($keyFindings) ? $keyFindings : [];
$publicDatasetRepoNote = $publicDatasetRepoNote ?? 'The notebook opens in Google Colab when a launch URL is configured, and the project files and outputs remain available here on the site.';

$interactiveLab = is_array($capstoneProject['interactiveLab'] ?? null) ? $capstoneProject['interactiveLab'] : null;
$interactiveLabEnabled = !empty($interactiveLab['enabled']) && !empty($interactiveLab['embedUrl']);
$interactiveLabPresets = $interactiveLabEnabled && !empty($interactiveLab['presets']) && is_array($interactiveLab['presets'])
    ? $interactiveLab['presets']
    : [];
$interactiveLabFrameId = 'interactive-lab-' . trim((string) preg_replace('/[^a-z0-9]+/i', '-', (string) ($capstoneProject['key'] ?? 'capstone')), '-');
$interactiveLabContext = !empty($interactiveLab['context']) && is_array($interactiveLab['context']) ? $interactiveLab['context'] : [];
$interactiveLabInstructions = !empty($interactiveLab['instructions']) && is_array($interactiveLab['instructions']) ? $interactiveLab['instructions'] : [];
$interactiveLabExpectations = !empty($interactiveLab['expectations']) && is_array($interactiveLab['expectations']) ? $interactiveLab['expectations'] : [];

$summaryData = [];
if ($summaryPath !== null && project_artifact_exists($summaryPath)) {
    $decoded = json_decode((string) file_get_contents(project_artifact_fs_path($summaryPath)), true);
    if (is_array($decoded)) {
        $summaryData = $decoded;
    }
}

$colabLaunchReady = !empty($colabConfig['launchUrl']);
$previewNotebookHtml = $notebookPath !== null && project_artifact_exists($notebookPath)
    ? project_render_notebook_html($notebookPath)
    : null;

$heroImageCandidates = [
    project_first_matching_relative_path($capstoneRoot, ['infographic*.png', 'infographic*.jpg', 'infographic*.jpeg', 'infographic*.webp']),
    project_first_matching_relative_path($capstoneRoot . '/outputs/plots', ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']),
    project_first_matching_relative_path($capstoneRoot . '/Screenshots', ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']),
    project_first_matching_relative_path($capstoneRoot, ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']),
];

$heroImageRelativePath = null;
foreach ($heroImageCandidates as $candidate) {
    if ($candidate !== null && project_artifact_exists($candidate)) {
        $heroImageRelativePath = $candidate;
        break;
    }
}

$heroImagePath = $heroImageRelativePath !== null ? project_artifact_url($heroImageRelativePath) : 'assets/images/hero-placeholder.svg';
$heroCaption = $heroImageRelativePath !== null
    ? $capstoneProject['label'] . ' evidence visual.'
    : $capstoneProject['label'] . ' placeholder image.';
$heroTitle = $capstoneProject['label'] . ' Evidence Map';
$heroImageAlt = $capstoneProject['label'] . ' evidence image';
require __DIR__ . '/../page-hero.php';

$requirements = $requirementsPath !== null ? session_custom_parse_requirements($requirementsPath) : [];
$assetLinks = build_capstone_artifact_links($capstoneProject);
foreach ($extraAssetLinks as $asset) {
    $builtAsset = session_custom_build_asset_link($asset, $artifactSectionReturnPath);
    if ($builtAsset !== null) {
        $assetLinks[] = $builtAsset;
    }
}

?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title"><?php echo htmlspecialchars($capstoneProject['label'], ENT_QUOTES, 'UTF-8'); ?> Scope</h2>
    <p><?php echo htmlspecialchars($capstoneScopeIntro, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php foreach ($capstoneScopeDetails as $detail): ?>
        <p class="mb-1"><?php echo htmlspecialchars((string) $detail, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endforeach; ?>
</section>

<?php if ($projectPdfPath !== null): ?>
    <?php echo project_render_embedded_pdf_section(
        $projectPdfPath,
        'Original Project PDF',
        'The copied project directions are embedded here for direct comparison against the notebook and output artifacts.'
    ); ?>
<?php endif; ?>

<?php if ($requirements !== []): ?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Requirement Checklist</h2>
    <div class="row g-3 mt-1">
        <?php foreach ($requirements as $requirement): ?>
            <div class="col-lg-6">
                <div class="requirement-card p-3">
                    <span class="requirement-id"><?php echo htmlspecialchars((string) $requirement['id'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <h3 class="h5 mt-2 mb-2"><?php echo htmlspecialchars((string) $requirement['text'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <?php if ($requirementsPath !== null): ?>
                        <p class="mb-1 text-muted">Source mapping: <a href="<?php echo htmlspecialchars(project_artifact_url($requirementsPath, true, false, $artifactSectionReturnPath), ENT_QUOTES, 'UTF-8'); ?>">Requirements file</a></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Requirement Walkthrough</h2>
    <p>Each walkthrough block maps the copied PDF requirements to the executed notebook cells, exported outputs, and reviewable evidence staged with this capstone.</p>
    <div class="d-grid gap-4 mt-3">
        <?php foreach ($walkthrough as $section): ?>
            <article class="requirement-card p-4">
                <span class="requirement-id"><?php echo htmlspecialchars((string) $section['id'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h3 class="h4 mt-2 mb-2"><?php echo htmlspecialchars((string) $section['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p class="mb-2"><strong>Notebook section:</strong> <?php echo htmlspecialchars((string) $section['notebookSection'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="mb-2"><strong>Requirement:</strong> <?php echo htmlspecialchars((string) $section['requirement'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><?php echo htmlspecialchars((string) $section['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="d-grid gap-3">
                    <div class="evidence-card p-3">
                        <span class="artifact-label mb-2">Results Capture</span>
                        <ul class="mb-0 ps-3">
                            <?php foreach (($section['results'] ?? []) as $result): ?>
                                <li><?php echo htmlspecialchars((string) $result, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (!empty($section['code'])): ?>
                        <div class="code-shell"><pre><code><?php echo htmlspecialchars((string) $section['code'], ENT_QUOTES, 'UTF-8'); ?></code></pre></div>
                    <?php endif; ?>
                    <?php if (!empty($section['artifacts'])): ?>
                        <div class="row g-3">
                            <?php foreach ($section['artifacts'] as $artifact): ?>
                                <?php if (empty($artifact['path']) || !project_artifact_exists((string) $artifact['path'])) { continue; } ?>
                                <div class="col-lg-6">
                                    <div class="artifact-card p-3 h-100">
                                        <span class="artifact-label mb-2">Associated Artifact</span>
                                        <h4 class="h6"><?php echo htmlspecialchars((string) ($artifact['label'] ?? basename((string) $artifact['path'])), ENT_QUOTES, 'UTF-8'); ?></h4>
                                        <p class="mb-3"><?php echo htmlspecialchars((string) ($artifact['summary'] ?? 'Open the staged artifact for this walkthrough section.'), ENT_QUOTES, 'UTF-8'); ?></p>
                                        <?php $path = (string) $artifact['path']; ?>
                                        <?php if (preg_match('/\.(png|jpe?g|webp|gif|svg)$/i', $path) === 1): ?>
                                            <img class="img-fluid rounded border mb-3" src="<?php echo htmlspecialchars(project_artifact_url($path), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars((string) ($artifact['label'] ?? basename($path)), ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php endif; ?>
                                        <div class="artifact-actions">
                                            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_url($path, true, false, $artifactSectionReturnPath), ENT_QUOTES, 'UTF-8'); ?>">View</a>
                                            <a class="btn btn-primary" href="<?php echo htmlspecialchars(project_artifact_url($path, false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section id="data-artifact-links" class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Data And Artifact Links</h2>
    <p>The links below open the copied project files, executed notebook, generated outputs, and staged evidence artifacts for this capstone.</p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mt-1">
        <?php foreach ($assetLinks as $asset): ?>
            <div class="col">
                <div class="artifact-card p-3">
                    <span class="artifact-label mb-2">Artifact</span>
                    <h3 class="h5"><?php echo htmlspecialchars((string) $asset['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="mb-3"><?php echo htmlspecialchars((string) $asset['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <div class="artifact-actions">
                        <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $asset['viewHref'], ENT_QUOTES, 'UTF-8'); ?>">View</a>
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $asset['downloadHref'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php if ($interactiveLabEnabled): ?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title"><?php echo htmlspecialchars((string) ($interactiveLab['heading'] ?? 'Interactive Lab'), ENT_QUOTES, 'UTF-8'); ?></h2>
    <p><?php echo htmlspecialchars((string) ($interactiveLab['summary'] ?? 'Explore an interactive concept demo that supports this capstone.'), ENT_QUOTES, 'UTF-8'); ?></p>
    <?php if ($interactiveLabContext !== [] || $interactiveLabInstructions !== [] || $interactiveLabExpectations !== []): ?>
        <div class="row g-3 mt-1 mb-3">
            <?php if ($interactiveLabContext !== []): ?>
                <div class="col-lg-4">
                    <div class="evidence-card p-3 h-100">
                        <span class="artifact-label mb-2">What This Is</span>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($interactiveLabContext as $contextItem): ?>
                                <li><?php echo htmlspecialchars((string) $contextItem, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($interactiveLabInstructions !== []): ?>
                <div class="col-lg-4">
                    <div class="evidence-card p-3 h-100">
                        <span class="artifact-label mb-2">How To Use It</span>
                        <ol class="mb-0 ps-3">
                            <?php foreach ($interactiveLabInstructions as $instruction): ?>
                                <li><?php echo htmlspecialchars((string) $instruction, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($interactiveLabExpectations !== []): ?>
                <div class="col-lg-4">
                    <div class="evidence-card p-3 h-100">
                        <span class="artifact-label mb-2">What To Look For</span>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($interactiveLabExpectations as $expectation): ?>
                                <li><?php echo htmlspecialchars((string) $expectation, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php if ($interactiveLabPresets !== []): ?>
        <div class="row g-3 mt-1 mb-3">
            <?php foreach ($interactiveLabPresets as $presetIndex => $preset): ?>
                <?php $presetUrl = (string) ($preset['url'] ?? ''); ?>
                <?php if ($presetUrl === '') { continue; } ?>
                <div class="col-lg-6">
                    <div class="evidence-card p-3 h-100">
                        <span class="artifact-label mb-2">Preset <?php echo (int) ($presetIndex + 1); ?></span>
                        <h3 class="h5"><?php echo htmlspecialchars((string) ($preset['label'] ?? 'Preset'), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="mb-3"><?php echo htmlspecialchars((string) ($preset['summary'] ?? 'Preloaded TensorFlow Playground state for this capstone.'), ENT_QUOTES, 'UTF-8'); ?></p>
                        <div class="artifact-actions mt-auto">
                            <a class="btn js-interactive-lab-preset <?php echo $presetIndex === 0 ? 'btn-primary' : 'btn-outline-dark'; ?>" href="<?php echo htmlspecialchars($presetUrl, ENT_QUOTES, 'UTF-8'); ?>" target="<?php echo htmlspecialchars($interactiveLabFrameId, ENT_QUOTES, 'UTF-8'); ?>" data-frame="<?php echo htmlspecialchars($interactiveLabFrameId, ENT_QUOTES, 'UTF-8'); ?>" aria-pressed="<?php echo $presetIndex === 0 ? 'true' : 'false'; ?>">
                                Load <?php echo htmlspecialchars((string) ($preset['label'] ?? 'Preset'), ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="interactive-lab-shell">
        <iframe class="interactive-lab-frame" name="<?php echo htmlspecialchars($interactiveLabFrameId, ENT_QUOTES, 'UTF-8'); ?>" src="<?php echo htmlspecialchars((string) $interactiveLab['embedUrl'], ENT_QUOTES, 'UTF-8'); ?>" title="<?php echo htmlspecialchars($capstoneProject['label'] . ' Interactive Lab', ENT_QUOTES, 'UTF-8'); ?>" loading="lazy"></iframe>
    </div>
    <div class="artifact-actions mt-3">
        <?php if (!empty($interactiveLab['launchUrl'])): ?>
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $interactiveLab['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer"><?php echo htmlspecialchars((string) ($interactiveLab['launchLabel'] ?? 'Open Interactive Lab'), ENT_QUOTES, 'UTF-8'); ?></a>
        <?php endif; ?>
    </div>
    <?php if (!empty($interactiveLab['note'])): ?>
        <div class="status-note p-3 mt-3">
            <p class="mb-0"><?php echo htmlspecialchars((string) $interactiveLab['note'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php endif; ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var presetButtons = document.querySelectorAll('.js-interactive-lab-preset[data-frame="<?php echo htmlspecialchars($interactiveLabFrameId, ENT_QUOTES, 'UTF-8'); ?>"]');
        if (!presetButtons.length) {
            return;
        }
        presetButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                presetButtons.forEach(function (otherButton) {
                    otherButton.classList.remove('btn-primary');
                    otherButton.classList.add('btn-outline-dark');
                    otherButton.setAttribute('aria-pressed', 'false');
                });
                button.classList.remove('btn-outline-dark');
                button.classList.add('btn-primary');
                button.setAttribute('aria-pressed', 'true');
            });
        });
    });
    </script>
</section>
<?php endif; ?>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Colab Notebook</h2>
    <p>This section provides the notebook preview, launch link, and project file links.</p>
    <p class="text-muted mb-0"><?php echo htmlspecialchars($publicDatasetRepoNote, ENT_QUOTES, 'UTF-8'); ?></p>
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="integration-console">
                <div class="console-toolbar">
                    <div class="console-lights" aria-hidden="true"><span></span><span></span><span></span></div>
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
                            <div class="console-notebook-preview"><?php echo $previewNotebookHtml; ?></div>
                        <?php else: ?>
                            <div class="console-placeholder">The notebook preview is not available for this capstone.</div>
                        <?php endif; ?>
                    </div>
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Project Notes</span>
                        <ul class="console-list mb-0">
                            <?php foreach ($verificationFlow as $flowItem): ?>
                                <li><?php echo htmlspecialchars((string) $flowItem, ENT_QUOTES, 'UTF-8'); ?></li>
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
                <p class="mb-3">Open the matching notebook in Google Colab or review the tracked notebook source in GitHub.</p>
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
                    <ul class="mb-0 ps-3">
                        <?php foreach ($verificationInputs as $input): ?>
                            <li>
                                <strong><?php echo htmlspecialchars((string) $input['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong>
                                <?php if (!empty($input['url'])): ?>
                                    <a href="<?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open <?php echo htmlspecialchars((string) $input['label'], ENT_QUOTES, 'UTF-8'); ?></a>
                                <?php else: ?>
                                    <span>Available after live public staging is configured.</span>
                                <?php endif; ?>
                                <div class="text-muted small mt-1"><?php echo htmlspecialchars((string) $input['note'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5">
    <h2 class="section-title">Outputs And Results</h2>
    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Outputs</span>
                <ul class="mb-0 ps-3">
                    <?php foreach ($keyOutputs as $output): ?>
                        <li><?php echo htmlspecialchars((string) $output, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Findings</span>
                <ul class="mb-0 ps-3">
                    <?php foreach ($keyFindings as $finding): ?>
                        <li><?php echo htmlspecialchars((string) $finding, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
