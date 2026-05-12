<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Terms of Use';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Terms of Use Infographic';
    $heroCaption = 'Acceptable-use and system safety constraints for interactive model runs.';
    $heroImageAlt = 'Terms of use page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Terms of Use</h2>
        <p>By using this educational platform, users agree to lawful use, no abuse of compute resources, and no attempt to run arbitrary code beyond exposed parameter controls.</p>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
