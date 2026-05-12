<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Applied Data Science with Python/Capstone 2';
$artifactSectionReturnPath = anchored_return_path('data-artifact-links');
$colabVerificationConfig = $colabVerificationConfig ?? [];
$colabConfig = $colabVerificationConfig['capstone-2'] ?? [];

$requirementsPath = $capstoneRoot . '/requirements/capstone_2_requirements.md';
$projectPdfPath = $capstoneRoot . '/Capstone_Session_2.pdf';
$notebookPath = $capstoneRoot . '/capstone_2.ipynb';
$infographicPath = $capstoneRoot . '/infographic_capstone_2.png';
$inputDatasetPath = $capstoneRoot . '/NSMES1988new.csv';
$referenceDatasetPath = $capstoneRoot . '/NSMES1988.csv';
$updatedDatasetPath = $capstoneRoot . '/outputs/NSMES1988updated.csv';
$optionalOptimizedDatasetPath = $capstoneRoot . '/outputs/NSMES1988optimized_optional.csv';

$colabLaunchReady = !empty($colabConfig['launchUrl']);
$notebookAvailable = project_artifact_exists($notebookPath);
$infographicAvailable = project_artifact_exists($infographicPath);
$optionalOptimizedDatasetAvailable = project_artifact_exists($optionalOptimizedDatasetPath);

$previewNotebookViewUrl = $notebookAvailable ? project_artifact_url($notebookPath, true) : null;
$previewNotebookPreviewUrl = $previewNotebookViewUrl;
if ($notebookAvailable && $previewNotebookPreviewUrl !== null) {
    $previewNotebookVersion = filemtime(project_artifact_fs_path($notebookPath));
    if ($previewNotebookVersion !== false) {
        $previewNotebookPreviewUrl .= '&v=' . rawurlencode((string) $previewNotebookVersion);
    }
}
$previewNotebookEmbedUrl = $previewNotebookPreviewUrl !== null ? $previewNotebookPreviewUrl . '&embed=1' : null;
$previewNotebookHtml = $notebookAvailable ? project_render_notebook_html($notebookPath) : null;

$verificationFlow = [
    'Notebook preview and launch link.',
    'Input handoff dataset and required output CSV.',
    'Optional follow-on CSV when available.',
    'Capstone 2 notebook workspace.',
];

$verificationInputs = [
    [
        'label' => 'Input Handoff Dataset',
        'url' => project_artifact_absolute_url($inputDatasetPath, false, true),
        'note' => 'The cleaned Capstone 1 handoff file that Capstone 2 loads as its working input.',
    ],
    [
        'label' => 'Notebook File',
        'url' => project_artifact_absolute_url($notebookPath, false, true),
        'note' => 'The staged Capstone 2 notebook used as the main evidence source for the walkthrough.',
    ],
    [
        'label' => 'Updated Output CSV',
        'url' => project_artifact_absolute_url($updatedDatasetPath, false, true),
        'note' => 'The required Capstone 2 output file produced after the scaling and statistical analysis steps.',
    ],
];

if ($optionalOptimizedDatasetAvailable) {
    $verificationInputs[] = [
        'label' => 'Optional Follow-On CSV',
        'url' => project_artifact_absolute_url($optionalOptimizedDatasetPath, false, true),
        'note' => 'Optional follow-on export derived from the dtype recommendation step.',
    ];
}

if (!empty($colabConfig['publicNotebookSourceUrl'])) {
    $verificationInputs[] = [
        'label' => 'Notebook Source',
        'url' => (string) $colabConfig['publicNotebookSourceUrl'],
        'note' => 'Public GitHub source path used for the site-backed Colab launch flow.',
    ];
}

if ($infographicAvailable) {
    $verificationInputs[] = [
        'label' => 'Project Infographic',
        'url' => project_artifact_absolute_url($infographicPath, false, true),
        'note' => 'Portfolio-ready visual summary for the Capstone 2 workflow and staged deliverables.',
    ];
}

