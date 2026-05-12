<?php

declare(strict_types=1);

function normalized_return_target(string $candidate): ?string
{
    if ($candidate === '') {
        return null;
    }

    $parts = parse_url($candidate);
    if ($parts === false) {
        return null;
    }

    if (isset($parts['scheme']) || isset($parts['host'])) {
        return null;
    }

    $path = $parts['path'] ?? '';
    if ($path === '' || str_starts_with($path, '//') || basename($path) === 'artifact.php') {
        return null;
    }

    $normalized = ltrim($path, '/');
    if ($normalized === '') {
        return null;
    }

    if (!empty($parts['query'])) {
        $normalized .= '?' . $parts['query'];
    }

    if (!empty($parts['fragment'])) {
        $normalized .= '#' . $parts['fragment'];
    }

    return $normalized;
}

function artifact_back_url(): string
{
    $requestedReturn = isset($_GET['return']) ? trim((string) $_GET['return']) : '';
    $normalizedReturn = normalized_return_target($requestedReturn);
    if ($normalizedReturn !== null) {
        return $normalizedReturn;
    }

    $referer = isset($_SERVER['HTTP_REFERER']) ? trim((string) $_SERVER['HTTP_REFERER']) : '';
    if ($referer !== '') {
        $parts = parse_url($referer);
        if ($parts !== false) {
            $refererHost = $parts['host'] ?? '';
            $currentHost = $_SERVER['HTTP_HOST'] ?? '';
            if ($refererHost === '' || strcasecmp($refererHost, $currentHost) === 0) {
                $path = $parts['path'] ?? '';
                $query = $parts['query'] ?? '';
                $fragment = $parts['fragment'] ?? '';
                $candidate = $path;
                if ($query !== '') {
                    $candidate .= '?' . $query;
                }
                if ($fragment !== '') {
                    $candidate .= '#' . $fragment;
                }
                $normalizedReferer = normalized_return_target($candidate);
                if ($normalizedReferer !== null) {
                    return $normalizedReferer;
                }
            }
        }
    }

    return 'incremental-capstone.php';
}

function artifact_back_context(string $backUrl, array $capstoneProjects, array $navItems): array
{
    $backPath = parse_url($backUrl, PHP_URL_PATH);
    $backFile = $backPath ? basename($backPath) : $backUrl;

    foreach ($capstoneProjects as $project) {
        if (($project['href'] ?? '') === $backFile) {
            return [
                'label' => (string) $project['label'],
                'href' => $backUrl,
                'isCapstone' => true,
            ];
        }
    }

    foreach ($navItems as $item) {
        if (($item['href'] ?? '') === $backFile) {
            return [
                'label' => (string) $item['label'],
                'href' => $backUrl,
                'isCapstone' => strcasecmp((string) $item['label'], 'Incremental Capstone') === 0,
            ];
        }
    }

    return [
        'label' => 'Incremental Capstone Hub',
        'href' => 'incremental-capstone.php',
        'isCapstone' => true,
    ];
}

function artifact_inline_markup(string $text): string
{
    $escaped = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    return (string) preg_replace('/`([^`]+)`/', '<code>$1</code>', $escaped);
}

function artifact_render_markdown_lines(array $lines): string
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
            $html[] = sprintf('<h%d>%s</h%d>', $level, artifact_inline_markup($matches[2]), $level);
            continue;
        }

        if (preg_match('/^[-*]\s+(.*)$/', $trimmed, $matches) === 1) {
            if (!$inList) {
                $html[] = '<ul>';
                $inList = true;
            }
            $html[] = '<li>' . artifact_inline_markup($matches[1]) . '</li>';
            continue;
        }

        if ($inList) {
            $html[] = '</ul>';
            $inList = false;
        }

        $html[] = '<p>' . artifact_inline_markup($trimmed) . '</p>';
    }

    if ($inList) {
        $html[] = '</ul>';
    }

    return implode("\n", $html);
}

