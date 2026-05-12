<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Applied Data Science with Python/Capstone 3';
$artifactSectionReturnPath = anchored_return_path('data-artifact-links');
$colabVerificationConfig = $colabVerificationConfig ?? [];
$colabConfig = $colabVerificationConfig['capstone-3'] ?? [];

$requirementsPath = $capstoneRoot . '/requirements/capstone_3_requirements.md';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_3.pdf';
$notebookPath = $capstoneRoot . '/capstone_3.ipynb';
$infographicPath = $capstoneRoot . '/infographic_capstone_3.png';
$referenceDatasetPath = $capstoneRoot . '/NSMES1988.csv';
$inputDatasetPath = 'Incremental Capstones/Applied Data Science with Python/Capstone 2/outputs/NSMES1988updated.csv';

$colabLaunchReady = !empty($colabConfig['launchUrl']);
$notebookAvailable = project_artifact_exists($notebookPath);
$infographicAvailable = project_artifact_exists($infographicPath);
$inputDatasetAvailable = project_artifact_exists($inputDatasetPath);
$previewNotebookHtml = $notebookAvailable ? project_render_notebook_html($notebookPath) : null;

$verificationFlow = [
    'Input dataset from Capstone 2.',
    'Dtype audit and categorical review.',
    'Pivot, grouped analysis, and distribution tables.',
    'Code screenshots and notebook evidence.',
];

$verificationInputs = [];
if ($inputDatasetAvailable) {
    $verificationInputs[] = [
        'label' => 'Capstone 2 Updated Input CSV',
        'url' => project_artifact_absolute_url($inputDatasetPath, false, true),
        'note' => 'Primary handoff dataset loaded by the Capstone 3 notebook.',
    ];
}
$verificationInputs[] = [
    'label' => 'Notebook File',
    'url' => project_artifact_absolute_url($notebookPath, false, true),
    'note' => 'Staged Capstone 3 notebook used as the main evidence source for the page walkthrough.',
];
$verificationInputs[] = [
    'label' => 'Reference Source CSV',
    'url' => project_artifact_absolute_url($referenceDatasetPath, false, true),
    'note' => 'Original NSMES source copy retained in the Capstone 3 folder for lineage reference.',
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
    $heroTitle = 'Capstone 3 Infographic';
    $heroImageAlt = 'Capstone 3 infographic';
    require __DIR__ . '/../page-hero.php';
}

