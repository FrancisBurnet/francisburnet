<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Incremental Capstone';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Capstone Session Infographic';
    $heroCaption = 'Session-specific blueprint covering objective, requirement order, PHP presentation, and outputs.';
    $heroImageAlt = 'Capstone template infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Capstone Template (PHP Project Rules Standard)</h2>
        <p>This page is the reusable structure for each incremental capstone page in the FrancisBurnet PHP site.</p>
        <p class="mb-0">Implementation standard: <code>docs/Project_DEV_Rules_PROMPT_PHP_TRANSLATION.md</code></p>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h3 class="h5">1) Objective</h3>
        <p>State the requirement-aligned objective, source folder, and expected outputs.</p>
        <h3 class="h5 mt-4">2) Requirement Checklist</h3>
        <p>Render requirements in strict order from the extracted capstone directions file.</p>
        <h3 class="h5 mt-4">3) Code Walkthrough</h3>
        <p>Display requirement-by-requirement notebook, script, or code evidence with plain-language explanation.</p>
        <h3 class="h5 mt-4">4) Data and Artifact Links</h3>
        <p>Link the copied notebook, dataset, PDF, screenshots, and exported outputs from the mapped capstone folder.</p>
        <h3 class="h5 mt-4">5) Run Controls or Execution Notes</h3>
        <p>Expose safe form inputs only when a real backend path exists; otherwise document the execution flow clearly.</p>
        <h3 class="h5 mt-4">6) Outputs</h3>
        <p>Show metrics, charts, tables, narrative summaries, and links to exported artifacts.</p>
    </section>

    <section class="content-card p-4 p-lg-5">
        <h3 class="h5">Starter Input Controls</h3>
        <form class="row g-3" method="post" action="#">
            <div class="col-md-4">
                <label class="form-label" for="sampleInputA">Parameter A</label>
                <input class="form-control" id="sampleInputA" name="sampleInputA" type="number" value="10" min="0">
            </div>
            <div class="col-md-4">
                <label class="form-label" for="sampleInputB">Parameter B</label>
                <input class="form-control" id="sampleInputB" name="sampleInputB" type="number" value="25" min="0">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary w-100" type="submit">Run Capstone</button>
            </div>
        </form>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
