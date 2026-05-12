<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Privacy';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Privacy Infographic';
    $heroCaption = 'Data-handling model for user inputs, run logs, and optional analytics.';
    $heroImageAlt = 'Privacy page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Privacy</h2>
        <p>No personal data collection is enabled in this starter version. If analytics or user accounts are added later, this page should be updated with retention and consent policies.</p>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
