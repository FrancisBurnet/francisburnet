<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'About';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'About Page Infographic';
    $heroCaption = 'Visual summary of architecture: PHP frontend, Python API, and chart outputs.';
    $heroImageAlt = 'About page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">About This Platform</h2>
        <p>The platform is designed to convert notebook-only submissions into an interactive portfolio. Each capstone is organized by requirement order, with visual evidence and reproducible outputs.</p>
        <ul>
            <li>Frontend framework: PHP pages with shared components</li>
            <li>Compute framework: Python API for model/data execution</li>
            <li>Visualization framework: Chart.js and export-ready outputs</li>
            <li>Documentation framework: Requirement-first sections based on the course project rules standard</li>
        </ul>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
