<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/artifact-helpers.php';

$currentPage = 'Projects';
$currentSubPage = 'Automating Port Operations';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

$projectRoot = 'Projects/Deep Learning Specialization/Automating Port Operations';
$colabNotebookUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/' . str_replace(' ', '%20', $projectRoot . '/notebooks/automating_port_operations_ordered_by_requirement.ipynb');
$notebookSourceUrl = project_artifact_absolute_url($projectRoot . '/notebooks/automating_port_operations_ordered_by_requirement.ipynb', true, false);
$requirementsUrl = project_artifact_absolute_url($projectRoot . '/requirements/automating_port_operations_requirements.md', false, true);
$manifestUrl = project_artifact_absolute_url($projectRoot . '/outputs/manifests/automating_port_operations_evidence_manifest.md', false, true);
$comparisonSummaryUrl = project_artifact_absolute_url($projectRoot . '/outputs/manifests/model_comparison_summary.json', false, true);
$comparisonNotesUrl = project_artifact_absolute_url($projectRoot . '/outputs/manifests/model_comparison_observations.txt', false, true);
$customTrainingUrl = project_artifact_absolute_url($projectRoot . '/outputs/plots/custom_cnn_training_curves.png', false, true);
$customConfusionUrl = project_artifact_absolute_url($projectRoot . '/outputs/plots/custom_cnn_confusion_matrix.png', false, true);
$transferTrainingUrl = project_artifact_absolute_url($projectRoot . '/outputs/plots/transfer_learning_training_curves.png', false, true);

$heroImagePath = 'assets/images/automating-port-operations-hero.svg';
$heroImageAlt = 'Automating Port Operations vessel infographic';
$heroTitle = 'Automating Port Operations Evidence Map';
$heroSummaryHtml = '<p class="mb-0">Vessel classifier page with the notebook, outputs, and saved metrics laid out in a clean project template.</p>';
?>
<main class="container py-5">
    <?php require __DIR__ . '/../includes/page-hero.php'; ?>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Project at a glance</h2>
        <p>This page presents the vessel classifier, the notebook that produced it, and the saved outputs that support the published result.</p>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $colabNotebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Run in Colab</a>
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $notebookSourceUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">View Notebook</a>
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $comparisonSummaryUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Metrics JSON</a>
        </div>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Objective</h2>
        <p>The goal is to classify vessels from images using the published notebook workflow and the saved model comparison outputs.</p>
        <p class="mb-0">The final result favors transfer learning, and the page keeps the notebook, evidence, and metrics easy to open from one place.</p>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Notebook and Evidence</h2>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $requirementsUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Requirements</span>
                    <h3 class="h5 mb-1">Verbatim task map</h3>
                    <p class="text-secondary mb-0">The requirement list that drives the notebook sections.</p>
                </a>
            </div>
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $manifestUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Evidence manifest</span>
                    <h3 class="h5 mb-1">Run outputs and artifacts</h3>
                    <p class="text-secondary mb-0">Saved notebooks, plots, metrics, and supporting notes.</p>
                </a>
            </div>
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $customTrainingUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Custom CNN plot</span>
                    <h3 class="h5 mb-1">Training curves</h3>
                    <p class="text-secondary mb-0">Baseline loss and accuracy history.</p>
                </a>
            </div>
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $customConfusionUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Custom CNN plot</span>
                    <h3 class="h5 mb-1">Confusion matrix</h3>
                    <p class="text-secondary mb-0">Class-by-class review heatmap for the baseline lane.</p>
                </a>
            </div>
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $transferTrainingUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Transfer learning plot</span>
                    <h3 class="h5 mb-1">Training curves</h3>
                    <p class="text-secondary mb-0">MobileNetV2 training history for the winning lane.</p>
                </a>
            </div>
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $comparisonSummaryUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Comparison summary</span>
                    <h3 class="h5 mb-1">Metrics JSON</h3>
                    <p class="text-secondary mb-0">Saved model comparison and held-out accuracy values.</p>
                </a>
            </div>
            <div class="col">
                <a class="artifact-card d-block p-3 h-100 text-decoration-none" href="<?php echo htmlspecialchars((string) $comparisonNotesUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="artifact-label d-inline-block mb-2">Comparison notes</span>
                    <h3 class="h5 mb-1">Final observation</h3>
                    <p class="text-secondary mb-0">The notebook note that records why transfer learning is preferred.</p>
                </a>
            </div>
            <div class="col">
                <div class="artifact-card p-3 h-100">
                    <span class="artifact-label d-inline-block mb-2">Notebook access</span>
                    <h3 class="h5 mb-1">Source notebook</h3>
                    <p class="text-secondary mb-3">Open the notebook source or launch it in Colab to rerun the workflow.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a class="btn btn-primary btn-sm" href="<?php echo htmlspecialchars((string) $colabNotebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Run in Colab</a>
                        <a class="btn btn-outline-dark btn-sm" href="<?php echo htmlspecialchars((string) $notebookSourceUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">View Notebook</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Outputs</h2>
        <p class="mb-3">Transfer learning is the published recommendation.</p>
        <div class="row row-cols-1 row-cols-lg-2 g-3">
            <div class="col">
                <div class="content-card p-3 h-100">
                    <h3 class="h5">Model result</h3>
                    <p class="mb-0">The comparison summary records 86.32% held-out accuracy for transfer learning versus 44.30% for the custom CNN.</p>
                </div>
            </div>
            <div class="col">
                <div class="content-card p-3 h-100">
                    <h3 class="h5">Final note</h3>
                    <p class="mb-0">The observation text records why transfer learning is preferred and keeps the project decision explicit.</p>
                </div>
            </div>
        </div>
        <div class="d-flex flex-wrap gap-2 mt-3">
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $comparisonNotesUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open comparison notes</a>
            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $notebookSourceUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open notebook source</a>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