$screenshotArtifacts = project_collect_screenshot_artifacts($capstoneRoot);
$screenshotsAvailable = $screenshotArtifacts !== [];
$screenshotManifestPath = project_screenshot_manifest_path($capstoneRoot);

$preferredHeroImageRelativePath = $infographicPath;
$heroImageCandidates = [
    project_artifact_exists($preferredHeroImageRelativePath) ? $preferredHeroImageRelativePath : null,
    project_first_matching_relative_path($capstoneRoot . '/Screenshots', ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']),
    project_first_matching_relative_path($capstoneRoot . '/outputs/plots', ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']),
    project_first_matching_relative_path($capstoneRoot, ['*.png', '*.jpg', '*.jpeg', '*.webp', '*.gif', '*.svg']),
];

$heroImageRelativePath = null;
foreach ($heroImageCandidates as $candidate) {
    if ($candidate !== null) {
        $heroImageRelativePath = $candidate;
        break;
    }
}

$heroImagePath = $heroImageRelativePath !== null ? project_artifact_url($heroImageRelativePath) : 'assets/images/hero-placeholder.svg';
$heroCaption = $heroImageRelativePath !== null
    ? 'Capstone 2 infographic.'
    : 'Capstone 2 placeholder image.';

$heroTitle = 'Capstone 2 Evidence Map';
$heroImageAlt = $heroImageRelativePath !== null ? 'Capstone 2 infographic' : 'Capstone 2 evidence map placeholder';
require __DIR__ . '/../page-hero.php';

$assetLinks = [
    [
        'label' => 'Original Project PDF',
        'summary' => 'View the copied Capstone 2 directions PDF used as the source requirement document.',
        'viewHref' => project_artifact_url($projectPdfPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($projectPdfPath, false, true),
    ],
    [
        'label' => 'Notebook Evidence',
        'summary' => 'Open the Capstone 2 notebook in the browser-friendly artifact viewer.',
        'viewHref' => project_artifact_url($notebookPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($notebookPath, false, true),
    ],
    [
        'label' => 'Requirements Checklist',
        'summary' => 'Open the Capstone 2 requirements file created from the copied PDF task list.',
        'viewHref' => project_artifact_url($requirementsPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($requirementsPath, false, true),
    ],
    [
        'label' => 'Input Handoff CSV',
        'summary' => 'Open the `NSMES1988new.csv` handoff file that Capstone 2 uses as its starting point.',
        'viewHref' => project_artifact_url($inputDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($inputDatasetPath, false, true),
    ],
    [
        'label' => 'Reference Source CSV',
        'summary' => 'Open the original `NSMES1988.csv` copy kept alongside the Capstone 2 assets for lineage reference.',
        'viewHref' => project_artifact_url($referenceDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($referenceDatasetPath, false, true),
    ],
    [
        'label' => 'Updated Output CSV',
        'summary' => 'Open the required `NSMES1988updated.csv` output produced by the Capstone 2 workflow.',
        'viewHref' => project_artifact_url($updatedDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($updatedDatasetPath, false, true),
    ],
];

if ($infographicAvailable) {
    $assetLinks[] = [
        'label' => 'Project Infographic',
        'summary' => 'Open the Capstone 2 infographic used as the page hero and portfolio summary visual.',
        'viewHref' => project_artifact_url($infographicPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($infographicPath, false, true),
    ];
}

if ($screenshotsAvailable) {
    $assetLinks[] = [
        'label' => 'Screenshot Evidence',
        'summary' => 'Open the first staged screenshot evidence image for Capstone 2.',
        'viewHref' => project_artifact_url($screenshotArtifacts[0], true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($screenshotArtifacts[0], false, true),
    ];
} elseif ($screenshotManifestPath !== null) {
    $assetLinks[] = [
        'label' => 'Screenshot Manifest',
        'summary' => 'Open the staged manifest describing the screenshot evidence that still needs to be added for Capstone 2.',
        'viewHref' => project_artifact_url($screenshotManifestPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($screenshotManifestPath, false, true),
    ];
}

if ($optionalOptimizedDatasetAvailable) {
    $assetLinks[] = [
        'label' => 'Optional Follow-On CSV',
        'summary' => 'Open the optional follow-on CSV export derived from the dtype recommendation step.',
        'viewHref' => project_artifact_url($optionalOptimizedDatasetPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($optionalOptimizedDatasetPath, false, true),
    ];
}

$requirements = [
    ['id' => '1a', 'text' => 'Import relevant Python libraries.', 'section' => 'Notebook C?-T0 and C?-T1', 'evidence' => 'The staged notebook loads runtime path helpers and `pandas` before the Capstone 2 analysis steps begin.'],
    ['id' => '1b', 'text' => 'Import the CSV file `NSMES1988new.csv` into a dataframe.', 'section' => 'Notebook C?-T2', 'evidence' => 'The notebook loads the Capstone 1 handoff CSV, confirms the path, and previews the dataframe with shape `(4406, 18)`.'],
    ['id' => '1c', 'text' => 'Perform memory analysis of the new dataframe and compare it with the memory of the dataframe in the previous week and mark your comments.', 'section' => 'Notebook C2-T4', 'evidence' => 'The notebook compares Capstone 2 memory `2,228,671` bytes against the Capstone 1 reference `2,263,919` bytes and records the `-35,248` byte difference.'],
    ['id' => '1d', 'text' => 'Perform the following operations on age and income columns: multiply age by 10 and income by 10000.', 'section' => 'Notebook C2-T5', 'evidence' => 'The notebook adds `age_years` and `income_dollars` so the scaled values are visible while the original encoded source fields remain available.'],
    ['id' => '1e', 'text' => 'Perform basic statistical analysis on the new dataframe and generate a brief report on the outcome.', 'section' => 'Notebook C2-T6', 'evidence' => 'The notebook reports descriptive statistics for the numeric fields and summarizes the right-skew behavior of visits and income.'],
    ['id' => '1f', 'text' => 'Save the dataframe as `NSMES1988updated.csv` file in the local space for possible future use.', 'section' => 'Notebook C2-T7', 'evidence' => 'The required output file is staged at `outputs/NSMES1988updated.csv` with exported shape `(4406, 20)`.'],
    ['id' => '1g', 'text' => 'Invoke `describe` command on the dataframe and compare that with the basic statistical analysis done in the previous step.', 'section' => 'Notebook C2-T8', 'evidence' => 'The notebook runs `describe(include="all")` and compares that wider summary to the focused statistics from the prior section.'],
    ['id' => '1h', 'text' => 'Indicate which of the columns are not eligible for statistical analysis and indicate possible datatype changes, and report.', 'section' => 'Notebook C2-T8', 'evidence' => 'The notebook identifies eight label-like fields for categorical treatment and recommends integer downcasts for selected count columns.'],
    ['id' => '1i', 'text' => 'Make changes to the recommended file from the previous step and export it as a new `.csv` file for possible future use. Optional.', 'section' => 'PDF p.8 optional step', 'evidence' => $optionalOptimizedDatasetAvailable ? 'Optional follow-on CSV export is available as `outputs/NSMES1988optimized_optional.csv`.' : 'Optional follow-on CSV export is not available.'],
    ['id' => '1j', 'text' => 'Prepare a brief report and enter it in the markup cells of the JupyterLab notebook.', 'section' => 'Notebook C2-T6, C2-T8, Final section', 'evidence' => 'The notebook markdown cells preserve the brief report and conclusions directly alongside the statistical outputs.'],
];

$walkthrough = [
    [
        'id' => '1a',
        'title' => 'Runtime and Library Imports',
        'notebookSection' => 'C?-T0 and C?-T1',
        'requirement' => 'Import relevant Python libraries.',
        'summary' => 'The notebook starts with runtime path handling and imports the dataframe tooling needed for the Capstone 2 analysis path.',
        'results' => [
            'Runtime setup establishes reusable project paths and the output folder structure.',
            '`pandas` is imported explicitly for dataframe operations and statistical summaries.',
            'The notebook uses supporting imports in the setup cell instead of scattering them throughout later requirement sections.',
        ],
        'code' => <<<'PY'
from pathlib import Path
from datetime import datetime

try:
    from IPython.display import display
except Exception:
    def display(value):
        print(value)

import pandas as pd
PY,
    ],
    [
        'id' => '1b',
        'title' => 'Load the Cleaned Handoff Dataset',
        'notebookSection' => 'C?-T2',
        'requirement' => 'Import the CSV file `NSMES1988new.csv` into a dataframe.',
        'summary' => 'Capstone 2 begins from the cleaned handoff created at the end of Capstone 1, and the notebook confirms that input path before running any analysis.',
        'results' => [
            'Loaded dataset: `NSMES1988new.csv`.',
            'Working dataframe shape: `(4406, 18)`.',
            'A dataframe preview is displayed immediately after load as the first evidence checkpoint.',
        ],
        'code' => <<<'PY'
DEFAULT_DATASET = "NSMES1988new.csv"
DATASET_PATH = resolve_dataset_path(DEFAULT_DATASET)

df = pd.read_csv(DATASET_PATH)
print("Loaded:", DATASET_PATH)
print("Shape:", df.shape)
display(df.head())
PY,
    ],
    [
        'id' => '1c',
        'title' => 'Memory Comparison Against Capstone 1',
        'notebookSection' => 'C2-T4',
        'requirement' => 'Perform memory analysis of the new dataframe and compare it with the memory of the dataframe in the previous week and mark your comments.',
        'summary' => 'The notebook compares Capstone 2 memory usage to the Capstone 1 reference.',
        'results' => [
            'Current dataframe memory: `2,228,671` bytes (`2.125 MB`).',
            'Capstone 1 reference memory: `2,263,919` bytes (`2.159 MB`).',
            'Difference: `-35,248` bytes (`-0.034 MB`), indicating a modest reduction after the cleaned handoff step.',
        ],
        'code' => <<<'PY'
mem2 = df.memory_usage(deep=True).sum()
mem1 = 2263919
diff = mem2 - mem1

print("Total memory (bytes):", mem2)
print("Total memory (MB):", round(mem2 / (1024**2), 3))
print("Capstone 1 memory (bytes):", mem1)
print("Difference vs Capstone 1 (bytes):", diff)
print("Difference vs Capstone 1 (MB):", round(diff / (1024**2), 3))
PY,
    ],
    [
        'id' => '1d',
        'title' => 'Scale Age and Income to Real Units',
        'notebookSection' => 'C2-T5',
        'requirement' => 'Perform the following operations on age and income columns: multiply age by 10 and income by 10000.',
        'summary' => 'The notebook adds scaled columns while keeping the original encoded source fields.',
        'results' => [
            '`age` stays available as the original encoded field while `age_years` exposes the real-year values.',
            '`income` stays available as the original encoded field while `income_dollars` exposes dollar values.',
            'Scaled ranges: `age_years` from `66` to `109`; `income_dollars` from `-10,125` to `548,351`.',
        ],
        'code' => <<<'PY'
df2 = df.copy()

if "age" in df2.columns:
    df2["age_years"] = (df2["age"] * 10).round(0).astype("Int64")

if "income" in df2.columns:
    df2["income_dollars"] = (df2["income"] * 10000).round(0).astype("Int64")

display(df2[["age", "age_years", "income", "income_dollars"]].head())
PY,
    ],
    [
        'id' => '1e',
        'title' => 'Basic Statistical Analysis and Brief Report',
        'notebookSection' => 'C2-T6',
        'requirement' => 'Perform basic statistical analysis on the new dataframe and generate a brief report on the outcome.',
        'summary' => 'The notebook combines numeric summary tables with a written interpretation of the distribution patterns that matter most for the dataset.',
        'results' => [
            '`visits` summary: mean `5.774`, median `4`, min `0`, max `89`.',
            '`age_years` summary: mean `74.024`, median `73`, min `66`, max `109`.',
            '`income_dollars` summary: mean `25,271.321`, median `16,981.5`, min `-10,125`, max `548,351`.',
            'The notebook report notes right-skew in utilization and income, and it retains the negative-income records.',
        ],
        'code' => <<<'PY'
numeric_cols = df2.select_dtypes(include=["number"]).columns
display(df2[numeric_cols].describe())

summary = df2[["visits", "age_years", "income_dollars"]].agg(["mean", "median", "min", "max"]).T
display(summary)
PY,
    ],
    [
        'id' => '1f',
        'title' => 'Export the Updated Handoff File',
        'notebookSection' => 'C2-T7',
        'requirement' => 'Save the dataframe as `NSMES1988updated.csv` file in the local space for possible future use.',
        'summary' => 'After the scaling step and statistical summary work are complete, the notebook exports the updated dataset for downstream capstone use.',
        'results' => [
            'Saved file: `outputs/NSMES1988updated.csv`.',
            'Exported dataframe shape: `(4406, 20)`.',
            'The exported file carries the original 18 fields plus `age_years` and `income_dollars`.',
        ],
        'code' => <<<'PY'
out_csv = OUTPUT_DIR / "NSMES1988updated.csv"
df2.to_csv(out_csv, index=False)
print("Saved:", out_csv)
print("Shape:", df2.shape)
PY,
    ],
    [
        'id' => '1g',
        'title' => 'Compare `describe()` With the Prior Summary',
        'notebookSection' => 'C2-T8',
        'requirement' => 'Invoke `describe` command on the dataframe and compare that with the basic statistical analysis done in the previous step.',
        'summary' => 'The notebook widens the statistical view by running `describe(include="all")`, then compares that broader output to the focused summaries already written for visits, age, and income.',
        'results' => [
            'The broader `describe()` output confirms the same central tendencies surfaced in the focused summary section.',
            'The all-column view adds category counts and top values for label-like fields that were not part of the narrower numeric-only report.',
            'This step compares the `describe()` output with the earlier brief report.',
        ],
        'code' => <<<'PY'
display(df2.describe(include="all"))

summary = df2[["visits", "age_years", "income_dollars"]].agg(["mean", "median", "min", "max"]).T
display(summary)
PY,
    ],
    [
        'id' => '1h',
        'title' => 'Identify Non-Eligible Fields and Dtype Changes',
        'notebookSection' => 'C2-T8',
        'requirement' => 'Indicate which of the columns are not eligible for statistical analysis and indicate possible datatype changes, and report.',
        'summary' => 'The notebook separates fields that are label-like from fields that are suitable for continuous analysis and records concrete dtype recommendations for each group.',
        'results' => [
            'Columns not eligible for continuous numeric interpretation: `health`, `adl`, `region`, `gender`, `married`, `employed`, `insurance`, `medicaid`.',
            'Recommended `category` conversions match those eight label and flag fields.',
            'Recommended downcasts: `int8` for `visits`, `nvisits`, `emergency`, `hospital`, `chronic`, `school`, `age_years`; `int16` for `ovisits` and `novisits`.',
        ],
        'code' => <<<'PY'
cat_like = ["health", "adl", "region", "gender", "married", "employed", "insurance", "medicaid"]
print("Categorical/label-like columns:", cat_like)

recommend_rows = []
for column_name in cat_like:
    recommend_rows.append({
        "column": column_name,
        "eligible_for_continuous_stats": "No",
        "suggested_dtype": "category",
    })

display(pd.DataFrame(recommend_rows))
PY,
    ],
    [
        'id' => '1i',
        'title' => 'Optional Follow-On CSV Export',
        'notebookSection' => 'PDF p.8 optional step',
        'requirement' => 'Make changes to the recommended file from the previous step and export it as a new `.csv` file for possible future use. Optional.',
        'summary' => $optionalOptimizedDatasetAvailable
            ? 'An optional follow-on CSV export is available.'
            : 'The optional follow-on CSV export is not available.',
        'results' => $optionalOptimizedDatasetAvailable
            ? [
                'Optional artifact: `outputs/NSMES1988optimized_optional.csv`.',
                'This optional export is tracked separately from the required `NSMES1988updated.csv` handoff file.',
                'This export is optional.',
            ]
            : [
                'No optional follow-on CSV is available yet.',
                'The required Capstone 2 deliverable remains `outputs/NSMES1988updated.csv`.',
                'This item is optional.',
            ],
        'code' => $optionalOptimizedDatasetAvailable
            ? <<<'PY'
# Optional follow-on export
optional_out_csv = OUTPUT_DIR / "NSMES1988optimized_optional.csv"
print("Saved:", optional_out_csv)
PY
            : <<<'TXT'
Optional follow-on export is not available yet.
Optional item.
TXT,
    ],
    [
        'id' => '1j',
        'title' => 'Notebook Report in Markup Cells',
        'notebookSection' => 'C2-T6, C2-T8, Final section',
        'requirement' => 'Prepare a brief report and enter it in the markup cells of the JupyterLab notebook.',
        'summary' => 'Capstone 2 closes with notebook markdown blocks that interpret the statistical outputs and restate the capstone outcome in narrative form.',
        'results' => [
            'The notebook records a brief report after the basic statistical analysis section.',
            'The notebook restates the field eligibility and dtype recommendations in markdown alongside the tables.',
            'The final markdown section summarizes the memory comparison, the new scaled fields, and the updated CSV output artifact.',
        ],
        'code' => <<<'TXT'
Visit counts are right-skewed, with a small high-utilization tail.
The sample is concentrated in older age bands, with a median age of 73 years.
Income is highly right-skewed, so the median is more robust than the mean.
Negative income values are preserved and documented instead of being dropped blindly.
TXT,
    ],
];
?>
<section class="content-card p-4 p-lg-5 mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">
        <div>
            <span class="hero-chip mb-3">Applied Data Science</span>
            <h2 class="section-title">Capstone 2: Data Processing and Statistical Analysis</h2>
            <p class="mb-3">Capstone 2 covers memory analysis, scaling, statistical analysis, required CSV export, and reporting.</p>
            <p class="mb-0"><strong>Mapped source folder:</strong> <?php echo htmlspecialchars($capstoneRoot, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="artifact-card p-3">
            <span class="artifact-label mb-2">Quick Facts</span>
            <ul class="mb-0 ps-3">
                <li>Input handoff: <code>NSMES1988new.csv</code></li>
                <li>Required output: <code>NSMES1988updated.csv</code></li>
                <li>Memory change from Capstone 1: <code>-35,248 bytes</code></li>
                <li>Scaled analysis fields: <code>age_years</code>, <code>income_dollars</code></li>
            </ul>
        </div>
    </div>
</section>

<?php echo project_render_embedded_pdf_section(
    $projectPdfPath,
    'Original Project PDF',
    'The original Capstone 2 directions are embedded here.'
); ?>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Requirement Checklist</h2>
    <p>The checklist below follows the PDF task sequence.</p>
    <div class="row row-cols-1 row-cols-lg-2 g-3 mt-1">
        <?php foreach ($requirements as $requirement): ?>
            <div class="col">
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
    <p>Each walkthrough block covers one requirement and the matching notebook evidence.</p>
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
    <h2 class="section-title">Data and Artifact Links</h2>
    <p>The links below open the Capstone 2 project files.</p>
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
    <p class="text-muted mb-0">Capstone 2 input and output files remain available on this page.</p>
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="integration-console">
                <div class="console-toolbar">
                    <div class="console-lights" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="console-title">Capstone 2 Notebook Workspace</div>
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
                            <div class="console-placeholder">
                                The Capstone 2 notebook artifact is not available yet.
                            </div>
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
                <span class="artifact-label mb-2">Launch Controls</span>
                <h3 class="h5">Notebook Launch</h3>
                <p class="mb-3">Launch the matching notebook in Google Colab or open the source file.</p>
                <div class="artifact-actions">
                    <?php if ($colabLaunchReady): ?>
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $colabConfig['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Launch Colab</a>
                    <?php else: ?>
                        <span class="btn btn-secondary disabled">Colab Launch Pending</span>
                    <?php endif; ?>
                    <?php if (!empty($colabConfig['publicNotebookSourceUrl'])): ?>
                        <a class="btn btn-outline-dark" href="<?php echo htmlspecialchars((string) $colabConfig['publicNotebookSourceUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">View Notebook Source</a>
                    <?php endif; ?>
                </div>
                <div class="evidence-card p-3 mt-3">
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
                <p class="mb-0 mt-3 text-muted">Colab and source links follow the configured notebook path.</p>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Execution Notes</h2>
    <div class="status-note p-3">
        <p class="mb-2"><strong>Current mode:</strong> notebook-backed presentation with downloadable artifacts.</p>
        <p class="mb-2">This page presents the PDF, notebook, input dataset, and exported outputs.</p>
        <p class="mb-0">The notebook opens in Google Colab when launched.</p>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Outputs and Results</h2>
    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Outputs</span>
                <ul class="mb-0 ps-3">
                    <li><code>outputs/NSMES1988updated.csv</code> is the required Capstone 2 handoff file for downstream work.</li>
                    <li>The notebook adds <code>age_years</code> and <code>income_dollars</code> while keeping the original source fields visible.</li>
                    <li>The working dataframe retains all <code>4406</code> rows throughout the staged Capstone 2 flow.</li>
                    <?php if ($optionalOptimizedDatasetAvailable): ?>
                        <li><code>outputs/NSMES1988optimized_optional.csv</code> preserves the optional follow-on export as a separate artifact.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Findings</span>
                <ul class="mb-0 ps-3">
                    <li>Capstone 2 uses slightly less dataframe memory than the Capstone 1 reference snapshot.</li>
                    <li>Visits and income both show right-skew behavior, so median values remain important alongside means.</li>
                    <li>Label and flag fields should be treated as categories rather than as continuous statistical variables.</li>
                    <li>Negative income values are preserved and documented instead of being dropped without explanation.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5">
    <h2 class="section-title">Submission Evidence</h2>
    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Available Evidence</span>
                <ul class="mb-0 ps-3">
                    <li>Project PDF</li>
                    <li>Notebook source with outputs</li>
                    <li>Requirements checklist extracted from the PDF</li>
                    <li>Input and output CSV artifacts</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Screenshot Status</span>
                <ul class="mb-0 ps-3">
                    <li>The optional follow-on CSV export is separate from the required deliverables.</li>
                    <?php if ($screenshotsAvailable): ?>
                        <li><?php echo count($screenshotArtifacts); ?> screenshot evidence file(s).</li>
                        <?php foreach ($screenshotArtifacts as $screenshotArtifact): ?>
                            <li><?php echo htmlspecialchars(basename($screenshotArtifact), ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    <?php elseif ($screenshotManifestPath !== null): ?>
                        <li>No screenshot images are available yet.</li>
                        <li>The screenshot manifest is present at <code>Capstone 2/Screenshots/README.md</code>.</li>
                        <li>Add ordered evidence images under <code>Capstone 2/Screenshots/</code>.</li>
                    <?php else: ?>
                        <li>The <code>Capstone 2/Screenshots/</code> folder is missing.</li>
                        <li>Add the folder and ordered evidence images.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>