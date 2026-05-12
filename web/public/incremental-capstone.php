<?php
require_once __DIR__ . '/../includes/config.php';
$capstoneProgramGroups = $capstoneProgramGroups ?? [];
$currentPage = 'Incremental Capstone';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Incremental Capstone Infographic';
    $heroCaption = 'Program map for applied data science, machine learning, and deep learning capstones 1 through 12.';
    $heroImageAlt = 'Incremental capstone page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Incremental Capstone Hub</h2>
        <p>Each session page follows the same structure: objective, requirement checklist, code walkthrough, parameter controls, and generated outputs, with source folders now staged inside the production tree for FrancisBurnet.</p>
        <div class="row g-3">
            <div class="col-lg-7">
                <h3 class="h5">Capstone Template Ready</h3>
                <p>This starter template demonstrates the full pattern for one capstone and can be cloned for sessions 1 to 12.</p>
                <a class="btn btn-primary" href="capstone-template.php">Open Capstone Template</a>
            </div>
            <div class="col-lg-5">
                <div class="chart-shell">
                    <canvas id="demoChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <?php foreach ($capstoneProgramGroups as $group): ?>
        <section class="content-card p-4 p-lg-5 mb-4" id="<?php echo htmlspecialchars($group['anchor'], ENT_QUOTES, 'UTF-8'); ?>">
            <h2 class="section-title"><?php echo htmlspecialchars($group['label'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <p><?php echo htmlspecialchars($group['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <?php foreach ($group['children'] as $project): ?>
                    <div class="col">
                        <a class="d-block border rounded-3 p-3 text-decoration-none text-dark h-100" href="<?php echo htmlspecialchars($project['href'], ENT_QUOTES, 'UTF-8'); ?>">
                            <strong><?php echo htmlspecialchars($project['label'], ENT_QUOTES, 'UTF-8'); ?></strong>
                            <span class="d-block text-muted mt-2"><?php echo htmlspecialchars($project['summary'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
