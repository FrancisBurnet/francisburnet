<?php

declare(strict_types=1);

function project_root_path(): string
{
    $candidates = [
        realpath(__DIR__ . '/../../'),
        realpath(__DIR__ . '/../'),
    ];

    foreach ($candidates as $path) {
        if ($path !== false && is_dir($path . DIRECTORY_SEPARATOR . 'Incremental Capstones')) {
            return $path;
        }
    }

    throw new RuntimeException('Project root path could not be resolved.');
}

function capstone_relative_root(array $capstoneProject): string
{
    $programFolder = $capstoneProject['programFolder'] ?? '';
    $sourceFolder = $capstoneProject['sourceFolder'] ?? '';

    if ($programFolder === '' || $sourceFolder === '') {
        throw new RuntimeException('Capstone project path metadata is incomplete.');
    }

    return 'Incremental Capstones/' . $programFolder . '/' . $sourceFolder;
}

function current_request_return_path(): ?string
{
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    if ($requestUri === '') {
        return null;
    }

    $parts = parse_url($requestUri);
    $path = $parts['path'] ?? '';
    if ($path === '' || basename($path) === 'artifact.php') {
        return null;
    }

    $normalizedPath = ltrim($path, '/');
    if ($normalizedPath === '') {
        return null;
    }

    if (!empty($parts['query'])) {
        $normalizedPath .= '?' . $parts['query'];
    }

    return $normalizedPath;
}

function anchored_return_path(string $fragment): ?string
{
    $returnPath = current_request_return_path();
    if ($returnPath === null) {
        return null;
    }

    $fragment = ltrim($fragment, '#');
    if ($fragment === '') {
        return $returnPath;
    }

    return $returnPath . '#' . $fragment;
}

function project_artifact_url(string $relativePath, bool $view = false, bool $download = false, ?string $returnPath = null): string
{
    $query = ['path' => $relativePath];
    if ($view) {
        $query['mode'] = 'view';
        $resolvedReturnPath = $returnPath ?? current_request_return_path();
        if ($resolvedReturnPath !== null) {
            $query['return'] = $resolvedReturnPath;
        }
    }
    if ($download) {
        $query['download'] = '1';
    }

    return 'artifact.php?' . http_build_query($query);
}

function current_site_base_url(): ?string
{
    $host = isset($_SERVER['HTTP_HOST']) ? trim((string) $_SERVER['HTTP_HOST']) : '';
    if ($host === '') {
        return null;
    }

    $httpsEnabled = (!empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (string) $_SERVER['SERVER_PORT'] === '443')
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string) $_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https');

    return ($httpsEnabled ? 'https' : 'http') . '://' . $host;
}

function absolute_site_url(string $relativeOrAbsolutePath): ?string
{
    if ($relativeOrAbsolutePath === '') {
        return null;
    }

    if (preg_match('/^https?:\/\//i', $relativeOrAbsolutePath) === 1) {
        return $relativeOrAbsolutePath;
    }

    $baseUrl = current_site_base_url();
    if ($baseUrl === null) {
        return null;
    }

    return $baseUrl . '/' . ltrim($relativeOrAbsolutePath, '/');
}

function project_artifact_absolute_url(string $relativePath, bool $view = false, bool $download = false): ?string
{
    $query = ['path' => $relativePath];
    if ($view) {
        $query['mode'] = 'view';
    }
    if ($download) {
        $query['download'] = '1';
    }

    return absolute_site_url('artifact.php?' . http_build_query($query));
}

function project_artifact_fs_path(string $relativePath): string
{
    return project_root_path() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
}

function project_artifact_exists(string $relativePath): bool
{
    return is_file(project_artifact_fs_path($relativePath));
}

function project_first_matching_relative_path(string $baseRelativePath, array $patterns): ?string
{
    $basePath = project_artifact_fs_path($baseRelativePath);
    if (!is_dir($basePath)) {
        return null;
    }

    foreach ($patterns as $pattern) {
        $matches = glob($basePath . DIRECTORY_SEPARATOR . $pattern);
        if (!empty($matches)) {
            sort($matches);
            $match = $matches[0];
            return $baseRelativePath . '/' . basename($match);
        }
    }

    return null;
}

function project_collect_relative_paths(string $baseRelativePath, array $patterns): array
{
    $basePath = project_artifact_fs_path($baseRelativePath);
    if (!is_dir($basePath)) {
        return [];
    }

    $relativeMatches = [];
    foreach ($patterns as $pattern) {
        foreach (glob($basePath . DIRECTORY_SEPARATOR . $pattern) ?: [] as $match) {
            $relativeMatches[] = $baseRelativePath . '/' . basename($match);
        }
    }

    $relativeMatches = array_values(array_unique($relativeMatches));
    sort($relativeMatches);

    return $relativeMatches;
}

