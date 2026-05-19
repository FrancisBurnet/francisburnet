<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/artifact-helpers.php';

$currentPage = 'Projects';
$currentSubPage = 'Automating Port Operations';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

$projectRoot = 'Projects/Deep Learning Specialization/Automating Port Operations';
$notebookUrl = project_artifact_absolute_url($projectRoot . '/notebooks/automating_port_operations_ordered_by_requirement.ipynb', false, true);
$requirementsUrl = project_artifact_absolute_url($projectRoot . '/requirements/automating_port_operations_requirements.md', false, true);
$planUrl = project_artifact_absolute_url($projectRoot . '/DEVELOPMENT_PLAN.md', false, true);
$manifestUrl = project_artifact_absolute_url($projectRoot . '/outputs/manifests/automating_port_operations_evidence_manifest.md', false, true);
$comparisonSummaryUrl = project_artifact_absolute_url($projectRoot . '/outputs/manifests/model_comparison_summary.json', false, true);
$comparisonNotesUrl = project_artifact_absolute_url($projectRoot . '/outputs/manifests/model_comparison_observations.txt', false, true);
$customTrainingUrl = project_artifact_absolute_url($projectRoot . '/outputs/plots/custom_cnn_training_curves.png', false, true);
$customConfusionUrl = project_artifact_absolute_url($projectRoot . '/outputs/plots/custom_cnn_confusion_matrix.png', false, true);
$transferTrainingUrl = project_artifact_absolute_url($projectRoot . '/outputs/plots/transfer_learning_training_curves.png', false, true);

$classLabels = [
    'buoy',
    'cruise ship',
    'ferry boat',
    'freight boat',
    'gondola',
    'inflatable boat',
    'kayak',
    'paper boat',
    'sailboat',
];

