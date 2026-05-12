<?php

declare(strict_types=1);

$currentPage = $currentPage ?? '';
$siteKicker = $siteKicker ?? 'Applied Data Science Portfolio';
$siteName = $siteName ?? 'Incremental Capstone Studio';
$siteTagline = $siteTagline ?? '';
$headerHeadshotPath = $headerHeadshotPath ?? null;
$headerHeadshotAlt = $headerHeadshotAlt ?? 'Site headshot';
$pageTitle = $pageTitle ?? $siteName . ($currentPage ? ' | ' . $currentPage : '');
$headExtras = $headExtras ?? '';
$stylesPathCandidates = [
    __DIR__ . '/../public/assets/css/styles.css',
    __DIR__ . '/../httpdocs/assets/css/styles.css',
];
$stylesVersion = '1';
foreach ($stylesPathCandidates as $stylesPath) {
    if (is_file($stylesPath)) {
        $stylesVersion = (string) filemtime($stylesPath);
        break;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;700&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css?v=<?php echo rawurlencode($stylesVersion); ?>" rel="stylesheet">
    <?php echo $headExtras; ?>
</head>
<body>
<header class="hero-shell">
    <div class="container py-4">
        <div class="header-layout d-flex flex-column flex-lg-row justify-content-between gap-3 align-items-start align-items-lg-center">
            <div class="header-copy">
                <p class="kicker mb-1"><?php echo htmlspecialchars($siteKicker, ENT_QUOTES, 'UTF-8'); ?></p>
                <h1 class="site-title mb-2"><?php echo htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8'); ?></h1>
                <p class="site-tagline mb-0"><?php echo htmlspecialchars($siteTagline, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <?php if ($headerHeadshotPath !== null): ?>
                <div class="header-headshot-shell">
                    <img class="header-headshot" src="<?php echo htmlspecialchars($headerHeadshotPath, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($headerHeadshotAlt, ENT_QUOTES, 'UTF-8'); ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>
