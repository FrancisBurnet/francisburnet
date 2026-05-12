<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Projects';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Projects Infographic';
    $heroCaption = 'Portfolio overview showing each project family and linked capstone lineage.';
    $heroImageAlt = 'Projects page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Projects</h2>
        <p>This section is reserved for the graded end-of-class projects. It will be filled in after the incremental capstone pages are completed.</p>
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <div class="col"><div class="border rounded-3 p-3 h-100">Applied Machine Learning End-of-Class Projects</div></div>
            <div class="col"><div class="border rounded-3 p-3 h-100">Deep Learning End-of-Class Projects</div></div>
            <div class="col"><div class="border rounded-3 p-3 h-100">Python for AI End-of-Class Projects</div></div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
