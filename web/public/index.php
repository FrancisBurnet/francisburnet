<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Home';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">

    <section class="content-card p-4 p-lg-5 mb-4 text-center">
        <img
            src="assets/images/fb-logo-long-dark.png"
            alt="Francis Burnet – AI Engineering Portfolio"
            class="home-hero-logo mb-4"
        >
        <p class="lead mb-0" style="max-width:52rem;margin:0 auto;">A production-facing portfolio that transforms class capstones into live, reviewable AI workflows across data science, machine learning, and deep learning.</p>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">What This Portfolio Does</h2>
        <div class="row g-3 mt-1">
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Explain</h3>
                    <p class="mb-0">Each page explains objective, source data, and requirement coverage in grading-first structure.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Run</h3>
                    <p class="mb-0">Notebooks and live demos let visitors inspect the actual model outputs, not just screenshots.</p>
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
        <p>Use these entry points to explore the incremental capstone portfolio.</p>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-primary" href="incremental-capstone.php">Open Incremental Capstone Hub</a>
            <a class="btn btn-outline-dark" href="projects.php">Open Projects</a>
            <a class="btn btn-outline-secondary" href="about.php">Read About</a>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
