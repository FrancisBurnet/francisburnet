<?php

declare(strict_types=1);

$heroImagePath = $heroImagePath ?? 'assets/images/hero-placeholder.svg';
$heroImageAlt = $heroImageAlt ?? 'Capstone infographic placeholder';
$heroTitle = $heroTitle ?? 'Capstone Infographic';
?>
<section class="hero-image-slot content-card p-3 p-lg-4 mb-4">
    <h2 class="section-title h4 mb-3"><?php echo htmlspecialchars($heroTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
    <img class="hero-image" src="<?php echo htmlspecialchars($heroImagePath, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($heroImageAlt, ENT_QUOTES, 'UTF-8'); ?>">
</section>