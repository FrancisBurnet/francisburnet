<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Disclaimer';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Disclaimer Infographic';
    $heroCaption = 'Educational-use boundaries and interpretation guidance for model outputs.';
    $heroImageAlt = 'Disclaimer page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Disclaimer</h2>
        <p>This platform is for educational demonstration. Outputs are generated from class datasets and example modeling workflows.</p>
        <p>Use results as instructional references and validate decisions with domain-specific review before any production use.</p>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