function project_collect_screenshot_artifacts(string $capstoneRoot): array
{
    return project_collect_relative_paths($capstoneRoot . '/Screenshots', ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']);
}

function project_dataset_patterns(): array
{
    return ['*.csv', '*.xlsx', '*.xls', '*.zip', '*.npz'];
}

function project_dataset_label(string $relativePath): string
{
    $extension = strtolower(pathinfo($relativePath, PATHINFO_EXTENSION));

    return match ($extension) {
        'csv' => 'Original CSV Dataset',
        'xlsx', 'xls' => 'Original Spreadsheet Dataset',
        'zip' => 'Original ZIP Dataset',
        'npz' => 'Original NPZ Dataset',
        default => 'Original Dataset',
    };
}

function project_dataset_summary(string $relativePath): string
{
    $extension = strtolower(pathinfo($relativePath, PATHINFO_EXTENSION));

    return match ($extension) {
        'csv' => 'View the original source CSV staged for this capstone or download the raw file.',
        'xlsx', 'xls' => 'Open the original spreadsheet source staged for this capstone or download the raw file.',
        'zip' => 'Open the staged ZIP package for this capstone or download the original archive.',
        'npz' => 'Open the staged NumPy archive for this capstone or download the original file.',
        default => 'Open the original source dataset staged for this capstone or download the raw file.',
    };
}

function project_dataset_note(string $relativePath): string
{
    $extension = strtolower(pathinfo($relativePath, PATHINFO_EXTENSION));

    return match ($extension) {
        'csv' => 'Dataset file served from the FrancisBurnet site when this capstone includes a CSV dataset.',
        'xlsx', 'xls' => 'Spreadsheet dataset served from the FrancisBurnet site for this capstone.',
        'zip' => 'ZIP dataset package served from the FrancisBurnet site for this capstone.',
        'npz' => 'NumPy dataset archive served from the FrancisBurnet site for this capstone.',
        default => 'Dataset file served from the FrancisBurnet site for this capstone.',
    };
}

function project_dataset_path(string $capstoneRoot): ?string
{
    return project_first_matching_relative_path($capstoneRoot, project_dataset_patterns());
}

function project_screenshot_manifest_path(string $capstoneRoot): ?string
{
    $manifestPath = $capstoneRoot . '/Screenshots/README.md';
    return project_artifact_exists($manifestPath) ? $manifestPath : null;
}

function project_inline_markup(string $text): string
{
    $escaped = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $escaped = (string) preg_replace('/\*\*([^*]+)\*\*/', '<strong>$1</strong>', $escaped);
    return (string) preg_replace('/`([^`]+)`/', '<code>$1</code>', $escaped);
}

function project_render_markdown_lines(array $lines): string
{
    $html = [];
    $inList = false;

    foreach ($lines as $line) {
        $trimmed = trim((string) $line);
        if ($trimmed === '') {
            if ($inList) {
                $html[] = '</ul>';
                $inList = false;
            }
            continue;
        }

        if (preg_match('/^(#{1,6})\s+(.*)$/', $trimmed, $matches) === 1) {
            if ($inList) {
                $html[] = '</ul>';
                $inList = false;
            }

            $level = strlen($matches[1]);
            $html[] = sprintf('<h%d>%s</h%d>', $level, project_inline_markup($matches[2]), $level);
            continue;
        }

        if (preg_match('/^[-*]\s+(.*)$/', $trimmed, $matches) === 1) {
            if (!$inList) {
                $html[] = '<ul>';
                $inList = true;
            }

            $html[] = '<li>' . project_inline_markup($matches[1]) . '</li>';
            continue;
        }

        if ($inList) {
            $html[] = '</ul>';
            $inList = false;
        }

        $html[] = '<p>' . project_inline_markup($trimmed) . '</p>';
    }

    if ($inList) {
        $html[] = '</ul>';
    }

    return implode("\n", $html);
}

function project_render_notebook_html(string $relativePath): ?string
{
    if (!project_artifact_exists($relativePath)) {
        return null;
    }

    $rawContent = (string) file_get_contents(project_artifact_fs_path($relativePath));
    $decoded = json_decode($rawContent, true);
    $cells = $decoded['cells'] ?? null;

    if (!is_array($cells)) {
        return '<div class="viewer"><pre>' . htmlspecialchars($rawContent, ENT_QUOTES, 'UTF-8') . '</pre></div>';
    }

    ob_start();
    ?>
    <div class="notebook-view">
        <?php foreach ($cells as $index => $cell): ?>
            <?php
            $cellType = strtolower((string) ($cell['cell_type'] ?? 'unknown'));
            $language = (string) ($cell['metadata']['language'] ?? ($cellType === 'code' ? 'python' : $cellType));
            $sourceLines = is_array($cell['source'] ?? null) ? $cell['source'] : [];
            $sourceText = implode('', array_map(static fn($line): string => (string) $line, $sourceLines));
            $outputs = is_array($cell['outputs'] ?? null) ? $cell['outputs'] : [];
            ?>
            <section class="notebook-cell notebook-cell--<?php echo htmlspecialchars($cellType, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="notebook-cell__meta">
                    Cell <?php echo $index + 1; ?>
                    <span><?php echo htmlspecialchars(ucfirst($cellType), ENT_QUOTES, 'UTF-8'); ?><?php echo $cellType === 'code' ? ' · ' . htmlspecialchars($language, ENT_QUOTES, 'UTF-8') : ''; ?></span>
                </div>

                <?php if ($cellType === 'markdown'): ?>
                    <div class="notebook-markdown">
                        <?php echo project_render_markdown_lines($sourceLines); ?>
                    </div>
                <?php else: ?>
                    <div class="viewer notebook-code"><pre><?php echo htmlspecialchars($sourceText, ENT_QUOTES, 'UTF-8'); ?></pre></div>
                    <?php if ($outputs !== []): ?>
                        <div class="notebook-output">
                            <div class="notebook-output__label">Output</div>
                            <?php foreach ($outputs as $output): ?>
                                <?php
                                $outputText = '';
                                if (isset($output['text'])) {
                                    $textValue = $output['text'];
                                    $outputText = is_array($textValue) ? implode('', array_map(static fn($line): string => (string) $line, $textValue)) : (string) $textValue;
                                } elseif (isset($output['data']['text/plain'])) {
                                    $textValue = $output['data']['text/plain'];
                                    $outputText = is_array($textValue) ? implode('', array_map(static fn($line): string => (string) $line, $textValue)) : (string) $textValue;
                                }
                                ?>
                                <?php if ($outputText !== ''): ?>
                                    <pre><?php echo htmlspecialchars($outputText, ENT_QUOTES, 'UTF-8'); ?></pre>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </section>
        <?php endforeach; ?>
    </div>
    <?php

    return (string) ob_get_clean();
}

function project_render_embedded_pdf_section(
    string $pdfPath,
    string $title = 'Original Project PDF',
    string $summary = 'The original project directions are embedded here so the source problem statement stays visible before the scoped checklist.',
    ?string $returnPath = null
): string {
    if (!project_artifact_exists($pdfPath)) {
        return '';
    }

    $viewerUrl = project_artifact_url($pdfPath, true, false, $returnPath) . '&embed=1';
    $viewUrl = project_artifact_url($pdfPath, true, false, $returnPath);
    $downloadUrl = project_artifact_url($pdfPath, false, true);

    ob_start();
    ?>
    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <p><?php echo htmlspecialchars($summary, ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="pdf-embed-frame mb-3">
            <iframe
                src="<?php echo htmlspecialchars($viewerUrl, ENT_QUOTES, 'UTF-8'); ?>"
                title="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                loading="lazy"
            ></iframe>
        </div>
        <div class="artifact-actions">
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars($viewUrl, ENT_QUOTES, 'UTF-8'); ?>">Open Viewer</a>
            <a class="btn btn-primary" href="<?php echo htmlspecialchars($downloadUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download PDF</a>
        </div>
    </section>
    <?php

    return (string) ob_get_clean();
}

function build_capstone_artifact_links(array $capstoneProject): array
{
    $capstoneRoot = capstone_relative_root($capstoneProject);
    $artifactSectionReturnPath = anchored_return_path('data-artifact-links');
    $links = [];

    $pdfPath = project_first_matching_relative_path($capstoneRoot, ['Capstone_Session_*.pdf']);
    if ($pdfPath) {
        $links[] = [
            'label' => 'Project PDF',
            'summary' => 'Open the copied project directions PDF for this capstone.',
            'viewHref' => project_artifact_url($pdfPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($pdfPath, false, true),
        ];
    }

    $notebookPath = project_first_matching_relative_path($capstoneRoot, ['*.ipynb']);
    if ($notebookPath) {
        $links[] = [
            'label' => 'Notebook Evidence',
            'summary' => 'View the notebook as a readable page or download the original file.',
            'viewHref' => project_artifact_url($notebookPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($notebookPath, false, true),
        ];
    }

    $requirementsPath = project_first_matching_relative_path($capstoneRoot . '/requirements', ['*.md']);
    if ($requirementsPath) {
        $links[] = [
            'label' => 'Requirements File',
            'summary' => 'Open the generated requirements file for the website workflow.',
            'viewHref' => project_artifact_url($requirementsPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($requirementsPath, false, true),
        ];
    }

    $datasetPath = project_dataset_path($capstoneRoot);
    if ($datasetPath) {
        $links[] = [
            'label' => project_dataset_label($datasetPath),
            'summary' => project_dataset_summary($datasetPath),
            'viewHref' => project_artifact_url($datasetPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($datasetPath, false, true),
        ];
    }

    $jsonOutputPath = project_first_matching_relative_path($capstoneRoot . '/outputs', ['*.json']);
    if ($jsonOutputPath) {
        $links[] = [
            'label' => 'JSON Output',
            'summary' => 'Open the generated JSON artifact or download the original file.',
            'viewHref' => project_artifact_url($jsonOutputPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($jsonOutputPath, false, true),
        ];
    }

    $csvOutputPath = project_first_matching_relative_path($capstoneRoot . '/outputs', ['*.csv']);
    if ($csvOutputPath) {
        $links[] = [
            'label' => 'CSV Output',
            'summary' => 'Open the generated CSV handoff or download the original file.',
            'viewHref' => project_artifact_url($csvOutputPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($csvOutputPath, false, true),
        ];
    }

    $screenshotArtifacts = project_collect_screenshot_artifacts($capstoneRoot);
    $screenshotPath = $screenshotArtifacts[0] ?? project_screenshot_manifest_path($capstoneRoot);
    if ($screenshotPath) {
        $links[] = [
            'label' => $screenshotArtifacts !== [] ? 'Screenshot Evidence' : 'Screenshot Manifest',
            'summary' => $screenshotArtifacts !== []
                ? 'Open staged screenshot evidence for this capstone.'
                : 'Open the screenshot manifest for this capstone.',
            'viewHref' => project_artifact_url($screenshotPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($screenshotPath, false, true),
        ];
    }

    return $links;
}

function project_capstone_summary_source_path(): string
{
    return project_root_path() . DIRECTORY_SEPARATOR . 'docs' . DIRECTORY_SEPARATOR . 'capstone_summaries.md';
}

function project_capstone_summary_map(): array
{
    static $summaryMap = null;

    if ($summaryMap !== null) {
        return $summaryMap;
    }

    $summaryPath = project_capstone_summary_source_path();
    if (!is_file($summaryPath)) {
        $summaryMap = [];
        return $summaryMap;
    }

    $rawContent = trim((string) file_get_contents($summaryPath));
    if ($rawContent === '') {
        $summaryMap = [];
        return $summaryMap;
    }

    $parts = preg_split('/^\s*(\d+):\s*$/m', $rawContent, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $summaryMap = [];

    if (!is_array($parts)) {
        return $summaryMap;
    }

    for ($index = 0; $index + 1 < count($parts); $index += 2) {
        $capstoneNumber = trim((string) $parts[$index]);
        $summaryBody = trim((string) $parts[$index + 1]);
        if ($capstoneNumber === '' || $summaryBody === '') {
            continue;
        }

        $summaryMap[$capstoneNumber] = $summaryBody;
    }

    return $summaryMap;
}

function project_capstone_number_from_key(string $pageKey): ?string
{
    if (preg_match('/capstone(?:-session)?-(\d+)/i', $pageKey, $matches) !== 1) {
        return null;
    }

    return $matches[1];
}

function project_capstone_summary_html(?string $pageKey = null): ?string
{
    $resolvedPageKey = $pageKey ?? pathinfo((string) ($_SERVER['SCRIPT_NAME'] ?? ''), PATHINFO_FILENAME);
    $capstoneNumber = project_capstone_number_from_key((string) $resolvedPageKey);
    if ($capstoneNumber === null) {
        return null;
    }

    $summaryMap = project_capstone_summary_map();
    $summaryText = $summaryMap[$capstoneNumber] ?? null;
    if (!is_string($summaryText) || trim($summaryText) === '') {
        return null;
    }

    $lines = preg_split('/\R/', $summaryText);
    if (!is_array($lines)) {
        return null;
    }

    return project_render_markdown_lines($lines);
}