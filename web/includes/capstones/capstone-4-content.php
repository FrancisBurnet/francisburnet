<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Applied Data Science with Python/Capstone 4';
$artifactSectionReturnPath = anchored_return_path('data-artifact-links');
$colabVerificationConfig = $colabVerificationConfig ?? [];
$colabConfig = $colabVerificationConfig['capstone-4'] ?? [];

$requirementsPath = $capstoneRoot . '/requirements/capstone_4_requirements.md';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_4.pdf';
$notebookPath = $capstoneRoot . '/capstone_4.ipynb';
$infographicPath = $capstoneRoot . '/infographic_capstone_4.png';
$referenceDatasetPath = $capstoneRoot . '/NSMES1988.csv';
$inputDatasetPath = 'Incremental Capstones/Applied Data Science with Python/Capstone 2/outputs/NSMES1988updated.csv';

$plotArtifacts = [
    'region_counts.png' => 'Count by region chart',
    'health_counts.png' => 'Count by health category chart',
    'mean_visits_region_health.png' => 'Mean visits by region and health chart',
    'correlation_matrix.png' => 'Correlation matrix heatmap',
    'scatter_income_vs_visits.png' => 'Income versus visits scatter plot',
    'scatter_age_vs_visits.png' => 'Age versus visits scatter plot',
    'scatter_income_vs_emergency.png' => 'Income versus emergency visits scatter plot',
];

$colabLaunchReady = !empty($colabConfig['launchUrl']);
$notebookAvailable = project_artifact_exists($notebookPath);
$infographicAvailable = project_artifact_exists($infographicPath);
$inputDatasetAvailable = project_artifact_exists($inputDatasetPath);
$previewNotebookHtml = $notebookAvailable ? project_render_notebook_html($notebookPath) : null;

$verificationFlow = [
    'Input dataset from Capstone 2.',
    'Plotting library choice and saved charts.',
    'Correlation matrix and scatter plots.',
    'Code screenshots and plot artifacts.',
];

$verificationInputs = [];
if ($inputDatasetAvailable) {
    $verificationInputs[] = [
        'label' => 'Capstone 2 Updated Input CSV',
        'url' => project_artifact_absolute_url($inputDatasetPath, false, true),
        'note' => 'Primary handoff dataset used for Capstone 4 visualization work.',
    ];
}
$verificationInputs[] = [
    'label' => 'Notebook File',
    'url' => project_artifact_absolute_url($notebookPath, false, true),
    'note' => 'Staged Capstone 4 notebook containing the chart-generation commands and observations.',
];
$verificationInputs[] = [
    'label' => 'Reference Source CSV',
    'url' => project_artifact_absolute_url($referenceDatasetPath, false, true),
    'note' => 'Original NSMES source copy kept with the Capstone 4 assets.',
];
if (!empty($colabConfig['publicNotebookSourceUrl'])) {
    $verificationInputs[] = [
        'label' => 'Notebook Source',
        'url' => (string) $colabConfig['publicNotebookSourceUrl'],
        'note' => 'Public notebook source path used when a Colab launch URL is configured.',
    ];
}

if ($infographicAvailable) {
    $heroImagePath = project_artifact_url($infographicPath);
    $heroTitle = 'Capstone 4 Infographic';
    $heroImageAlt = 'Capstone 4 infographic';
    require __DIR__ . '/../page-hero.php';
}