$assetLinks = [
    [
        'label' => 'Original Project PDF',
        'summary' => 'View the copied Capstone 3 directions PDF used as the source requirement document.',
        'viewHref' => project_artifact_url($projectPdfPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($projectPdfPath, false, true),
    ],
    [
        'label' => 'Notebook Evidence',
        'summary' => 'Open the Capstone 3 notebook in the browser-friendly artifact viewer.',
        'viewHref' => project_artifact_url($notebookPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($notebookPath, false, true),
    ],
    [
        'label' => 'Requirements Checklist',
        'summary' => 'Open the Capstone 3 requirements file created from the copied PDF task list.',
        'viewHref' => project_artifact_url($requirementsPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($requirementsPath, false, true),
    ],
    [
        'label' => 'Reference Source CSV',
        'summary' => 'Open the original `NSMES1988.csv` source copy kept with Capstone 3.',
        'viewHref' => project_artifact_url($referenceDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($referenceDatasetPath, false, true),
    ],
];
if ($inputDatasetAvailable) {
    $assetLinks[] = [
        'label' => 'Capstone 2 Updated Input CSV',
        'summary' => 'Open the `NSMES1988updated.csv` handoff dataset used as the Capstone 3 notebook input.',
        'viewHref' => project_artifact_url($inputDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($inputDatasetPath, false, true),
    ];
}
if ($infographicAvailable) {
    $assetLinks[] = [
        'label' => 'Project Infographic',
        'summary' => 'Open the user-supplied Capstone 3 infographic asset.',
        'viewHref' => project_artifact_url($infographicPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($infographicPath, false, true),
    ];
}

$requirements = [
    ['id' => '3a', 'text' => 'Import relevant Python libraries necessary for Python and Pandas analysis.', 'section' => 'Notebook setup and imports', 'evidence' => 'The notebook imports `pandas` after the runtime path setup and uses it across pivot, crosstab, and grouped summary sections.'],
    ['id' => '3b', 'text' => 'Import the CSV file `NSMES1988updated.csv` and create a new dataframe for working with Pandas.', 'section' => 'Notebook load step', 'evidence' => 'The notebook loads the Capstone 2 updated handoff dataset and confirms the working dataframe shape as `(4406, 20)`.'],
    ['id' => '3c', 'text' => 'Identify different types of data and report it.', 'section' => 'Notebook C3-T4', 'evidence' => 'The dtype audit table classifies all 20 fields into numeric versus categorical/flag groups.'],
    ['id' => '3d', 'text' => 'Identify categorical types in the data.', 'section' => 'Notebook C3-T4', 'evidence' => 'The notebook explicitly lists label-like fields and confirms category values for `health` and `region`.'],
    ['id' => '3e', 'text' => 'Perform a detailed data pivoting on the dataframe and report it.', 'section' => 'Notebook C3-T5', 'evidence' => 'Capstone 3 builds detailed `region × health` pivots for count, mean visits, and mean income.'],
    ['id' => '3f', 'text' => 'Include Health and Region categorical data in your analysis.', 'section' => 'Notebook C3-T5', 'evidence' => 'The pivot section uses `health` and `region` as the categorical keys for the core segmented analysis.'],
    ['id' => '3g', 'text' => 'Prepare a detailed report on your analysis and observations.', 'section' => 'Notebook markdown sections', 'evidence' => 'The notebook markdown cells record results capture notes and conclusions after each analysis block.'],
    ['id' => '3h', 'text' => 'Perform analysis based on different types of visits, gender, marital status, school, income, employment status, insurance, and medical aid.', 'section' => 'Notebook C3-T6', 'evidence' => 'The notebook groups utilization and income metrics by each required demographic and coverage criterion.'],
    ['id' => '3i', 'text' => 'Generate age and gender distribution.', 'section' => 'Notebook C3-T7', 'evidence' => 'A cross-tab distribution table is created for age groups by gender.'],
    ['id' => '3j', 'text' => 'Create health status by gender distribution.', 'section' => 'Notebook C3-T7', 'evidence' => 'A health-by-gender crosstab is rendered as part of the required distribution set.'],
    ['id' => '3k', 'text' => 'Compile income distribution by gender, regional income distribution, and age-wise income analysis.', 'section' => 'Notebook C3-T7', 'evidence' => 'The notebook generates grouped income tables for gender, region, and age-group analysis.'],
    ['id' => '3l', 'text' => 'Report your findings.', 'section' => 'Final conclusions', 'evidence' => 'The final conclusion cell summarizes the segmented insights and confirms completion of the distribution-table work.'],
];

$walkthrough = [
    [
        'id' => '3a',
        'title' => 'Runtime Setup And Load The Updated Handoff Dataset',
        'notebookSection' => 'Setup and load cells',
        'requirement' => 'Import Pandas, load `NSMES1988updated.csv`, and create the working dataframe.',
        'summary' => 'Capstone 3 begins from the Capstone 2 handoff artifact and uses a path fallback so the notebook can resolve the updated dataset from the prior capstone output.',
        'results' => [
            'Main input: `Capstone 2/outputs/NSMES1988updated.csv`.',
            'Working dataframe shape: `(4406, 20)` with the `age_years` and `income_dollars` columns already present from Capstone 2.',
            'Analysis starts from the updated handoff file.',
        ],
        'code' => <<<'PY'
import pandas as pd

DEFAULT_DATASET = "NSMES1988updated.csv"

try:
    dataset_path = resolve_dataset_path(DEFAULT_DATASET)
except FileNotFoundError:
    fallback = first_existing_path([
        BASE_DIR.parent / "Capstone 2" / "outputs" / "NSMES1988updated.csv",
        CWD / "Capstone 2" / "outputs" / "NSMES1988updated.csv",
        CWD / "Incremental_Capstone" / "Capstone 2" / "outputs" / "NSMES1988updated.csv",
    ])
    if fallback is None:
        raise
    dataset_path = fallback

df = pd.read_csv(dataset_path)
print("Loaded:", dataset_path)
print("Shape:", df.shape)
display(df.head())
PY,
    ],
    [
        'id' => '3b',
        'title' => 'Audit Data Types And Identify Categorical Fields',
        'notebookSection' => 'C3-T4',
        'requirement' => 'Identify different data types and identify categorical types in the data.',
        'summary' => 'The notebook produces a full dtype audit and then confirms which fields must be treated as categories rather than continuous numeric measures.',
        'results' => [
            'A 20-column dtype audit table is created with a `data_type_group` classification.',
            '`health` categories: `average`, `excellent`, `poor`.',
            '`region` categories: `midwest`, `northeast`, `other`, `west`.',
        ],
        'code' => <<<'PY'
categorical_cols = {"health", "adl", "region", "gender", "married", "employed", "insurance", "medicaid"}
dtype_audit = pd.DataFrame({
    "column": df.columns,
    "dtype": [str(df[c].dtype) for c in df.columns],
    "data_type_group": ["categorical/flag" if c in categorical_cols else "numeric" for c in df.columns]
})
display(dtype_audit)

for col in ["health", "region"]:
    print(sorted(df[col].dropna().unique().tolist()))
PY,
    ],
    [
        'id' => '3c',
        'title' => 'Perform Detailed Pivoting For Health And Region',
        'notebookSection' => 'C3-T5',
        'requirement' => 'Perform detailed pivoting and include Health and Region categorical analysis.',
        'summary' => 'The core segmented analysis uses `region × health` pivot tables to measure record counts, average visits, and average income across the required categorical dimensions.',
        'results' => [
            'Pivot count size: `(4, 3)` covering all 4,406 records.',
            'Three pivot outputs are generated: counts, mean visits, and mean `income_dollars`.',
            'The pivots make the region-health utilization and income differences explicit in one place.',
        ],
        'code' => <<<'PY'
pivot_count = pd.pivot_table(df, index="region", columns="health", values="visits", aggfunc="count", fill_value=0)
pivot_mean_visits = pd.pivot_table(df, index="region", columns="health", values="visits", aggfunc="mean", fill_value=0)
pivot_mean_income = pd.pivot_table(df, index="region", columns="health", values="income_dollars", aggfunc="mean", fill_value=0)

display(pivot_count)
display(pivot_mean_visits.round(3))
display(pivot_mean_income.round(2))
PY,
    ],
    [
        'id' => '3d',
        'title' => 'Analyze Required Criteria Tables',
        'notebookSection' => 'C3-T6',
        'requirement' => 'Analyze visits, gender, marital status, school, income, employment status, insurance, and medical aid.',
        'summary' => 'Capstone 3 groups utilization and income metrics by each requested demographic and coverage criterion so the requested comparison tables stay directly aligned to the PDF.',
        'results' => [
            'Grouped criteria tables are produced for `gender`, `married`, `school`, `employed`, `insurance`, and `medicaid`.',
            'Female mean visits exceed male mean visits in the notebook summary, while male mean income is higher.',
            'Medicaid enrollment aligns with higher mean visits and lower mean income in the staged notebook output.',
        ],
        'code' => <<<'PY'
criteria_cols = ["gender", "married", "school", "employed", "insurance", "medicaid"]
metric_cols = [c for c in ["visits", "nvisits", "ovisits", "novisits", "emergency", "hospital"] if c in df.columns]

for c in criteria_cols:
    table = df.groupby(c)[metric_cols + ["income_dollars"]].mean(numeric_only=True).round(3)
    display(table)
PY,
    ],
    [
        'id' => '3e',
        'title' => 'Build The Required Distribution Tables And Findings',
        'notebookSection' => 'C3-T7 and conclusions',
        'requirement' => 'Create age and gender, health by gender, income by gender, regional income, and age-wise income distributions and report findings.',
        'summary' => 'The notebook closes the capstone by building all required distribution tables and then documenting the cross-group patterns that matter for the report.',
        'results' => [
            'Required distribution table sizes reported in the notebook: Age+Gender `(5x2)`, Health by Gender `(3x2)`, Income by Gender `(2x3)`, Regional Income `(4x3)`, Age-wise Income `(5x3)`.',
            'The notebook notes that `west` shows the highest regional mean income and `other` the lowest.',
            'The conclusion section confirms the PDF-required segmented analysis was completed and written up in the notebook markdown.',
        ],
        'code' => <<<'PY'
df3 = df.copy()
df3["age_group"] = pd.cut(df3["age_years"].astype(float), bins=[65, 70, 75, 80, 85, 110], include_lowest=True)

display(pd.crosstab(df3["age_group"], df3["gender"]))
display(pd.crosstab(df3["health"], df3["gender"]))
display(pd.pivot_table(df3, index="gender", values="income_dollars", aggfunc=["count", "mean", "median"]).round(2))
display(pd.pivot_table(df3, index="region", values="income_dollars", aggfunc=["count", "mean", "median"]).round(2))
display(pd.pivot_table(df3, index="age_group", values="income_dollars", aggfunc=["count", "mean", "median"]).round(2))
PY,
    ],
];

$screenshotArtifacts = [
    [
        'label' => 'Dtype Audit Code Screenshot',
        'path' => $capstoneRoot . '/Screenshots/capstone_3_dtype_audit_code.png',
        'summary' => 'Captured code evidence for the dtype audit and categorical-field identification section.',
    ],
    [
        'label' => 'Pivot Analysis Code Screenshot',
        'path' => $capstoneRoot . '/Screenshots/capstone_3_pivot_analysis_code.png',
        'summary' => 'Captured code evidence for the region-health pivot tables.',
    ],
    [
        'label' => 'Distribution Tables Code Screenshot',
        'path' => $capstoneRoot . '/Screenshots/capstone_3_distribution_tables_code.png',
        'summary' => 'Captured code evidence for the required distribution-table section.',
    ],
];

?>
<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Capstone 3 Scope</h2>
    <p>Capstone 3 turns the Capstone 2 handoff dataset into a structured Pandas analysis package built around categorical profiling, pivot tables, grouped criteria analysis, and distribution tables.</p>
    <p class="mb-1">Primary notebook input: <code>Capstone 2/outputs/NSMES1988updated.csv</code>.</p>
    <p class="mb-0">Notebook evidence, code screenshots, and downloadable artifacts.</p>
</section>

<?php echo project_render_embedded_pdf_section(
    $projectPdfPath,
    'Original Project PDF',
    'The original Capstone 3 directions are embedded here.'
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
    <p>Each walkthrough block stays tied to one requirement family at a time, with the code sample and the notebook observations kept together for evidence review.</p>
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
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section id="data-artifact-links" class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Data And Artifact Links</h2>
    <p>The links below open the Capstone 3 project files.</p>
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
    <p class="text-muted mb-0">The notebook preview is the primary execution record for this capstone.</p>
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="integration-console">
                <div class="console-toolbar">
                    <div class="console-lights" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="console-title">Capstone 3 Notebook Workspace</div>
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
                            <div class="console-placeholder">The Capstone 3 notebook artifact is not available yet.</div>
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
                    <li>The notebook produces pivot tables and grouped distribution tables directly in the notebook outputs rather than exporting new CSV handoff files.</li>
                    <li>The code screenshots preserve the pivot, grouped-criteria, and distribution-table logic.</li>
                    <li>The requirements file documents the assignment task list.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Findings</span>
                <ul class="mb-0 ps-3">
                    <li>Region-health pivoting shows measurable variation in both visits and income across segments.</li>
                    <li>The grouped criteria tables surface clear visit and income differences across insurance and medicaid status.</li>
                    <li>The required distribution tables keep the Week 3 and Week 4 reporting aligned to age, gender, region, and income patterns without inventing extra requirements.</li>
                </ul>
            </div>
        </div>
    </div>
</section>