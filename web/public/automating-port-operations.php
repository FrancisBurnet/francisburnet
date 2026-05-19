<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/artifact-helpers.php';

$currentPage = 'Projects';
$currentSubPage = 'Automating Port Operations';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

$projectRoot = 'Projects/Deep Learning Specialization/Automating Port Operations';
$colabNotebookUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/' . str_replace(' ', '%20', $projectRoot . '/notebooks/automating_port_operations_ordered_by_requirement.ipynb');
$notebookUrl = project_artifact_absolute_url($projectRoot . '/notebooks/automating_port_operations_ordered_by_requirement.ipynb', false, true);
$notebookSourceUrl = project_artifact_absolute_url($projectRoot . '/notebooks/automating_port_operations_ordered_by_requirement.ipynb', true, false);
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
        'status' => 'Transfer learning leads the comparison with 86.32% held-out accuracy versus 44.30% for the custom CNN.',
        'primary' => '86.32%',
        'secondary' => '44.30%',
        'delta' => '+42.02 pts',
        'statChip' => 'Winner: transfer learning',
        'accent' => 'sea',
    ],
    'custom' => [
        'badge' => 'Custom CNN',
        'title' => 'Requirement-first custom CNN workflow',
        'copy' => 'The first model follows the assignment’s custom network path: a deterministic split, resized images, convolution blocks, dense layers, and the 20-epoch training run that produced the baseline confusion matrix and training curves.',
        'status' => 'Baseline model with 44.30% held-out accuracy and a simpler architecture.',
        'primary' => '44.30%',
        'secondary' => 'Loss 0.4899',
        'delta' => 'Baseline lane',
        'statChip' => 'Loss 1.5826',
        'accent' => 'brass',
    ],
    'transfer' => [
        'badge' => 'Transfer Learning',
        'title' => 'MobileNetV2 transfer-learning lane',
        'copy' => 'The second model uses MobileNetV2 with the project’s transfer-learning split, validation monitoring, and early stopping. It is the best-performing lane in the published comparison and is the main operational recommendation.',
        'status' => 'Best performing lane on the held-out test split.',
        'primary' => '86.32%',
        'secondary' => '89.91%',
        'delta' => 'Accuracy gap',
        'statChip' => 'Precision 89.91%',
        'accent' => 'seafoam',
    ],
    'comparison' => [
        'badge' => 'Final Comparison',
        'title' => 'The transfer model wins clearly',
        'copy' => 'The notebook closes by comparing both test results and recording the observation that transfer learning is the preferred model for this problem. The browser app mirrors that conclusion so the final takeaway is visible before a visitor opens the notebook.',
        'status' => 'Transfer learning is the recommended model for the published project.',
        'primary' => '+42.02 pts',
        'secondary' => 'Transfer learning',
        'delta' => 'Recommended model',
        'statChip' => 'Winner: transfer learning',
        'accent' => 'navy',
    ],
];

