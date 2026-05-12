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

    $datasetPath = project_first_matching_relative_path($capstoneRoot, ['*.csv']);
    if ($datasetPath) {
        $links[] = [
            'label' => 'Original CSV Dataset',
            'summary' => 'View the original source CSV staged for this capstone or download the raw file.',
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

    $screenshotPath = project_first_matching_relative_path($capstoneRoot . '/Screenshots', ['README.md', '*.png', '*.jpg', '*.jpeg', '*.webp']);
    if ($screenshotPath) {
        $links[] = [
            'label' => 'Screenshots',
            'summary' => 'Open screenshot evidence or the placeholder manifest for pending screenshots.',
            'viewHref' => project_artifact_url($screenshotPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($screenshotPath, false, true),
        ];
    }

    return $links;
}