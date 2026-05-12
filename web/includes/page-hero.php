<?php

declare(strict_types=1);

$heroImagePath = $heroImagePath ?? 'assets/images/hero-placeholder.svg';
$heroImageAlt = $heroImageAlt ?? 'Capstone infographic placeholder';
$heroTitle = $heroTitle ?? 'Hero Infographic';
$heroCaption = $heroCaption ?? 'Replace with capstone-specific infographic image.';
?>
<section class="hero-image-slot content-card p-3 p-lg-4 mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <h2 class="section-title h4 mb-0"><?php echo htmlspecialchars($heroTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
        <span class="hero-chip">Infographic Area</span>
    </div>
    <img class="hero-image" src="<?php echo htmlspecialchars($heroImagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($heroImageAlt, ENT_QUOTES, 'UTF-8'); ?>">
    <p class="text-muted mb-0 mt-2"><?php echo htmlspecialchars($heroCaption, ENT_QUOTES, 'UTF-8'); ?></p>
</section>