$heroImagePath = 'assets/images/automating-port-operations-hero.svg';
$heroImageAlt = 'Automating Port Operations vessel infographic';
$heroTitle = 'Automating Port Operations Evidence Map';
$heroSummaryHtml = '<p class="mb-0">Standard capstone infographic size, with vessel sample imagery, image/video/webcam preview modes, and the notebook links that still power the runnable comparison in Colab.</p>';
?>
<main class="container py-5">
    <?php require __DIR__ . '/../includes/page-hero.php'; ?>

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

        .apo-hero__layout {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(260px, 0.8fr);
            gap: 1rem;
            align-items: stretch;
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

        .apo-infographic {
            border-radius: 1.35rem;
            background: linear-gradient(180deg, rgba(15, 76, 92, 0.98) 0%, rgba(9, 21, 34, 0.98) 100%);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.10);
            padding: 1rem;
            display: grid;
            gap: 0.75rem;
            overflow: hidden;
            position: relative;
        }

        .apo-infographic::before {
            content: '';
            position: absolute;
            inset: auto -20% -35% auto;
            width: 12rem;
            height: 12rem;
            border-radius: 999px;
            background: rgba(31, 138, 112, 0.18);
        }

        .apo-infographic__header {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .apo-infographic__title {
            margin: 0;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
        }

        .apo-infographic__caption {
            margin: 0.25rem 0 0;
            color: rgba(255, 255, 255, 0.84);
            line-height: 1.55;
        }

        .apo-infographic__grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.5rem;
            margin-top: 0.25rem;
        }

        .apo-infographic__tile {
            padding: 0.7rem;
            border-radius: 0.95rem;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            min-height: 5.2rem;
        }

        .apo-infographic__tile strong {
            display: block;
            margin-bottom: 0.2rem;
        }

        .apo-infographic__tile span {
            display: block;
            color: rgba(255, 255, 255, 0.72);
            font-size: 0.82rem;
            line-height: 1.45;

        .apo-media-lab {
            border-radius: 1.35rem;
            background: linear-gradient(180deg, rgba(15, 76, 92, 0.98) 0%, rgba(9, 21, 34, 0.98) 100%);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.10);
            padding: 1rem;
            display: grid;
            gap: 0.85rem;
            overflow: hidden;
            position: relative;
        }

        .apo-media-lab::before {
            content: '';
            position: absolute;
            inset: auto -20% -35% auto;
            width: 12rem;
            height: 12rem;
            border-radius: 999px;
            background: rgba(31, 138, 112, 0.18);
        }

        .apo-media-lab__header {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            align-items: flex-start;
            position: relative;
            z-index: 1;
        }

        .apo-media-stage {
            position: relative;
            z-index: 1;
            border-radius: 1rem;
            overflow: hidden;
            min-height: 20rem;
            background: #07131e;
            border: 1px solid rgba(255, 255, 255, 0.12);
            display: grid;
            place-items: center;
        }

        .apo-media-stage__label {
            position: absolute;
            top: 0.9rem;
            left: 0.9rem;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .apo-media-stage img,
        .apo-media-stage video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .apo-media-stage__empty {
            padding: 1.25rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.55;
        }

        .apo-media-controls {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            position: relative;
            z-index: 1;
        }

        .apo-media-controls .btn {
            border-radius: 999px;
        }

        .apo-sample-gallery {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
            position: relative;
            z-index: 1;
        }

        .apo-sample-card {
            display: block;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            color: inherit;
            text-decoration: none;
            border-radius: 1rem;
            overflow: hidden;
            text-align: left;
            padding: 0;
        }

        .apo-sample-card img {
            display: block;
            width: 100%;
            aspect-ratio: 4 / 3;
            object-fit: cover;
        }

        .apo-sample-card__copy {
            display: grid;
            gap: 0.15rem;
            padding: 0.7rem 0.75rem;
        }

        .apo-sample-card__label {
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.72);
        }

        .apo-sample-card__title {
            font-size: 0.92rem;
            font-weight: 800;
            color: #fff;
        }

        .apo-sample-card__copy span:last-child {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.80);
            line-height: 1.45;
        }
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
            .apo-hero__layout,
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
            <div class="apo-hero__layout">
                <div>
                    <h1>Automating Port Operations</h1>
                    <p>Published project browser for the vessel-type classifier. It keeps the same app-style, responsive presentation used by the face-mask demo, but swaps in the port operations notebook, the real class labels, and the final model comparison so the project reads cleanly on desktop and mobile.</p>
                    <div class="apo-actions">
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $colabNotebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Launch Colab</a>
                        <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $notebookSourceUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">View Notebook Source</a>
                        <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $comparisonSummaryUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open Comparison JSON</a>
                    </div>
                </div>
                <aside class="apo-media-lab" aria-label="Vessel media test surface">
                    <div class="apo-media-lab__header">
                        <div>
                            <span class="apo-infographic__title">Vessel media test surface</span>
                            <p class="apo-infographic__caption">Switch between image, video, webcam, and sample vessel cards. The runnable notebook still opens in Colab, but this panel gives the page the same media-lab feel as the capstone demo format.</p>
                        </div>
                        <span class="apo-viewer__chip apo-viewer__chip--seafoam">Preview lane</span>
                    </div>

                    <div class="apo-media-stage">
                        <span class="apo-media-stage__label" id="apoMediaLabel">Image sample</span>
                        <img id="apoMediaImage" src="/assets/images/apo-vessel-buoy.svg" alt="Buoy sample vessel">
                        <video id="apoMediaVideo" hidden controls playsinline></video>
                        <div id="apoMediaWebcam" class="apo-media-stage__empty" hidden>
                            Webcam preview will appear here after you start the camera.
                        </div>
                    </div>

                    <div class="apo-media-controls">
                        <button class="btn btn-light btn-sm" type="button" data-apo-media-mode="image">Image</button>
                        <button class="btn btn-light btn-sm" type="button" data-apo-media-mode="video">Video</button>
                        <button class="btn btn-light btn-sm" type="button" data-apo-media-mode="webcam">Webcam</button>
                        <label class="btn btn-outline-light btn-sm mb-0" for="apoMediaInput">Upload media</label>
                        <input id="apoMediaInput" type="file" accept="image/*,video/*" hidden>
                    </div>

                    <div class="apo-sample-gallery" aria-label="Sample vessel images">
                        <button class="apo-sample-card" type="button" data-apo-sample-src="/assets/images/apo-vessel-buoy.svg" data-apo-sample-title="Buoy">
                            <img src="/assets/images/apo-vessel-buoy.svg" alt="Buoy sample vessel">
                            <span class="apo-sample-card__copy">
                                <span class="apo-sample-card__label">Sample vessel</span>
                                <span class="apo-sample-card__title">Buoy</span>
                                <span>Click to preview this vessel image in the test pane.</span>
                            </span>
                        </button>
                        <button class="apo-sample-card" type="button" data-apo-sample-src="/assets/images/apo-vessel-cruise.svg" data-apo-sample-title="Cruise ship">
                            <img src="/assets/images/apo-vessel-cruise.svg" alt="Cruise ship sample vessel">
                            <span class="apo-sample-card__copy">
                                <span class="apo-sample-card__label">Sample vessel</span>
                                <span class="apo-sample-card__title">Cruise ship</span>
                                <span>Use this card to swap the preview to a different vessel class.</span>
                            </span>
                        </button>
                        <button class="apo-sample-card" type="button" data-apo-sample-src="/assets/images/apo-vessel-ferry.svg" data-apo-sample-title="Ferry boat">
                            <img src="/assets/images/apo-vessel-ferry.svg" alt="Ferry boat sample vessel">
                            <span class="apo-sample-card__copy">
                                <span class="apo-sample-card__label">Sample vessel</span>
                                <span class="apo-sample-card__title">Ferry boat</span>
                                <span>Sample image for testing the browser preview lane.</span>
                            </span>
                        </button>
                        <button class="apo-sample-card" type="button" data-apo-sample-src="/assets/images/apo-vessel-sailboat.svg" data-apo-sample-title="Sailboat">
                            <img src="/assets/images/apo-vessel-sailboat.svg" alt="Sailboat sample vessel">
                            <span class="apo-sample-card__copy">
                                <span class="apo-sample-card__label">Sample vessel</span>
                                <span class="apo-sample-card__title">Sailboat</span>
                                <span>One more vessel example to match the general capstone media layout.</span>
                            </span>
                        </button>
                    </div>
                </aside>
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
                        <span class="apo-viewer__chip apo-viewer__chip--brass" id="apoStatChip">Winner: transfer learning</span>
                    </div>
                    <h3 class="apo-viewer__title" id="apoPanelTitle"><?php echo htmlspecialchars($modes['overview']['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="apo-viewer__copy" id="apoCopy"><?php echo htmlspecialchars($modes['overview']['copy'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <div class="apo-scoreboard" aria-label="Key comparison metrics">
                        <div class="apo-metric">
                            <span class="apo-metric__label" id="apoPrimaryLabel">Best accuracy</span>
                            <span class="apo-metric__value" id="apoPrimary"><?php echo htmlspecialchars($modes['overview']['primary'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="apo-metric__copy" id="apoPrimaryCopy">Transfer-learning lane</span>
                        </div>
                        <div class="apo-metric">
                            <span class="apo-metric__label" id="apoSecondaryLabel">Baseline accuracy</span>
                            <span class="apo-metric__value" id="apoSecondary"><?php echo htmlspecialchars($modes['overview']['secondary'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="apo-metric__copy" id="apoSecondaryCopy">Custom CNN lane</span>
                        </div>
                        <div class="apo-metric">
                            <span class="apo-metric__label" id="apoDeltaLabel">Accuracy gap</span>
                            <span class="apo-metric__value" id="apoDelta"><?php echo htmlspecialchars($modes['overview']['delta'], ENT_QUOTES, 'UTF-8'); ?></span>
                            <span class="apo-metric__copy" id="apoDeltaCopy">Difference in held-out accuracy</span>
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

        <section class="apo-deck mt-4">
            <div class="apo-deck__head">
                <div>
                    <span class="apo-kicker">Verification Console</span>
                    <h3 class="mb-1">Test the published versions from the site</h3>
                    <p class="text-secondary mb-0">The notebook and outputs are the actual test surface here. Colab opens in a new tab, and the site keeps the launch controls, artifact links, and comparison summary in one place.</p>
                </div>
            </div>

            <div class="apo-links">
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $colabNotebookUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Run Version</span>
                    <span class="apo-link__title">Launch in Colab</span>
                    <span class="apo-link__copy">Open the executable notebook in Google Colab to run all cells.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $notebookSourceUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Notebook Source</span>
                    <span class="apo-link__title">Open inside the site</span>
                    <span class="apo-link__copy">View the notebook from the artifact viewer when you want the run log in-browser.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $comparisonSummaryUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Comparison</span>
                    <span class="apo-link__title">Model results JSON</span>
                    <span class="apo-link__copy">Open the saved metrics that show 86.32% versus 44.30% accuracy.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $customTrainingUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Custom CNN</span>
                    <span class="apo-link__title">Training curve test</span>
                    <span class="apo-link__copy">Use the baseline plot to inspect the simpler model run.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $transferTrainingUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Transfer Learning</span>
                    <span class="apo-link__title">Training curve test</span>
                    <span class="apo-link__copy">Use the MobileNetV2 plot to inspect the stronger lane.</span>
                </a>
                <a class="apo-link" href="<?php echo htmlspecialchars((string) $comparisonNotesUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Comparison note</span>
                    <span class="apo-link__title">Why transfer wins</span>
                    <span class="apo-link__copy">Read the final summary statement recorded by the notebook.</span>
                </a>
            </div>
        </section>

        <section class="apo-deck mt-4">
            <div class="apo-deck__head">
                <div>
                    <span class="apo-kicker">Related Capstones</span>
                    <h3 class="mb-1">Comparison to other published deep learning pages</h3>
                    <p class="text-secondary mb-0">These links show the different presentation styles already in the portfolio so you can compare this project against the face-mask app and the other deep-learning capstone pages.</p>
                </div>
            </div>

            <div class="apo-links">
                <a class="apo-link" href="capstone-session-9.php" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Capstone 9</span>
                    <span class="apo-link__title">Notebook + Colab flow</span>
                    <span class="apo-link__copy">Useful as a notebook-first reference for a launch-and-run verification pattern.</span>
                </a>
                <a class="apo-link" href="capstone-session-10.php" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Capstone 10</span>
                    <span class="apo-link__title">Face-mask app style</span>
                    <span class="apo-link__copy">The closest browser-demo pattern, with a live comparison surface and darker interactive console.</span>
                </a>
                <a class="apo-link" href="session-10-mask-test.php" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Capstone 10 Test</span>
                    <span class="apo-link__title">Live test route</span>
                    <span class="apo-link__copy">Shows how the existing app separates a test lane from the main comparison surface.</span>
                </a>
                <a class="apo-link" href="capstone-session-11.php" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Capstone 11</span>
                    <span class="apo-link__title">NLP project page</span>
                    <span class="apo-link__copy">Another published deep-learning page with artifact-driven storytelling instead of an inference widget.</span>
                </a>
                <a class="apo-link" href="capstone-session-12.php" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Capstone 12</span>
                    <span class="apo-link__title">Autoencoder evidence</span>
                    <span class="apo-link__copy">A comparison point for the notebook-and-output evidence style used here.</span>
                </a>
                <a class="apo-link" href="projects.php#projects-deep-learning" target="_blank" rel="noreferrer">
                    <span class="apo-link__label">Projects hub</span>
                    <span class="apo-link__title">Published project listing</span>
                    <span class="apo-link__copy">Shows where this page sits in the published Projects navigation.</span>
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
                primaryLabel: document.getElementById('apoPrimaryLabel'),
                secondaryLabel: document.getElementById('apoSecondaryLabel'),
                deltaLabel: document.getElementById('apoDeltaLabel'),
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
                    deltaCopy: 'Difference in held-out accuracy',
                    labels: ['Best accuracy', 'Baseline accuracy', 'Accuracy gap'],
                },
                custom: {
                    resultHeading: 'Custom CNN baseline',
                    resultCopy: 'The baseline run is still useful because it preserves the exact requirement order and shows the original model’s learning curve and confusion matrix.',
                    primaryCopy: 'Held-out accuracy',
                    secondaryCopy: 'Held-out loss',
                    deltaCopy: 'Baseline lane',
                    labels: ['Held-out accuracy', 'Held-out loss', 'Baseline lane'],
                },
                transfer: {
                    resultHeading: 'Transfer-learning winner',
                    resultCopy: 'The transfer model improves the decision boundary by reusing ImageNet features, which is why it becomes the recommended operational lane.',
                    primaryCopy: 'Test accuracy',
                    secondaryCopy: 'Precision',
                    deltaCopy: 'Accuracy gap',
                    labels: ['Test accuracy', 'Precision', 'Accuracy gap'],
                },
                comparison: {
                    resultHeading: 'Final comparison',
                    resultCopy: 'The notebook closes with a direct comparison and the published observation that transfer learning is the better-performing choice for this project.',
                    primaryCopy: 'Accuracy gap',
                    secondaryCopy: 'Recommended model',
                    deltaCopy: 'Decision note',
                    labels: ['Accuracy gap', 'Recommended model', 'Decision note'],
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
                nodes.primaryLabel.textContent = extra.labels[0];
                nodes.secondaryLabel.textContent = extra.labels[1];
                nodes.deltaLabel.textContent = extra.labels[2];
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
                nodes.statChip.textContent = mode.statChip || (mode.primary + ' accuracy');
            }

            controlButtons.forEach((button) => {
                button.addEventListener('click', () => setMode(button.dataset.apoMode));
            });

            const mediaNodes = {
                label: document.getElementById('apoMediaLabel'),
                image: document.getElementById('apoMediaImage'),
                video: document.getElementById('apoMediaVideo'),
                webcam: document.getElementById('apoMediaWebcam'),
                input: document.getElementById('apoMediaInput'),
                modeButtons: Array.from(document.querySelectorAll('[data-apo-media-mode]')),
                sampleButtons: Array.from(document.querySelectorAll('[data-apo-sample-src]')),
            };

            const mediaState = {
                activeObjectUrl: '',
                webcamStream: null,
            };

            function clearActiveObjectUrl() {
                if (mediaState.activeObjectUrl) {
                    window.URL.revokeObjectURL(mediaState.activeObjectUrl);
                    mediaState.activeObjectUrl = '';
                }
            }

            function stopWebcam() {
                if (mediaState.webcamStream) {
                    mediaState.webcamStream.getTracks().forEach((track) => track.stop());
                    mediaState.webcamStream = null;
                }
            }

            function setMediaVisibility(activeMode) {
                mediaNodes.image.hidden = activeMode !== 'image';
                mediaNodes.video.hidden = activeMode !== 'video' && activeMode !== 'webcam';
                mediaNodes.webcam.hidden = activeMode !== 'webcam';
            }

            function showImagePreview(src, title) {
                stopWebcam();
                clearActiveObjectUrl();
                mediaNodes.image.src = src;
                mediaNodes.image.alt = title + ' sample vessel';
                mediaNodes.label.textContent = 'Image sample';
                mediaNodes.video.removeAttribute('src');
                mediaNodes.video.removeAttribute('poster');
                mediaNodes.video.pause();
                mediaNodes.video.srcObject = null;
                mediaNodes.webcam.hidden = true;
                setMediaVisibility('image');
            }

            function showVideoPlaceholder(title) {
                stopWebcam();
                mediaNodes.label.textContent = 'Video option';
                mediaNodes.video.hidden = false;
                mediaNodes.video.pause();
                mediaNodes.video.srcObject = null;
                mediaNodes.video.removeAttribute('src');
                mediaNodes.video.poster = mediaNodes.image.src;
                mediaNodes.webcam.hidden = true;
                mediaNodes.image.hidden = true;
                mediaNodes.webcam.textContent = title ? ('Upload a ' + title.toLowerCase() + ' clip or choose another sample.') : 'Upload a vessel clip to preview the video lane.';
                mediaNodes.webcam.hidden = false;
                mediaNodes.video.hidden = true;
            }

            async function startWebcamPreview() {
                clearActiveObjectUrl();
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    mediaNodes.label.textContent = 'Webcam unavailable';
                    mediaNodes.webcam.textContent = 'This browser does not expose webcam access.';
                    mediaNodes.webcam.hidden = false;
                    mediaNodes.image.hidden = true;
                    mediaNodes.video.hidden = true;
                    return;
                }

                stopWebcam();
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                    mediaState.webcamStream = stream;
                    mediaNodes.label.textContent = 'Webcam preview';
                    mediaNodes.video.hidden = false;
                    mediaNodes.video.srcObject = stream;
                    mediaNodes.video.play();
                    mediaNodes.image.hidden = true;
                    mediaNodes.webcam.hidden = true;
                } catch (error) {
                    mediaNodes.label.textContent = 'Webcam blocked';
                    mediaNodes.webcam.textContent = 'Camera access was not granted.';
                    mediaNodes.webcam.hidden = false;
                    mediaNodes.image.hidden = true;
                    mediaNodes.video.hidden = true;
                }
            }

            mediaNodes.modeButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const mode = button.dataset.apoMediaMode;
                    if (mode === 'image') {
                        showImagePreview(mediaNodes.image.src, mediaNodes.image.alt.replace(' sample vessel', ''));
                        return;
                    }
                    if (mode === 'video') {
                        showVideoPlaceholder('vessel');
                        return;
                    }
                    if (mode === 'webcam') {
                        startWebcamPreview();
                    }
                });
            });

            mediaNodes.sampleButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    showImagePreview(button.dataset.apoSampleSrc, button.dataset.apoSampleTitle || 'Sample vessel');
                });
            });

            mediaNodes.input.addEventListener('change', () => {
                const file = mediaNodes.input.files && mediaNodes.input.files[0] ? mediaNodes.input.files[0] : null;
                if (!file) {
                    return;
                }

                if (file.type.startsWith('video/')) {
                    stopWebcam();
                    clearActiveObjectUrl();
                    mediaState.activeObjectUrl = window.URL.createObjectURL(file);
                    mediaNodes.label.textContent = 'Video upload';
                    mediaNodes.video.hidden = false;
                    mediaNodes.video.srcObject = null;
                    mediaNodes.video.src = mediaState.activeObjectUrl;
                    mediaNodes.video.poster = mediaNodes.image.src;
                    mediaNodes.video.play();
                    mediaNodes.image.hidden = true;
                    mediaNodes.webcam.hidden = true;
                    return;
                }

                clearActiveObjectUrl();
                stopWebcam();
                mediaState.activeObjectUrl = window.URL.createObjectURL(file);
                mediaNodes.image.src = mediaState.activeObjectUrl;
                mediaNodes.image.alt = file.name;
                mediaNodes.label.textContent = 'Image upload';
                mediaNodes.video.pause();
                mediaNodes.video.hidden = true;
                mediaNodes.webcam.hidden = true;
                mediaNodes.image.hidden = false;
                mediaNodes.video.srcObject = null;
                mediaNodes.video.removeAttribute('src');
            });

            setMode('overview');
        })();
    </script>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>