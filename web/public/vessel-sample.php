<?php
declare(strict_types=1);

function resolveVesselAssetPath(string $relativePath): ?string
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
    'v01' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/buoy/36.jpg',
    'v02' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/cruise_ship/59.jpg',
    'v03' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/ferry_boat/58.jpg',
    'v04' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/freight_boat/20.jpg',
    'v05' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/gondola/25.jpg',
    'v06' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/inflatable_boat/8.jpg',
    'v07' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/kayak/194.jpg',
    'v08' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/paper_boat/29.jpg',
    'v09' => 'Projects/Deep Learning Specialization/Automating Port Operations/data/boat_type_classification_dataset/sailboat/263.jpg',
];

$sampleId = strtolower(trim((string) ($_GET['id'] ?? '')));
$relativePath = $sampleMap[$sampleId] ?? null;
$assetPath = $relativePath ? resolveVesselAssetPath($relativePath) : null;

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
    $mimeType = 'image/jpeg';
}

header('Content-Type: ' . $mimeType);
header('Content-Length: ' . (string) filesize($assetPath));
header('Cache-Control: public, max-age=3600');
readfile($assetPath);