function artifact_render_notebook(array $decoded, string $rawContent): string
{
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
                        <?php echo artifact_render_markdown_lines($sourceLines); ?>
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

$projectRootCandidates = [
    realpath(__DIR__ . '/../../'),
    realpath(__DIR__ . '/../'),
];

$projectRoot = false;
foreach ($projectRootCandidates as $candidate) {
    if ($candidate !== false && is_dir($candidate . DIRECTORY_SEPARATOR . 'Incremental Capstones')) {
        $projectRoot = $candidate;
        break;
    }
}

$capstoneRoot = $projectRoot ? realpath($projectRoot . DIRECTORY_SEPARATOR . 'Incremental Capstones') : false;

if (!$projectRoot || !$capstoneRoot) {
    http_response_code(500);
    exit('Project roots are not available.');
}

$relativePath = isset($_GET['path']) ? trim((string) $_GET['path']) : '';
$relativePath = str_replace('\\', '/', $relativePath);
$relativePath = ltrim($relativePath, '/');

if ($relativePath === '' || str_contains($relativePath, '..')) {
    http_response_code(400);
    exit('Invalid artifact path.');
}

$targetPath = realpath($projectRoot . DIRECTORY_SEPARATOR . $relativePath);

if (!$targetPath || !is_file($targetPath)) {
    http_response_code(404);
    exit('Artifact not found.');
}

$capstoneRootPrefix = rtrim($capstoneRoot, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
if (!str_starts_with($targetPath, $capstoneRootPrefix)) {
    http_response_code(403);
    exit('Artifact access denied.');
}

$extension = strtolower((string) pathinfo($targetPath, PATHINFO_EXTENSION));
$allowedExtensions = [
    'csv',
    'ipynb',
    'json',
    'jpeg',
    'jpg',
    'md',
    'pdf',
    'png',
    'txt',
    'webp',
];

if (!in_array($extension, $allowedExtensions, true)) {
    http_response_code(403);
    exit('Artifact type is not allowed.');
}

$mimeMap = [
    'csv' => 'text/csv; charset=utf-8',
    'ipynb' => 'application/json; charset=utf-8',
    'json' => 'application/json; charset=utf-8',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpeg',
    'md' => 'text/markdown; charset=utf-8',
    'pdf' => 'application/pdf',
    'png' => 'image/png',
    'txt' => 'text/plain; charset=utf-8',
    'webp' => 'image/webp',
];

$contentType = $mimeMap[$extension] ?? 'application/octet-stream';
$mode = isset($_GET['mode']) ? strtolower(trim((string) $_GET['mode'])) : '';
$download = isset($_GET['download']) && $_GET['download'] === '1';
$textViewExtensions = ['csv', 'ipynb', 'json', 'md', 'txt'];
$viewerScript = '';
$showRawFileLink = $extension !== 'pdf';
$viewerIntro = 'This view keeps the artifact inside the FrancisBurnet workflow and presents the file in a readable browser page when possible.';

if ($mode === 'view') {
    $rawContent = (string) file_get_contents($targetPath);
    $downloadUrl = 'artifact.php?' . http_build_query([
        'path' => $relativePath,
        'download' => '1',
    ]);
    $inlineUrl = 'artifact.php?' . http_build_query([
        'path' => $relativePath,
    ]);
    $displayTitle = basename($targetPath);
    $renderedBody = '';
    $backUrl = artifact_back_url();

    if ($extension === 'pdf') {
        $renderedBody = '<p>This PDF is rendered directly inside the site viewer.</p>'
            . '<div class="pdf-status" id="pdf-status">Loading PDF pages...</div>'
            . '<div class="pdf-viewer" id="pdf-viewer"></div>';
        $viewerScript = <<<'HTML'
    <script type="module">
        import * as pdfjsLib from 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.min.mjs';

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/4.4.168/pdf.worker.min.mjs';

        const pdfUrl = __PDF_URL__;
        const statusNode = document.getElementById('pdf-status');
        const viewerNode = document.getElementById('pdf-viewer');

        const render = async () => {
            try {
                const pdf = await pdfjsLib.getDocument(pdfUrl).promise;
                statusNode.textContent = `Rendering ${pdf.numPages} page(s)...`;

                for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber += 1) {
                    const page = await pdf.getPage(pageNumber);
                    const baseViewport = page.getViewport({ scale: 1 });
                    const targetWidth = Math.min(viewerNode.clientWidth || 900, 900);
                    const scale = targetWidth / baseViewport.width;
                    const viewport = page.getViewport({ scale });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');

                    canvas.width = Math.ceil(viewport.width);
                    canvas.height = Math.ceil(viewport.height);
                    canvas.className = 'pdf-canvas';

                    const pageShell = document.createElement('section');
                    pageShell.className = 'pdf-page';
                    pageShell.appendChild(canvas);
                    viewerNode.appendChild(pageShell);

                    await page.render({ canvasContext: context, viewport }).promise;
                }

                statusNode.textContent = `Rendered ${pdf.numPages} page(s).`;
            } catch (error) {
                console.error(error);
                statusNode.textContent = 'PDF rendering failed in the browser. Use Download Original File as fallback.';
            }
        };

        render();
    </script>
HTML;
        $viewerScript = str_replace(
            '__PDF_URL__',
            json_encode($inlineUrl, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP),
            $viewerScript
        );
    } elseif (in_array($extension, ['png', 'jpg', 'jpeg', 'webp'], true)) {
        $renderedBody = '<p>This image artifact is shown directly in the viewer page.</p>'
            . '<div class="image-frame">'
            . '<img class="artifact-image" src="' . htmlspecialchars($inlineUrl, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($displayTitle, ENT_QUOTES, 'UTF-8') . '">'
            . '</div>';
    } elseif ($extension === 'csv') {
        $handle = fopen($targetPath, 'rb');
        $rows = [];
        $headers = [];
        if ($handle !== false) {
            $headers = fgetcsv($handle, 0, ',', '"', '') ?: [];
            $rowLimit = 40;
            $rowCount = 0;
            while (($row = fgetcsv($handle, 0, ',', '"', '')) !== false && $rowCount < $rowLimit) {
                $rows[] = $row;
                $rowCount++;
            }
            fclose($handle);
        }

        ob_start();
        ?>
        <p>This CSV is rendered as a table preview. Large files are intentionally capped in the browser view.</p>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <?php foreach ($headers as $header): ?>
                            <th><?php echo htmlspecialchars((string) $header, ENT_QUOTES, 'UTF-8'); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <?php foreach ($row as $value): ?>
                                <td><?php echo htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
        $renderedBody = (string) ob_get_clean();
    } elseif ($extension === 'md') {
        $lines = preg_split('/\R/', $rawContent) ?: [];
        $renderedBody = artifact_render_markdown_lines($lines);
    } elseif ($extension === 'ipynb') {
        $decoded = json_decode($rawContent, true);
        $renderedBody = is_array($decoded)
            ? artifact_render_notebook($decoded, $rawContent)
            : '<div class="viewer"><pre>' . htmlspecialchars($rawContent, ENT_QUOTES, 'UTF-8') . '</pre></div>';
    } elseif ($extension === 'json') {
        $decoded = json_decode($rawContent, true);
        $prettyJson = $decoded === null ? $rawContent : json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $renderedBody = '<div class="viewer"><pre>' . htmlspecialchars((string) $prettyJson, ENT_QUOTES, 'UTF-8') . '</pre></div>';
    } else {
        $renderedBody = '<div class="viewer"><pre>' . htmlspecialchars($rawContent, ENT_QUOTES, 'UTF-8') . '</pre></div>';
    }

    require_once __DIR__ . '/../includes/config.php';
    $currentPage = 'Incremental Capstone';
    $pageTitle = $displayTitle . ' | Artifact Viewer';
    $backContext = artifact_back_context($backUrl, $capstoneProjects, $navItems);
    $backLabel = 'Back to ' . $backContext['label'];
    $breadcrumbs = [
        ['label' => 'Incremental Capstone', 'href' => 'incremental-capstone.php'],
    ];
    if (($backContext['href'] ?? '') !== 'incremental-capstone.php' && ($backContext['isCapstone'] ?? false)) {
        $breadcrumbs[] = [
            'label' => (string) $backContext['label'],
            'href' => (string) $backContext['href'],
        ];
    }
    $breadcrumbs[] = ['label' => 'Artifact Viewer', 'href' => ''];
    $headExtras = <<<'HTML'
    <style>
        .artifact-viewer-shell {
            background: #ffffff;
            border: 1px solid #dbe4ee;
            border-radius: 1rem;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.12);
        }

        .artifact-viewer-top {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 1rem;
            align-items: flex-start;
        }

        .artifact-breadcrumb {
            margin-bottom: 1rem;
        }

        .artifact-breadcrumb .breadcrumb {
            margin-bottom: 0;
        }

        .artifact-kicker {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #0b3c5d;
            background: #e0f2fe;
            border: 1px solid #93c5fd;
            border-radius: 999px;
            padding: 0.25rem 0.65rem;
        }

        .artifact-path {
            color: #475569;
            word-break: break-all;
        }

        .artifact-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .rendered {
            margin-top: 1rem;
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 1rem;
            padding: 1rem;
            overflow: auto;
        }

        .rendered h1,
        .rendered h2,
        .rendered h3,
        .rendered h4,
        .rendered h5,
        .rendered h6 {
            margin-top: 0;
            color: #0b3c5d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th,
        td {
            border: 1px solid #dbe4ee;
            padding: 0.55rem 0.7rem;
            text-align: left;
            vertical-align: top;
            overflow-wrap: anywhere;
        }

        th {
            background: #f8fafc;
        }

        .table-wrap {
            overflow: auto;
        }

        .pdf-status {
            margin-top: 1rem;
            color: #0b3c5d;
            font-weight: 600;
        }

        .pdf-viewer {
            margin-top: 1rem;
            display: grid;
            gap: 1rem;
        }

        .pdf-page {
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 1rem;
            padding: 0.75rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            overflow: auto;
        }

        .pdf-canvas {
            display: block;
            width: 100%;
            height: auto;
            margin: 0 auto;
            border-radius: 0.5rem;
            background: #fff;
        }

        .image-frame {
            margin-top: 1rem;
            background: #fff;
            border: 1px solid #dbe4ee;
            border-radius: 1rem;
            padding: 1rem;
        }

        .artifact-image {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            border-radius: 0.75rem;
            border: 1px solid #dbe4ee;
        }

        .viewer {
            margin-top: 1rem;
            background: #0f172a;
            color: #e2e8f0;
            border-radius: 1rem;
            padding: 1rem;
            overflow: auto;
            border: 1px solid #1e293b;
        }

        pre {
            margin: 0;
            white-space: pre-wrap;
            word-break: break-word;
            font-family: Consolas, "Courier New", monospace;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .notebook-view {
            display: grid;
            gap: 1rem;
        }

        .notebook-cell {
            border: 1px solid #dbe4ee;
            border-radius: 1rem;
            background: #f8fafc;
            overflow: hidden;
        }

        .notebook-cell__meta {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: #e2e8f0;
            color: #0f172a;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .notebook-markdown {
            padding: 1rem;
        }

        .notebook-markdown > :last-child {
            margin-bottom: 0;
        }

        .notebook-markdown code,
        .notebook-output code {
            background: #e2e8f0;
            color: #0f172a;
            border-radius: 0.4rem;
            padding: 0.1rem 0.35rem;
        }

        .notebook-code {
            margin-top: 0;
            border-radius: 0;
            border-left: 0;
            border-right: 0;
            border-bottom: 0;
        }

        .notebook-output {
            padding: 1rem;
            background: #fff;
            border-top: 1px solid #dbe4ee;
        }

        .notebook-output__label {
            margin-bottom: 0.5rem;
            color: #0b3c5d;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .notebook-output pre {
            background: #f8fafc;
            color: #0f172a;
            border: 1px solid #dbe4ee;
            border-radius: 0.75rem;
            padding: 0.85rem;
        }

        @media (max-width: 768px) {
            .artifact-actions {
                justify-content: flex-start;
            }
        }
    </style>
HTML;
    $pageScripts = $viewerScript;
    header('Content-Type: text/html; charset=utf-8');
    require_once __DIR__ . '/../includes/header.php';
    require_once __DIR__ . '/../includes/nav.php';
    ?>
<main class="container py-5">
    <section class="content-card p-4 p-lg-5 artifact-viewer-shell">
        <nav class="artifact-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb): ?>
                    <?php if (($breadcrumb['href'] ?? '') !== ''): ?>
                        <li class="breadcrumb-item"><a href="<?php echo htmlspecialchars((string) $breadcrumb['href'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars((string) $breadcrumb['label'], ENT_QUOTES, 'UTF-8'); ?></a></li>
                    <?php else: ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars((string) $breadcrumb['label'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </nav>
        <div class="artifact-viewer-top">
            <div>
                <span class="artifact-kicker mb-2">Artifact Viewer</span>
                <h2 class="section-title mt-3 mb-2"><?php echo htmlspecialchars($displayTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="artifact-path mb-0"><?php echo htmlspecialchars($relativePath, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="artifact-actions">
                <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars($backUrl, ENT_QUOTES, 'UTF-8'); ?>" onclick="if (window.history.length > 1) { event.preventDefault(); window.history.back(); }"><?php echo htmlspecialchars($backLabel, ENT_QUOTES, 'UTF-8'); ?></a>
                <a class="btn btn-primary" href="<?php echo htmlspecialchars($downloadUrl, ENT_QUOTES, 'UTF-8'); ?>">Download Original File</a>
                <?php if ($showRawFileLink): ?>
                    <a class="btn btn-outline-secondary" href="<?php echo htmlspecialchars($inlineUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Raw File</a>
                <?php endif; ?>
            </div>
        </div>
        <p class="mt-4 mb-0"><?php echo htmlspecialchars($viewerIntro, ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="rendered">
            <?php echo $renderedBody; ?>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
    <?php
    exit;
}

$disposition = $download ? 'attachment' : 'inline';

header('Content-Type: ' . $contentType);
header('Content-Length: ' . (string) filesize($targetPath));
if ($download) {
    header('Content-Disposition: ' . $disposition . '; filename="' . basename($targetPath) . '"');
}
header('X-Content-Type-Options: nosniff');

readfile($targetPath);
exit;