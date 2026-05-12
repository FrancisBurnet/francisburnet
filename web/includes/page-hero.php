<?php

declare(strict_types=1);

require_once __DIR__ . '/artifact-helpers.php';

$heroImagePath = $heroImagePath ?? 'assets/images/hero-placeholder.svg';
$heroImageAlt = $heroImageAlt ?? 'Capstone infographic placeholder';
$heroTitle = $heroTitle ?? 'Capstone Infographic';
$heroSummaryHtml = $heroSummaryHtml ?? (function_exists('project_capstone_summary_html') ? project_capstone_summary_html() : null);
?>
<section class="hero-image-slot content-card p-3 p-lg-4 mb-4">
    <h2 class="section-title h4 mb-3"><?php echo htmlspecialchars($heroTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
    <img class="hero-image" src="<?php echo htmlspecialchars($heroImagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($heroImageAlt, ENT_QUOTES, 'UTF-8'); ?>">
    <?php if ($heroSummaryHtml !== null): ?>
        <div class="evidence-card capstone-summary-card p-3 mt-3">
            <span class="artifact-label capstone-summary-label mb-2">Capstone Summary</span>
            <div class="capstone-summary-copy mb-0"><?php echo $heroSummaryHtml; ?></div>
        </div>
    <?php endif; ?>
</section>