$assetLinks = [
    [
        'label' => 'Original Project PDF',
        'summary' => 'View the copied Capstone 4 directions PDF used as the source requirement document.',
        'viewHref' => project_artifact_url($projectPdfPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($projectPdfPath, false, true),
    ],
    [
        'label' => 'Notebook Evidence',
        'summary' => 'Open the Capstone 4 notebook in the browser-friendly artifact viewer.',
        'viewHref' => project_artifact_url($notebookPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($notebookPath, false, true),
    ],
    [
        'label' => 'Requirements Checklist',
        'summary' => 'Open the Capstone 4 requirements file created from the copied PDF task list.',
        'viewHref' => project_artifact_url($requirementsPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($requirementsPath, false, true),
    ],
    [
        'label' => 'Reference Source CSV',
        'summary' => 'Open the original `NSMES1988.csv` source copy kept with Capstone 4.',
        'viewHref' => project_artifact_url($referenceDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($referenceDatasetPath, false, true),
    ],
];
if ($inputDatasetAvailable) {
    $assetLinks[] = [
        'label' => 'Capstone 2 Updated Input CSV',
        'summary' => 'Open the `NSMES1988updated.csv` handoff dataset used to generate the Capstone 4 charts.',
        'viewHref' => project_artifact_url($inputDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($inputDatasetPath, false, true),
    ];
}
if ($infographicAvailable) {
    $assetLinks[] = [
        'label' => 'Project Infographic',
        'summary' => 'Open the user-supplied Capstone 4 infographic asset.',
        'viewHref' => project_artifact_url($infographicPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($infographicPath, false, true),
    ];
}
foreach ($plotArtifacts as $plotFile => $label) {
    $plotPath = $capstoneRoot . '/outputs/plots/' . $plotFile;
    if (project_artifact_exists($plotPath)) {
        $assetLinks[] = [
            'label' => $label,
            'summary' => 'Open the staged plot artifact generated by the Capstone 4 notebook.',
            'viewHref' => project_artifact_url($plotPath, true, false, $artifactSectionReturnPath),
            'downloadHref' => project_artifact_url($plotPath, false, true),
        ];
    }
}

$requirements = [
    ['id' => '4a', 'text' => 'Import relevant Python libraries necessary for Python and Pandas analysis, as well as visualization.', 'section' => 'Notebook setup and imports', 'evidence' => 'The notebook imports `pandas` for grouped summaries and `matplotlib.pyplot` for plot generation and PNG export.'],
    ['id' => '4b', 'text' => 'Import the CSV file `NSMES1988updated.csv` and create a new dataframe for working with Pandas.', 'section' => 'Notebook load step', 'evidence' => 'The notebook loads the Capstone 2 updated handoff dataset and ensures the derived year and dollar columns are available.'],
    ['id' => '4c', 'text' => 'Indicate the plotting library choice and reasons for the choice.', 'section' => 'Notebook C4-T3', 'evidence' => 'The notebook explicitly records Matplotlib as the plotting library and explains its export and customization benefits.'],
    ['id' => '4d', 'text' => 'Plot the Week 3 categorical data for Health and Region.', 'section' => 'Notebook C4-T4', 'evidence' => 'The notebook saves `region_counts.png`, `health_counts.png`, and `mean_visits_region_health.png` under `outputs/plots/`.'],
    ['id' => '4e', 'text' => 'Plot the Week 4 analyses and correlation.', 'section' => 'Notebook C4-T5', 'evidence' => 'The notebook exports the correlation matrix plus three scatter plots for the required relationship analysis.'],
    ['id' => '4f', 'text' => 'Prepare a detailed report and record your observations.', 'section' => 'Notebook markdown and conclusions', 'evidence' => 'The notebook markdown summarizes plot observations and records the final conclusion with saved-artifact notes.'],
];

$walkthrough = [
    [
        'id' => '4a',
        'title' => 'Set Up The Visualization Notebook And Load The Updated Dataset',
        'notebookSection' => 'Setup, imports, and load cells',
        'requirement' => 'Import the required analysis and visualization libraries and load `NSMES1988updated.csv`.',
        'summary' => 'Capstone 4 starts from the Capstone 2 updated dataset and brings in the minimum library set needed to build, show, and save the required charts.',
        'results' => [
            'Libraries used: `pandas` and `matplotlib.pyplot`.',
            'Main input: `Capstone 2/outputs/NSMES1988updated.csv`.',
            'The notebook ensures `age_years` and `income_dollars` exist before generating chart inputs.',
        ],
        'code' => <<<'PY'
import pandas as pd
import matplotlib.pyplot as plt

DEFAULT_DATASET = "NSMES1988updated.csv"
dataset_path = resolve_dataset_path(DEFAULT_DATASET)
df = pd.read_csv(dataset_path)

if "age_years" not in df.columns and "age" in df.columns:
    df["age_years"] = (df["age"] * 10).round(0)
if "income_dollars" not in df.columns and "income" in df.columns:
    df["income_dollars"] = (df["income"] * 10000).round(0)
PY,
    ],
    [
        'id' => '4b',
        'title' => 'State The Plotting Library Choice',
        'notebookSection' => 'C4-T3',
        'requirement' => 'Indicate the plotting library choice and reasons for the choice.',
        'summary' => 'The notebook records the plotting stack before any charts are produced so the page can map the tool choice directly to the PDF instruction.',
        'results' => [
            'Library choice: Matplotlib.',
            'Reasons recorded in the notebook: direct pandas compatibility, flexible formatting, and reliable PNG export for grading artifacts.',
            'This requirement records the plotting-library choice and justification.',
        ],
        'code' => <<<'PY'
print("Plotting library: matplotlib")
print("Reason: direct pandas compatibility, flexible formatting, and reliable PNG export for grading artifacts.")
PY,
    ],
    [
        'id' => '4c',
        'title' => 'Plot Health And Region Analysis',
        'notebookSection' => 'C4-T4',
        'requirement' => 'Plot the Week 3 categorical analysis for Health and Region.',
        'summary' => 'Capstone 4 converts the Week 3 categorical findings into saved bar charts and a grouped region-health utilization chart.',
        'results' => [
            'Saved categorical plot artifacts: `region_counts.png`, `health_counts.png`, and `mean_visits_region_health.png`.',
            'The notebook notes that the `other` region has the largest count and `average` health dominates the sample.',
            'The grouped region-health chart preserves the segmented visits story from the Capstone 3 pivot work.',
        ],
        'artifacts' => [
            [
                'label' => 'Count by Region',
                'path' => $capstoneRoot . '/outputs/plots/region_counts.png',
                'summary' => 'Saved bar chart for the region frequency breakdown.',
            ],
            [
                'label' => 'Count by Health Category',
                'path' => $capstoneRoot . '/outputs/plots/health_counts.png',
                'summary' => 'Saved bar chart for the health category distribution.',
            ],
            [
                'label' => 'Mean Visits by Region and Health',
                'path' => $capstoneRoot . '/outputs/plots/mean_visits_region_health.png',
                'summary' => 'Grouped chart tying the Week 3 categorical analysis to average visit levels.',
            ],
        ],
        'code' => <<<'PY'
region_counts = df["region"].value_counts()
fig, ax = plt.subplots(figsize=(7, 4.5))
region_counts.sort_index().plot(kind="bar", title="Count by Region", ax=ax)
fig.savefig(PLOTS_DIR / "region_counts.png", dpi=150)

fig, ax = plt.subplots(figsize=(7, 4.5))
df["health"].value_counts().sort_index().plot(kind="bar", title="Count by Health Category", ax=ax)
fig.savefig(PLOTS_DIR / "health_counts.png", dpi=150)

pivot_visits = pd.pivot_table(df, index="region", columns="health", values="visits", aggfunc="mean")
fig, ax = plt.subplots(figsize=(8, 5))
pivot_visits.plot(kind="bar", ax=ax)
fig.savefig(PLOTS_DIR / "mean_visits_region_health.png", dpi=150)
PY,
    ],
    [
        'id' => '4d',
        'title' => 'Plot Correlation And Relationship Analysis',
        'notebookSection' => 'C4-T5',
        'requirement' => 'Plot the Week 4 analysis and correlation.',
        'summary' => 'The notebook then moves from grouped categorical views into numeric correlation structure and scatter-relationship plots for the requested analysis layer.',
        'results' => [
            'Saved correlation and scatter artifacts: `correlation_matrix.png`, `scatter_income_vs_visits.png`, `scatter_age_vs_visits.png`, `scatter_income_vs_emergency.png`.',
            'Notebook correlation highlights include `emergency~hospital=0.476`, `ovisits~novisits=0.467`, and `visits~chronic=0.262`.',
            'The notebook also records the expected `1.0` correlation for the derived pairs `age~age_years` and `income~income_dollars`.',
        ],
        'artifacts' => [
            [
                'label' => 'Correlation Matrix',
                'path' => $capstoneRoot . '/outputs/plots/correlation_matrix.png',
                'summary' => 'Heatmap used to scan the full numeric correlation structure.',
            ],
            [
                'label' => 'Income vs Visits',
                'path' => $capstoneRoot . '/outputs/plots/scatter_income_vs_visits.png',
                'summary' => 'Scatter plot for the income and total visits relationship.',
            ],
            [
                'label' => 'Age vs Visits',
                'path' => $capstoneRoot . '/outputs/plots/scatter_age_vs_visits.png',
                'summary' => 'Scatter plot for the age and total visits relationship.',
            ],
            [
                'label' => 'Income vs Emergency Visits',
                'path' => $capstoneRoot . '/outputs/plots/scatter_income_vs_emergency.png',
                'summary' => 'Scatter plot for the income and emergency visits relationship.',
            ],
        ],
        'code' => <<<'PY'
num_df = df.select_dtypes(include=["number"])
corr = num_df.corr(numeric_only=True)

fig, ax = plt.subplots(figsize=(10, 8))
cax = ax.imshow(corr, cmap="coolwarm", vmin=-1, vmax=1)
fig.colorbar(cax, ax=ax)
fig.savefig(PLOTS_DIR / "correlation_matrix.png", dpi=150)

for x, y, fname, title in [
    ("income_dollars", "visits", "scatter_income_vs_visits.png", "Income vs Visits"),
    ("age_years", "visits", "scatter_age_vs_visits.png", "Age vs Visits"),
    ("income_dollars", "emergency", "scatter_income_vs_emergency.png", "Income vs Emergency Visits"),
]:
    fig, ax = plt.subplots(figsize=(6.5, 4.5))
    ax.scatter(df[x], df[y], alpha=0.3, s=12)
    fig.savefig(PLOTS_DIR / fname, dpi=150)
PY,
    ],
    [
        'id' => '4e',
        'title' => 'Record The Final Report And Observations',
        'notebookSection' => 'Final conclusions',
        'requirement' => 'Prepare a detailed report and record your observations.',
        'summary' => 'The notebook finishes by converting the saved chart outputs into an explicit observation set so the page can present both the figures and the interpretation layer.',
        'results' => [
            'The notebook confirms all required visualization artifacts are saved under `outputs/plots/`.',
            'The final notes distinguish true relationships from derived-feature correlations that are mechanically perfect.',
            'The page can therefore surface both the plots and the notebook’s written caveats without inventing new claims.',
        ],
        'code' => <<<'PY'
print("Capstone 4 completed: C4-T3 to C4-T5")
print("Artifacts saved under outputs/plots")
PY,
    ],
];

$screenshotArtifacts = [
    [
        'label' => 'Library Choice Code Screenshot',
        'path' => $capstoneRoot . '/Screenshots/capstone_4_library_choice_code.png',
        'summary' => 'Captured code evidence for the plotting-library choice section.',
    ],
    [
        'label' => 'Categorical Plotting Code Screenshot',
        'path' => $capstoneRoot . '/Screenshots/capstone_4_categorical_plots_code.png',
        'summary' => 'Captured code evidence for the saved health and region charts.',
    ],
    [
        'label' => 'Correlation Plotting Code Screenshot',
        'path' => $capstoneRoot . '/Screenshots/capstone_4_correlation_plots_code.png',
        'summary' => 'Captured code evidence for the correlation matrix and scatter plots.',
    ],
];

?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Capstone 4 Scope</h2>
    <p>Capstone 4 turns the prior analysis work into required saved visuals, making the notebook, chart exports, and written observations reviewable together in one PHP page.</p>
    <p class="mb-1">Primary notebook input: <code>Capstone 2/outputs/NSMES1988updated.csv</code>.</p>
    <p class="mb-0">Notebook evidence, plot artifacts, and code screenshots.</p>
</section>

<?php echo project_render_embedded_pdf_section(
    $projectPdfPath,
    'Original Project PDF',
    'The original Capstone 4 directions are embedded here.'
); ?>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Requirement Checklist</h2>
    <div class="row g-3 mt-1">
        <?php foreach ($requirements as $requirement): ?>
            <div class="col-lg-6">
                <div class="requirement-card p-3">
                    <span class="requirement-id"><?php echo htmlspecialchars($requirement['id'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <h3 class="h5 mt-2 mb-2"><?php echo htmlspecialchars($requirement['text'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="mb-1 text-muted">Source mapping: <?php echo htmlspecialchars($requirement['section'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="mb-0 text-muted">Evidence note: <?php echo htmlspecialchars($requirement['evidence'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Requirement Walkthrough</h2>
    <p>Each walkthrough block maps one required visualization step to the notebook section, the saved artifacts, and the interpretation notes recorded in the notebook.</p>
    <div class="d-grid gap-4 mt-3">
        <?php foreach ($walkthrough as $section): ?>
            <article class="requirement-card p-4">
                <span class="requirement-id"><?php echo htmlspecialchars($section['id'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h3 class="h4 mt-2 mb-2"><?php echo htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p class="mb-2"><strong>Notebook section:</strong> <?php echo htmlspecialchars($section['notebookSection'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p class="mb-2"><strong>Requirement:</strong> <?php echo htmlspecialchars($section['requirement'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><?php echo htmlspecialchars($section['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="d-grid gap-3">
                    <div class="evidence-card p-3">
                        <span class="artifact-label mb-2">Results Capture</span>
                        <ul class="mb-0 ps-3">
                            <?php foreach ($section['results'] as $result): ?>
                                <li><?php echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="code-shell"><pre><code><?php echo htmlspecialchars($section['code'], ENT_QUOTES, 'UTF-8'); ?></code></pre></div>
                    <?php if (!empty($section['artifacts'])): ?>
                        <div class="row g-3">
                            <?php foreach ($section['artifacts'] as $artifact): ?>
                                <?php if (!project_artifact_exists($artifact['path'])) { continue; } ?>
                                <div class="col-lg-6">
                                    <div class="artifact-card p-3 h-100">
                                        <span class="artifact-label mb-2">Associated Chart</span>
                                        <h4 class="h6"><?php echo htmlspecialchars($artifact['label'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                        <p class="mb-3"><?php echo htmlspecialchars($artifact['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        <img class="img-fluid rounded border mb-3" src="<?php echo htmlspecialchars(project_artifact_url($artifact['path']), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($artifact['label'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <div class="artifact-actions">
                                            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_url($artifact['path'], true, false, $artifactSectionReturnPath), ENT_QUOTES, 'UTF-8'); ?>">View</a>
                                            <a class="btn btn-primary" href="<?php echo htmlspecialchars(project_artifact_url($artifact['path'], false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php
$_cap4Plots = [];
foreach ($plotArtifacts as $plotFile => $label) {
    $plotPath = $capstoneRoot . '/outputs/plots/' . $plotFile;
    if (project_artifact_exists($plotPath)) {
        $_cap4Plots[] = ['path' => $plotPath, 'label' => $label];
    }
}
?>
<?php if ($_cap4Plots !== []): ?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Charts and Plots</h2>
    <p>Charts generated by the notebook. Click any image to open full-size, or use the download button to save the file.</p>
    <div class="row g-4 mt-1">
        <?php foreach ($_cap4Plots as $_plot): ?>
            <div class="col-12 col-lg-6">
                <div class="artifact-card p-3 h-100">
                    <span class="artifact-label mb-2"><?php echo htmlspecialchars($_plot['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <a href="<?php echo htmlspecialchars(project_artifact_url($_plot['path']), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
                        <img src="<?php echo htmlspecialchars(project_artifact_url($_plot['path']), ENT_QUOTES, 'UTF-8'); ?>"
                             alt="<?php echo htmlspecialchars($_plot['label'], ENT_QUOTES, 'UTF-8'); ?>"
                             class="img-fluid rounded mt-2" style="max-width:100%;">
                    </a>
                    <div class="mt-3">
                        <a class="btn btn-primary btn-sm"
                           href="<?php echo htmlspecialchars(project_artifact_url($_plot['path'], false, true), ENT_QUOTES, 'UTF-8'); ?>"
                           download>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<section id="data-artifact-links" class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Data And Artifact Links</h2>
    <p>The links below open the Capstone 4 project files.</p>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3 mt-1">
        <?php foreach ($assetLinks as $asset): ?>
            <div class="col">
                <div class="artifact-card p-3">
                    <span class="artifact-label mb-2">Artifact</span>
                    <h3 class="h5"><?php echo htmlspecialchars($asset['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="mb-3"><?php echo htmlspecialchars($asset['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <div class="artifact-actions">
                        <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars($asset['viewHref'], ENT_QUOTES, 'UTF-8'); ?>">View</a>
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars($asset['downloadHref'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Colab Notebook</h2>
    <p>This section provides the notebook preview, launch link, and project file links.</p>
    <p class="text-muted mb-0">Saved plot files and notebook output provide the execution record for this capstone.</p>
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="integration-console">
                <div class="console-toolbar">
                    <div class="console-lights" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="console-title">Capstone 4 Notebook Workspace</div>
                    <?php if ($colabLaunchReady): ?>
                        <a class="console-launch" href="<?php echo htmlspecialchars((string) $colabConfig['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Launch Colab</a>
                    <?php else: ?>
                        <div class="console-state is-pending">Colab Pending</div>
                    <?php endif; ?>
                </div>
                <div class="console-body">
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Embedded Notebook Preview</span>
                        <?php if ($previewNotebookHtml !== null): ?>
                            <div class="console-notebook-preview">
                                <?php echo $previewNotebookHtml; ?>
                            </div>
                        <?php else: ?>
                            <div class="console-placeholder">The Capstone 4 notebook artifact is not available yet.</div>
                        <?php endif; ?>
                    </div>
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Project Notes</span>
                        <ul class="console-list mb-0">
                            <?php foreach ($verificationFlow as $flowItem): ?>
                                <li><?php echo htmlspecialchars($flowItem, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="artifact-card p-3">
                <span class="artifact-label mb-2">Project File Links</span>
                <ul class="mb-0 ps-3">
                    <?php foreach ($verificationInputs as $input): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($input['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong>
                            <a href="<?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open <?php echo htmlspecialchars($input['label'], ENT_QUOTES, 'UTF-8'); ?></a>
                            <div class="text-muted small mt-1"><?php echo htmlspecialchars($input['note'], ENT_QUOTES, 'UTF-8'); ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Screenshot Evidence</h2>
    <div class="row g-3 mt-1">
        <?php foreach ($screenshotArtifacts as $screenshot): ?>
            <div class="col-lg-4">
                <div class="artifact-card p-3">
                    <span class="artifact-label mb-2">Code Screenshot</span>
                    <h3 class="h5"><?php echo htmlspecialchars($screenshot['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="mb-3"><?php echo htmlspecialchars($screenshot['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php if (project_artifact_exists($screenshot['path'])): ?>
                        <img class="img-fluid rounded border mb-3" src="<?php echo htmlspecialchars(project_artifact_url($screenshot['path']), ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($screenshot['label'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="artifact-actions">
                            <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars(project_artifact_url($screenshot['path'], true, false, $artifactSectionReturnPath), ENT_QUOTES, 'UTF-8'); ?>">View</a>
                            <a class="btn btn-primary" href="<?php echo htmlspecialchars(project_artifact_url($screenshot['path'], false, true), ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Download</a>
                        </div>
                    <?php else: ?>
                        <div class="status-note p-3">
                            <p class="mb-0">This code screenshot has not been generated yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="content-card p-4 p-lg-5">
    <h2 class="section-title">Outputs And Results</h2>
    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Outputs</span>
                <ul class="mb-0 ps-3">
                    <li>Seven PNG artifacts are present under <code>outputs/plots/</code>.</li>
                    <li>The correlation matrix and the three scatter plots preserve the Week 4 relationship-analysis evidence directly as downloadable artifacts.</li>
                    <li>The screenshot evidence cards preserve the code used to create the saved figures, so the page shows both implementation and output artifacts.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Findings</span>
                <ul class="mb-0 ps-3">
                    <li>The categorical plots confirm the heavy concentration of `average` health responses and the larger `other` region population.</li>
                    <li>The notebook reports meaningful relationships such as `emergency~hospital` and `ovisits~novisits`, while also calling out the mechanically perfect derived-feature correlations.</li>
                    <li>The saved plot bundle is complete enough to act as the primary grading artifact set for this capstone page.</li>
                </ul>
            </div>
        </div>
    </div>
</section>