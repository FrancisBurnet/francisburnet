<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Home';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Home Page Infographic';
    $heroCaption = 'High-level visual story of the incremental capstone website concept.';
    $heroImageAlt = 'Home page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Incremental Capstone Website Concept</h2>
        <p>This website transforms class capstones into a production-facing portfolio where visitors can review the logic, trace the datasets, and inspect outputs across data science, machine learning, and deep learning work.</p>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Explain</h3>
                    <p class="mb-0">Each page explains objective, source data, and requirement coverage in grading-first structure.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Run</h3>
                    <p class="mb-0">Users can trigger Python-backed workflows from the front-end interface.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Visualize</h3>
                    <p class="mb-0">Results render as charts, metrics, downloadable artifacts, and linked capstone materials.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Quick Launch</h2>
        <p>Use these entry points to begin building your incremental capstone portfolio.</p>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-primary" href="incremental-capstone.php">Open Incremental Capstone Hub</a>
            <a class="btn btn-outline-dark" href="projects.php">Open Projects</a>
            <a class="btn btn-outline-secondary" href="about.php">Read About</a>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
