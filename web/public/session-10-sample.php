<?php
declare(strict_types=1);

function resolveSession10AssetPath(string $relativePath): ?string
{
    $candidates = [
        __DIR__ . '/../' . $relativePath,
        __DIR__ . '/../../' . $relativePath,
    ];

    foreach ($candidates as $candidate) {
        if (is_file($candidate)) {
            return $candidate;
        }
    }

    return null;
}

$sampleMap = [
    's01' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/with_mask/with_mask_1.jpg',
    's02' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/with_mask/with_mask_100.jpg',
    's03' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/with_mask/with_mask_1000.jpg',
    's04' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/without_mask/without_mask_1.jpg',
    's05' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/without_mask/without_mask_100.jpg',
    's06' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/without_mask/without_mask_1000.jpg',
    's07' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/mask_worn_incorrect/1000.png',
    's08' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/mask_worn_incorrect/1001.png',
    's09' => 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10/data/mask_worn_incorrect/1004.png',
];

$sampleId = strtolower(trim((string) ($_GET['id'] ?? '')));
$relativePath = $sampleMap[$sampleId] ?? null;
$assetPath = $relativePath ? resolveSession10AssetPath($relativePath) : null;

if (!$assetPath) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Sample not found.';
    exit;
}

$mimeType = null;
if (function_exists('finfo_open')) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if ($finfo) {
        $mimeType = finfo_file($finfo, $assetPath) ?: null;
        finfo_close($finfo);
    }
}

if (!$mimeType) {
    $extension = strtolower(pathinfo($assetPath, PATHINFO_EXTENSION));
    $mimeType = $extension === 'png' ? 'image/png' : 'image/jpeg';
}

header('Content-Type: ' . $mimeType);
header('Content-Length: ' . (string) filesize($assetPath));
header('Cache-Control: public, max-age=3600');
readfile($assetPath);