$modes = [
    'overview' => [
        'badge' => 'Published Project App',
        'title' => 'Automating Port Operations',
        'copy' => 'A mobile-friendly project app that turns the notebook evidence into a browser-first presentation for vessel classification at port. The published story compares a custom CNN against transfer learning and keeps the notebook, metrics, and plots one tap away.',
        'status' => 'Transfer learning leads the comparison with a much higher held-out accuracy.',
        'primary' => '86.32%',
        'secondary' => '44.30%',
        'delta' => '+42.02 pts',
        'accent' => 'sea',
    ],
    'custom' => [
        'badge' => 'Custom CNN',
        'title' => 'Requirement-first custom CNN workflow',
        'copy' => 'The first model follows the assignment’s custom network path: a deterministic split, resized images, convolution blocks, dense layers, and the 20-epoch training run that produced the baseline confusion matrix and training curves.',
        'status' => 'Baseline model with a simpler architecture and lower accuracy.',
        'primary' => '44.30%',
        'secondary' => 'Loss 0.4899',
        'delta' => 'Reference lane',
        'accent' => 'brass',
    ],
    'transfer' => [
        'badge' => 'Transfer Learning',
        'title' => 'MobileNetV2 transfer-learning lane',
        'copy' => 'The second model uses MobileNetV2 with the project’s transfer-learning split, validation monitoring, and early stopping. It is the best-performing lane in the published comparison and is the main operational recommendation.',
        'status' => 'Best performing lane on the held-out test split.',
        'primary' => '86.32%',
        'secondary' => 'Precision 89.91%',
        'delta' => 'Best lane',
        'accent' => 'seafoam',
    ],
    'comparison' => [
        'badge' => 'Final Comparison',
        'title' => 'The transfer model wins clearly',
        'copy' => 'The notebook closes by comparing both test results and recording the observation that transfer learning is the preferred model for this problem. The browser app mirrors that conclusion so the final takeaway is visible before a visitor opens the notebook.',
        'status' => 'Transfer learning is the recommended model for the published project.',
        'primary' => '+42.02 pts',
        'secondary' => 'Preferred lane',
        'delta' => 'Transfer wins',
        'accent' => 'navy',
    ],
];
?>
<main class="container py-5">
    <style>
        :root {
            --apo-ink: #0b1320;
            --apo-muted: #5a6b7f;
            --apo-card: rgba(255, 255, 255, 0.92);
            --apo-line: rgba(15, 23, 42, 0.10);
            --apo-sea: #0f4c5c;
            --apo-sea-soft: #d8f0f2;
            --apo-seafoam: #1f8a70;
            --apo-seafoam-soft: #dff6ef;
            --apo-brass: #b07a2b;
            --apo-brass-soft: #f4e6c9;
            --apo-navy: #12324e;
            --apo-navy-soft: #dbe7f2;
            --apo-surface: linear-gradient(180deg, rgba(247, 250, 252, 0.94) 0%, rgba(235, 243, 248, 0.98) 100%);
        }

        .apo-shell {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            padding: clamp(1rem, 2.5vw, 1.5rem);
            background: radial-gradient(circle at top left, rgba(31, 138, 112, 0.10), transparent 28%),
                radial-gradient(circle at top right, rgba(176, 122, 43, 0.12), transparent 24%),
                linear-gradient(180deg, #ffffff 0%, #f6fbfd 100%);
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 18px 44px rgba(15, 23, 42, 0.10);
        }

        .apo-shell::before,
        .apo-shell::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            pointer-events: none;
        }

        .apo-shell::before {
            width: 18rem;
            height: 18rem;
            right: -7rem;
            top: -8rem;
            background: rgba(31, 138, 112, 0.08);
        }

        .apo-shell::after {
            width: 14rem;
            height: 14rem;
            left: -6rem;
            bottom: -6rem;
            background: rgba(15, 76, 92, 0.08);
        }

        .apo-hero,
        .apo-panel,
        .apo-deck {
            position: relative;
            z-index: 1;
        }

        .apo-hero {
            display: grid;
            gap: 0.9rem;
            padding-bottom: 1.25rem;
        }

        .apo-eyebrow {
            display: inline-flex;
            width: fit-content;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: var(--apo-sea-soft);
            color: var(--apo-sea);
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .apo-hero h1 {
            margin: 0;
            font-size: clamp(2rem, 4vw, 3.35rem);
            line-height: 1.02;
            letter-spacing: -0.04em;
            color: var(--apo-ink);
            max-width: 11ch;
        }

        .apo-hero p {
            margin: 0;
            max-width: 68ch;
            color: var(--apo-muted);
            font-size: 1.02rem;
            line-height: 1.65;
        }

        .apo-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .apo-actions .btn {
            border-radius: 999px;
            padding-inline: 1rem;
        }

        .apo-controls {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.65rem;
            margin: 1.25rem 0;
        }

        .apo-control {
            border: 1px solid var(--apo-line);
            background: rgba(255, 255, 255, 0.92);
            color: var(--apo-ink);
            border-radius: 1rem;
            padding: 0.8rem 0.9rem;
            text-align: left;
            min-height: 76px;
            cursor: pointer;
            transition: transform 0.18s ease, border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .apo-control:hover,
        .apo-control:focus-visible {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
            outline: none;
        }

        .apo-control.is-active {
            border-color: rgba(15, 76, 92, 0.35);
            box-shadow: 0 14px 24px rgba(15, 76, 92, 0.14);
            background: linear-gradient(180deg, #ffffff 0%, #f1faf9 100%);
        }

        .apo-control span {
            display: block;
        }

        .apo-control__label {
            font-size: 0.72rem;
            font-weight: 800;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.25rem;
        }

        .apo-control__title {
            font-weight: 800;
            font-size: 0.98rem;
            line-height: 1.25;
        }

        .apo-panel {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(300px, 0.85fr);
            gap: 1rem;
            align-items: start;
        }

        .apo-view,
        .apo-results,
        .apo-deck,
        .apo-notes {
            background: var(--apo-card);
            border: 1px solid var(--apo-line);
            border-radius: 1.25rem;
            box-shadow: 0 16px 30px rgba(15, 23, 42, 0.06);
        }

        .apo-view,
        .apo-results {
            padding: 1rem;
        }

        .apo-panel-title {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            align-items: flex-start;
            margin-bottom: 0.9rem;
        }

        .apo-panel-title h2,
        .apo-panel-title h3 {
            margin: 0.1rem 0 0;
            font-size: 1.2rem;
            color: var(--apo-ink);
        }

        .apo-kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.65rem;
            border-radius: 999px;
            background: var(--apo-brass-soft);
            color: var(--apo-brass);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .apo-status {
            margin: 0;
            color: var(--apo-muted);
            font-size: 0.96rem;
            line-height: 1.6;
        }

        .apo-scoreboard {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.75rem;
            margin: 1rem 0;
        }

        .apo-metric {
            border-radius: 1rem;
            padding: 0.9rem;
            background: var(--apo-surface);
            border: 1px solid rgba(15, 23, 42, 0.06);
        }

        .apo-metric span {
            display: block;
        }

        .apo-metric__label {
            color: #64748b;
            font-size: 0.74rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.2rem;
        }

        .apo-metric__value {
            color: var(--apo-ink);
            font-size: 1.35rem;
            font-weight: 900;
            letter-spacing: -0.03em;
        }

        .apo-metric__copy {
            color: var(--apo-muted);
            font-size: 0.87rem;
            margin-top: 0.15rem;
        }

        .apo-viewer {
            min-height: 320px;
            border-radius: 1rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: linear-gradient(180deg, rgba(9, 21, 34, 0.96) 0%, rgba(17, 31, 46, 0.98) 100%);
            color: #fff;
            padding: 1rem;
            display: grid;
            gap: 0.85rem;
            align-content: start;
            overflow: hidden;
        }

        .apo-viewer__topline {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .apo-viewer__chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.65rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .apo-viewer__chip--sea {
            background: rgba(52, 211, 153, 0.14);
            color: #a7f3d0;
        }

        .apo-viewer__chip--brass {
            background: rgba(251, 191, 36, 0.16);
            color: #fde68a;
        }

        .apo-viewer__chip--seafoam {
            background: rgba(45, 212, 191, 0.16);
            color: #99f6e4;
        }

        .apo-viewer__chip--navy {
            background: rgba(96, 165, 250, 0.15);
            color: #bfdbfe;
        }

        .apo-viewer__title {
            margin: 0;
            font-size: clamp(1.5rem, 3vw, 2.15rem);
            line-height: 1.06;
            letter-spacing: -0.04em;
            max-width: 12ch;
        }

        .apo-viewer__copy {
            margin: 0;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.7;
        }

        .apo-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.6rem;
        }

        .apo-vessel {
            border-radius: 0.95rem;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            padding: 0.75rem 0.8rem;
            color: #fff;
        }

        .apo-vessel strong {
            display: block;
            margin-bottom: 0.2rem;
            font-size: 0.92rem;
        }

        .apo-vessel span {
            display: block;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.45;
        }

        .apo-results {
            display: grid;
            gap: 0.75rem;
        }

        .apo-result-card {
            border-radius: 1rem;
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: #ffffff;
            padding: 0.9rem;
        }

        .apo-result-card--highlight {
            background: linear-gradient(180deg, #f1fbf7 0%, #ecfbfa 100%);
            border-color: rgba(31, 138, 112, 0.22);
        }

        .apo-result-card h3 {
            margin: 0 0 0.35rem;
            color: var(--apo-ink);
            font-size: 1.02rem;
        }

        .apo-result-card p,
        .apo-result-card li {
            color: var(--apo-muted);
            line-height: 1.55;
            margin-bottom: 0;
        }

        .apo-result-list {
            margin: 0;
            padding-left: 1.1rem;
        }

        .apo-deck {
            margin-top: 1rem;
            padding: 1rem;
        }

        .apo-deck__head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .apo-deck__head h3 {
            margin: 0.15rem 0 0;
            font-size: 1.08rem;
        }

        .apo-links {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.75rem;
        }

        .apo-link {
            display: grid;
            gap: 0.3rem;
            padding: 0.85rem;
            border-radius: 1rem;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            color: inherit;
            text-decoration: none;
            min-height: 100%;
        }

        .apo-link:hover {
            border-color: rgba(15, 76, 92, 0.22);
            box-shadow: 0 10px 18px rgba(15, 23, 42, 0.06);
        }

        .apo-link__label {
            font-size: 0.74rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .apo-link__title {
            font-size: 0.96rem;
            font-weight: 800;
            color: var(--apo-ink);
        }

        .apo-link__copy {
            font-size: 0.86rem;
            color: var(--apo-muted);
            line-height: 1.5;
        }

        .apo-notes {
            margin-top: 1rem;
            padding: 1rem;
        }

        .apo-notes h3 {
            margin-top: 0;
        }

        .apo-notes__list {
            display: grid;
            gap: 0.65rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .apo-notes__list li {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.75rem;
            align-items: start;
            padding: 0.8rem;
            border-radius: 1rem;
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }

        .apo-notes__index {
            display: inline-flex;
            width: 2rem;
            height: 2rem;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: var(--apo-sea-soft);
            color: var(--apo-sea);
            font-weight: 900;
            font-size: 0.85rem;
        }

        .apo-notes__text strong {
            color: var(--apo-ink);
        }

        @media (max-width: 1080px) {
            .apo-panel {
                grid-template-columns: 1fr;
            }

            .apo-controls,
            .apo-scoreboard,
            .apo-links,
            .apo-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 720px) {
            .apo-controls,
            .apo-scoreboard,
            .apo-links,
            .apo-grid {
                grid-template-columns: 1fr;
            }

            .apo-control {
                min-height: 0;
            }

            .apo-panel-title,
            .apo-deck__head {
                flex-direction: column;
            }
        }
    </style>

    <section class="apo-shell">
        <header class="apo-hero">
            <span class="apo-eyebrow">Mobile-friendly project web app</span>
            <h1>Automating Port Operations</h1>
            <p>Published project browser for the vessel-type classifier. It keeps the same app-style, responsive presentation used by the face-mask demo, but swaps in the port operations notebook, the real class labels, and the final model comparison so the project reads cleanly on desktop and mobile.</p>
            <div class="apo-actions">
                <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $notebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Notebook</a>
                <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $comparisonSummaryUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Comparison JSON</a>
                <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $transferTrainingUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">View Training Curves</a>
            </div>
        </header>

        <nav class="apo-controls" aria-label="Project modes">
            <button class="apo-control is-active" type="button" data-apo-mode="overview">
                <span class="apo-control__label">Mode 01</span>
                <span class="apo-control__title">Overview</span>
            </button>
            <button class="apo-control" type="button" data-apo-mode="custom">
                <span class="apo-control__label">Mode 02</span>
                <span class="apo-control__title">Custom CNN</span>
            </button>
            <button class="apo-control" type="button" data-apo-mode="transfer">
                <span class="apo-control__label">Mode 03</span>
                <span class="apo-control__title">Transfer Learning</span>
            </button>
            <button class="apo-control" type="button" data-apo-mode="comparison">
                <span class="apo-control__label">Mode 04</span>
                <span class="apo-control__title">Final Comparison</span>
            </button>
        </nav>

        <section class="apo-panel">
            <article class="apo-view">
                <div class="apo-panel-title">
                    <div>
                        <span id="apoBadge" class="apo-kicker"><?php echo htmlspecialchars($modes['overview']['badge'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <h2 id="apoTitle"><?php echo htmlspecialchars($modes['overview']['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    </div>
                    <span id="apoAccent" class="apo-viewer__chip apo-viewer__chip--sea">Sea lane</span>
                </div>

                <div class="apo-viewer">
                    <div class="apo-viewer__topline">
                        <span class="apo-viewer__chip apo-viewer__chip--sea" id="apoStateChip">Transfer learning leads</span>
                        <span class="apo-viewer__chip apo-viewer__chip--brass" id="apoStatChip">86.32% accuracy</span>
                    </div>
                    <h3 class="apo-viewer__title" id="apoPanelTitle"><?php echo htmlspecialchars($modes['overview']['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="apo-viewer__copy" id="apoCopy"><?php echo htmlspecialchars($modes['overview']['copy'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <div class="apo-scoreboard" aria-label="Key comparison metrics">
                        <div class="apo-metric">
                            <span class="apo-metric__label">Best accuracy</span>
                            <span class="apo-metric__value" id="apoPrimary"><?php echo htmlspecialchars($modes['overview']['primary'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="apo-metric__copy" id="apoPrimaryCopy">Transfer-learning lane</span>
                        </div>
                        <div class="apo-metric">
                            <span class="apo-metric__label">Baseline accuracy</span>
                            <span class="apo-metric__value" id="apoSecondary"><?php echo htmlspecialchars($modes['overview']['secondary'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="apo-metric__copy" id="apoSecondaryCopy">Custom CNN lane</span>
                        </div>
                        <div class="apo-metric">
                            <span class="apo-metric__label">Gap</span>
                            <span class="apo-metric__value" id="apoDelta"><?php echo htmlspecialchars($modes['overview']['delta'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="apo-metric__copy" id="apoDeltaCopy">Preferred operational model</span>
                        </div>
                    </div>

                    <div class="apo-grid" aria-label="Project vessel classes">
                        <?php foreach ($classLabels as $index => $classLabel): ?>
                            <div class="apo-vessel">
                                <strong><?php echo htmlspecialchars($classLabel, ENT_QUOTES, 'UTF-8'); ?></strong>
                                <span>Class <?php echo $index + 1; ?> in the vessel taxonomy used by the notebook.</span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <p class="apo-status mb-0" id="apoStatus"><?php echo htmlspecialchars($modes['overview']['status'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </article>

            <aside class="apo-results">
                <div class="apo-result-card apo-result-card--highlight">
                    <span class="artifact-label d-inline-block mb-2">Notebook Story</span>
                    <h3 id="apoResultHeading">Why the transfer lane is the recommendation</h3>
                    <p id="apoResultCopy">The transfer-learning model is the published winner because it keeps the port-operations classes aligned with the held-out test split and produces the strongest final accuracy. The app surfaces that conclusion up front so the model choice stays obvious on mobile screens.</p>
                </div>

                <div class="apo-result-card">
                    <h3>Artifacts at a glance</h3>
                    <ul class="apo-result-list">
                        <li>Executed notebook, requirement list, and development plan are linked from the project deck below.</li>
                        <li>Custom CNN training curves and confusion matrix are published as reviewable evidence.</li>
                        <li>Transfer-learning curves and the comparison summary capture the final model decision.</li>
                    </ul>
                </div>

                <div class="apo-result-card">
                    <h3>Mobile-first behavior</h3>
                    <p>The control row collapses to one column on small screens, the cards stack vertically, and the vessel labels remain readable without pinch-zooming.</p>
                </div>
            </aside>
        </section>

        <section class="apo-deck mt-4">
            <div class="apo-deck__head">
                <div>
                    <span class="apo-kicker">Project Deck</span>
                    <h3 class="mb-1">Open the working artifacts behind the web app</h3>
                    <p class="text-secondary mb-0">These links surface the notebook evidence, manifests, and plots that back the published comparison.</p>
                </div>
            </div>

            <div class="apo-links">
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $requirementsUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Requirements</span>
                    <span class="apo-link__title">Verbatim task map</span>
                    <span class="apo-link__copy">The source-aligned task list that drives the notebook sections.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $planUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Development Plan</span>
                    <span class="apo-link__title">Internal build notes</span>
                    <span class="apo-link__copy">The private plan that keeps the project architecture aligned.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $manifestUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Evidence Manifest</span>
                    <span class="apo-link__title">Run outputs and artifacts</span>
                    <span class="apo-link__copy">The manifest that lists the saved files for the published project.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $customTrainingUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Custom CNN Plot</span>
                    <span class="apo-link__title">Training curves</span>
                    <span class="apo-link__copy">Loss and accuracy curves from the baseline model run.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $customConfusionUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Custom CNN Plot</span>
                    <span class="apo-link__title">Confusion matrix</span>
                    <span class="apo-link__copy">The baseline model’s class-by-class review heatmap.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $comparisonNotesUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Comparison Notes</span>
                    <span class="apo-link__title">Final observation text</span>
                    <span class="apo-link__copy">The note that records why the transfer lane is preferred.</span>
                </a>
            </div>
        </section>

        <section class="apo-notes mt-4">
            <h3 class="h5">How the app is organized</h3>
            <ul class="apo-notes__list">
                <li>
                    <span class="apo-notes__index">1</span>
                    <span class="apo-notes__text"><strong>Overview mode</strong> gives the short published story and the model delta at a glance.</span>
                </li>
                <li>
                    <span class="apo-notes__index">2</span>
                    <span class="apo-notes__text"><strong>Custom CNN mode</strong> frames the baseline architecture and its lower test accuracy.</span>
                </li>
                <li>
                    <span class="apo-notes__index">3</span>
                    <span class="apo-notes__text"><strong>Transfer learning mode</strong> surfaces the stronger MobileNetV2 result and its supporting metrics.</span>
                </li>
                <li>
                    <span class="apo-notes__index">4</span>
                    <span class="apo-notes__text"><strong>Final comparison mode</strong> makes the publication decision explicit before the visitor opens the notebook.</span>
                </li>
            </ul>
        </section>
    </section>

    <script>
        (function () {
            const modes = <?php echo json_encode($modes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>;
            const controlButtons = Array.from(document.querySelectorAll('[data-apo-mode]'));
            const nodes = {
                badge: document.getElementById('apoBadge'),
                title: document.getElementById('apoTitle'),
                accent: document.getElementById('apoAccent'),
                stateChip: document.getElementById('apoStateChip'),
                statChip: document.getElementById('apoStatChip'),
                panelTitle: document.getElementById('apoPanelTitle'),
                copy: document.getElementById('apoCopy'),
                primary: document.getElementById('apoPrimary'),
                secondary: document.getElementById('apoSecondary'),
                delta: document.getElementById('apoDelta'),
                primaryCopy: document.getElementById('apoPrimaryCopy'),
                secondaryCopy: document.getElementById('apoSecondaryCopy'),
                deltaCopy: document.getElementById('apoDeltaCopy'),
                status: document.getElementById('apoStatus'),
                resultHeading: document.getElementById('apoResultHeading'),
                resultCopy: document.getElementById('apoResultCopy'),
            };

            const accentClassMap = {
                sea: 'apo-viewer__chip--sea',
                brass: 'apo-viewer__chip--brass',
                seafoam: 'apo-viewer__chip--seafoam',
                navy: 'apo-viewer__chip--navy',
            };

            const chipPalette = {
                sea: 'Sea lane',
                brass: 'Brass lane',
                seafoam: 'Seafoam lane',
                navy: 'Navy lane',
            };

            const modeDetails = {
                overview: {
                    resultHeading: 'Project summary',
                    resultCopy: 'The app opens with the published conclusion so the visitor immediately sees the best model and the notebook path behind it.',
                    primaryCopy: 'Transfer-learning lane',
                    secondaryCopy: 'Custom CNN lane',
                    deltaCopy: 'Final recommendation',
                },
                custom: {
                    resultHeading: 'Custom CNN baseline',
                    resultCopy: 'The baseline run is still useful because it preserves the exact requirement order and shows the original model’s learning curve and confusion matrix.',
                    primaryCopy: 'Training accuracy',
                    secondaryCopy: 'Held-out loss',
                    deltaCopy: 'Reference lane',
                },
                transfer: {
                    resultHeading: 'Transfer-learning winner',
                    resultCopy: 'The transfer model improves the decision boundary by reusing ImageNet features, which is why it becomes the recommended operational lane.',
                    primaryCopy: 'Test accuracy',
                    secondaryCopy: 'Precision / recall',
                    deltaCopy: 'Preferred lane',
                },
                comparison: {
                    resultHeading: 'Final comparison',
                    resultCopy: 'The notebook closes with a direct comparison and the published observation that transfer learning is the better-performing choice for this project.',
                    primaryCopy: 'Accuracy gap',
                    secondaryCopy: 'Chosen model',
                    deltaCopy: 'Decision note',
                },
            };

            function setMode(modeKey) {
                const mode = modes[modeKey] || modes.overview;
                const extra = modeDetails[modeKey] || modeDetails.overview;

                controlButtons.forEach((button) => {
                    const active = button.dataset.apoMode === modeKey;
                    button.classList.toggle('is-active', active);
                    button.setAttribute('aria-pressed', active ? 'true' : 'false');
                });

                nodes.badge.textContent = mode.badge;
                nodes.title.textContent = mode.title;
                nodes.panelTitle.textContent = mode.title;
                nodes.copy.textContent = mode.copy;
                nodes.status.textContent = mode.status;
                nodes.primary.textContent = mode.primary;
                nodes.secondary.textContent = mode.secondary;
                nodes.delta.textContent = mode.delta;
                nodes.primaryCopy.textContent = extra.primaryCopy;
                nodes.secondaryCopy.textContent = extra.secondaryCopy;
                nodes.deltaCopy.textContent = extra.deltaCopy;
                nodes.resultHeading.textContent = extra.resultHeading;
                nodes.resultCopy.textContent = extra.resultCopy;

                Object.keys(accentClassMap).forEach((key) => {
                    nodes.accent.classList.remove(accentClassMap[key]);
                });
                const accentClass = accentClassMap[mode.accent] || accentClassMap.sea;
                nodes.accent.classList.add(accentClass);
                nodes.accent.textContent = chipPalette[mode.accent] || chipPalette.sea;

                nodes.stateChip.textContent = mode.badge;
                nodes.statChip.textContent = mode.primary + ' accuracy';
            }

            controlButtons.forEach((button) => {
                button.addEventListener('click', () => setMode(button.dataset.apoMode));
            });

            setMode('overview');
        })();
    </script>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>