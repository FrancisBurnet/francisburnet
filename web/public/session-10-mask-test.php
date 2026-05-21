<?php
require_once __DIR__ . '/../includes/config.php';

$currentPage = 'Incremental Capstone';
$currentSubPage = 'Session 10 Test';
$capstoneProject = $capstoneProjects[9];

function resolveCapstoneOutputPath(string $relativePath): ?string
{
    $candidates = [
        __DIR__ . '/../' . $relativePath,
        __DIR__ . '/../../' . $relativePath,
    ];

    foreach ($candidates as $candidate) {
        if (file_exists($candidate)) {
            return $candidate;
        }
    }

    return null;
}

$capstoneRoot = 'Incremental Capstones/Deep Learning Specialization/Capstone Session 10';
$capstoneSummaryPath = resolveCapstoneOutputPath($capstoneRoot . '/outputs/session_10_summary.json');
$optimizedSummaryPath = resolveCapstoneOutputPath($capstoneRoot . '/outputs/session_10_capstone_tfjs_optimized_export.json');

$capstoneSummary = $capstoneSummaryPath && file_exists($capstoneSummaryPath)
    ? json_decode((string) file_get_contents($capstoneSummaryPath), true)
    : [];
$optimizedSummary = $optimizedSummaryPath && file_exists($optimizedSummaryPath)
    ? json_decode((string) file_get_contents($optimizedSummaryPath), true)
    : [];

$capstoneModelResult = [];
foreach (($capstoneSummary['model_results'] ?? []) as $modelResult) {
    if (($modelResult['model'] ?? '') === 'ResNet50') {
        $capstoneModelResult = $modelResult;
        break;
    }
}

$capstoneAccuracy = (float) ($capstoneModelResult['test_accuracy'] ?? $capstoneSummary['best_model']['test_accuracy'] ?? 0.0);
$optimizedAccuracy = (float) ($optimizedSummary['test_accuracy'] ?? 0.0);
$optimizedModelName = (string) ($optimizedSummary['model'] ?? 'MobileNetV2');

$comparisonUrl = '/assets/demos/session-10-maskdetector.html?' . http_build_query([
    'compare' => '1',
    'frameId' => 'session10-test-frame',
    'eyebrow' => 'Live Test',
    'title' => 'Session 10 Mask Model Test Page',
    'description' => 'Testing page for the synchronized three-model comparison. Use this page to compare the original capstone model, the MobileNetV2 optimized baseline, and the Teachable Machine benchmark before any promotion to the main capstone route.',
], '', '&', PHP_QUERY_RFC3986);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <section class="content-card p-4 p-lg-5 mb-4">
        <h1 class="section-title mb-3">Session 10 Mask Model Test Page</h1>
        <p class="mb-3">This route is for live testing only. It keeps the synchronized comparison surface off the main Capstone 10 page while the optimized model is still being evaluated.</p>
        <div class="alert alert-warning mb-4" role="alert">
            Test route only. Use this page to compare the original ResNet50 export, the current optimized MobileNetV2 baseline, and the Teachable Machine benchmark before promoting any changes to the main capstone story.
        </div>
        <div class="interactive-lab-shell mb-4">
            <div class="lab-header">
                <span class="artifact-label">Synchronized Test Surface</span>
                <p class="mb-0">One input, three lanes, production-style browser inference.</p>
            </div>
            <iframe id="session10-test-frame" data-session10-demo-frame class="teachable-machine-frame teachable-machine-frame--demo" src="<?php echo htmlspecialchars($comparisonUrl, ENT_QUOTES, 'UTF-8'); ?>" title="Session 10 Mask Model Test Page" loading="lazy" allow="camera; microphone; autoplay" scrolling="no"></iframe>
        </div>

        <div class="row g-3">
            <div class="col-xl-4">
                <div class="artifact-card p-3 h-100">
                    <span class="artifact-label mb-2">Original Capstone</span>
                    <h2 class="h5 mb-2">ResNet50 128x128 Export</h2>
                    <p class="mb-0">Current reference browser model. Latest recorded export accuracy: <?php echo htmlspecialchars((string) round($capstoneAccuracy, 4), ENT_QUOTES, 'UTF-8'); ?>.</p>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="artifact-card p-3 h-100">
                    <span class="artifact-label mb-2">Optimized Baseline</span>
                    <h2 class="h5 mb-2"><?php echo htmlspecialchars($optimizedModelName, ENT_QUOTES, 'UTF-8'); ?> 224x224</h2>
                    <p class="mb-0">Current leading test lane on this comparison surface. Latest recorded export accuracy on the held-out course split: <?php echo htmlspecialchars((string) round($optimizedAccuracy, 4), ENT_QUOTES, 'UTF-8'); ?>.</p>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="artifact-card p-3 h-100">
                    <span class="artifact-label mb-2">Benchmark</span>
                    <h2 class="h5 mb-2">Teachable Machine</h2>
                    <p class="mb-0">Browser benchmark kept visible for direct quality comparison before promotion decisions.</p>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var iframes = Array.prototype.slice.call(document.querySelectorAll('[data-session10-demo-frame]'));
    if (!iframes.length) {
        return;
    }

    function setHeight(iframe, height) {
        if (!height || Number.isNaN(height)) {
            return;
        }
        iframe.style.height = Math.max(480, Math.ceil(height)) + 'px';
    }

    window.addEventListener('message', function (event) {
        if (!event.data || event.data.type !== 'session10-demo-height') {
            return;
        }
        var targetIframe = iframes.find(function (iframe) {
            return iframe.id === event.data.frameId;
        }) || iframes[0];
        setHeight(targetIframe, Number(event.data.height));
    });
});
</script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>