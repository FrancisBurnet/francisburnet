<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Copyright';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Copyright Infographic';
    $heroCaption = 'Ownership and attribution map for code, datasets, and generated artifacts.';
    $heroImageAlt = 'Copyright page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Copyright</h2>
        <p>Course materials, dataset licenses, and code ownership terms should be tracked per project. Keep third-party attributions with each capstone artifact when required.</p>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
