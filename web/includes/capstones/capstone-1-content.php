<?php

declare(strict_types=1);

require_once __DIR__ . '/../artifact-helpers.php';

$capstoneRoot = 'Incremental Capstones/Applied Data Science with Python/Capstone 1';
$artifactSectionReturnPath = anchored_return_path('data-artifact-links');
$colabVerificationConfig = $colabVerificationConfig ?? [];
$colabConfig = $colabVerificationConfig['capstone-1'] ?? [];
$verificationNotebookPath = $capstoneRoot . '/capstone_1_colab_verification.ipynb';
$verificationNotebookViewUrl = project_artifact_url($verificationNotebookPath, true);
$originalNotebookPath = $capstoneRoot . '/capstone_1.ipynb';
$originalDatasetPath = $capstoneRoot . '/NSMES1988.csv';
$cleanedDatasetPath = $capstoneRoot . '/outputs/NSMES1988new.csv';
$jsonExportPath = $capstoneRoot . '/outputs/NSMES1988.json';
$publicDatasetRepoNote = 'I can also publish a lightweight public dataset mirror under the FrancisBurnet account when that makes the Colab workflow cleaner, while the live site continues to host the project artifacts.';
$colabLaunchReady = !empty($colabConfig['launchUrl']);
$verificationNotebookAvailable = project_artifact_exists($verificationNotebookPath);
$verificationFlow = [
    'I use this page to present the notebook, source dataset, and published outputs for Capstone 1 in one place.',
    'The notebook preview lives on this page, and the matching Colab notebook opens from the same project path.',
    'The live dataset and output files stay aligned with the materials I publish in the repository and on the site.',
    'This section is part of the project presentation and stays aligned with the published notebook path.',
];
$verificationInputs = [
    [
        'label' => 'Live Dataset URL',
        'url' => project_artifact_absolute_url($originalDatasetPath, false, true),
        'note' => 'Primary dataset link served from the live site.',
    ],
    [
        'label' => 'Original Notebook Download URL',
        'url' => project_artifact_absolute_url($originalNotebookPath, false, true),
        'note' => 'Original notebook file as served by the live site.',
    ],
    [
        'label' => 'Colab Notebook URL',
        'url' => project_artifact_absolute_url($verificationNotebookPath, false, true),
        'note' => 'Colab notebook published with Capstone 1.',
    ],
    [
        'label' => 'Cleaned CSV Output URL',
        'url' => project_artifact_absolute_url($cleanedDatasetPath, false, true),
        'note' => 'Cleaned CSV output published with the project.',
    ],
    [
        'label' => 'JSON Output URL',
        'url' => project_artifact_absolute_url($jsonExportPath, false, true),
        'note' => 'JSON export published with the project.',
    ],
];

if (!empty($colabConfig['publicDatasetMirrorUrl'])) {
    $verificationInputs[] = [
        'label' => 'Public Dataset Mirror URL',
        'url' => $colabConfig['publicDatasetMirrorUrl'],
        'note' => 'Optional public-repo dataset mirror when I want a lightweight dataset repository.',
    ];
}

$preferredHeroImageRelativePath = $capstoneRoot . '/infographic_capstone_1.png';
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
    ? 'This hero image is loaded directly from the Capstone 1 project files.'
    : 'Add the Capstone 1 infographic image to the project files and this page will load it automatically.';

$heroTitle = 'Capstone 1 Evidence Map';
$heroImageAlt = $heroImageRelativePath !== null ? 'Capstone 1 infographic' : 'Capstone 1 evidence map placeholder';
require __DIR__ . '/../page-hero.php';

$assetLinks = [
    [
        'label' => 'Original Project PDF',
        'summary' => 'View the copied project directions PDF used as the source requirement document.',
        'viewHref' => project_artifact_url($capstoneRoot . '/Capstone_Session_1.pdf', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/Capstone_Session_1.pdf', false, true),
    ],
    [
        'label' => 'Notebook Evidence',
        'summary' => 'Open the original Capstone 1 notebook in a browser-friendly viewer page.',
        'viewHref' => project_artifact_url($capstoneRoot . '/capstone_1.ipynb', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/capstone_1.ipynb', false, true),
    ],
    [
        'label' => 'Requirements Checklist',
        'summary' => 'Open the Capstone 1 requirements file created for the website workflow.',
        'viewHref' => project_artifact_url($capstoneRoot . '/requirements/capstone_1_requirements.md', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/requirements/capstone_1_requirements.md', false, true),
    ],
    [
        'label' => 'Original CSV Dataset',
        'summary' => 'Open the original source file `NSMES1988.csv` in a browser-friendly viewer page.',
        'viewHref' => project_artifact_url($capstoneRoot . '/NSMES1988.csv', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/NSMES1988.csv', false, true),
    ],
    [
        'label' => 'JSON Export',
        'summary' => 'View the `NSMES1988.json` artifact produced by the notebook.',
        'viewHref' => project_artifact_url($capstoneRoot . '/outputs/NSMES1988.json', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/outputs/NSMES1988.json', false, true),
    ],
    [
        'label' => 'Cleaned CSV Handoff',
        'summary' => 'Open the cleaned `NSMES1988new.csv` handoff file in a browser-friendly viewer page.',
        'viewHref' => project_artifact_url($capstoneRoot . '/outputs/NSMES1988new.csv', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/outputs/NSMES1988new.csv', false, true),
    ],
    [
        'label' => 'Screenshot Status',
        'summary' => 'Open the placeholder manifest for screenshots that still need to be added.',
        'viewHref' => project_artifact_url($capstoneRoot . '/Screenshots/README.md', true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($capstoneRoot . '/Screenshots/README.md', false, true),
    ],
];

if (project_artifact_exists($verificationNotebookPath)) {
    $assetLinks[] = [
        'label' => 'Colab Notebook',
        'summary' => 'Open or download the Colab-ready notebook for Capstone 1.',
        'viewHref' => project_artifact_url($verificationNotebookPath, true, false, $artifactSectionReturnPath),
        'downloadHref' => project_artifact_url($verificationNotebookPath, false, true),
    ];
}

$requirements = [
    ['id' => '1a', 'text' => 'Import relevant Python libraries necessary for Python programming and Numpy for numerical operations.', 'section' => 'PDF p.15 / Notebook C?-T1', 'evidence' => 'Copied notebook documents a `pandas` import. A separate `numpy` import is not surfaced in the copied notebook.'],
    ['id' => '1b', 'text' => 'Import the CSV file `NSMES1988.csv` into a dataframe.', 'section' => 'Notebook C?-T2', 'evidence' => 'Copied notebook loads `NSMES1988.csv` with `pd.read_csv(...)` and previews the dataframe.'],
    ['id' => '1c', 'text' => 'Inspect the dataset and report rows, columns, and data types.', 'section' => 'Notebook C1-T4', 'evidence' => 'Copied notebook reports shape, columns, `info()`, descriptive statistics, and a head preview.'],
    ['id' => '1d', 'text' => 'Find out if the data is clean or if the data has missing values.', 'section' => 'Notebook C1-T5', 'evidence' => 'Copied notebook computes missing-value counts and percentages for every column.'],
    ['id' => '1e', 'text' => 'Comment on the data types, their values and range, specifically on `age` and `income` columns.', 'section' => 'Notebook C1-T6', 'evidence' => 'Copied notebook documents dtype, range, and age encoding notes for `age` and `income`.'],
    ['id' => '1f', 'text' => 'Export the data to JSON as `NSMES1988.json` and view and enter your comments.', 'section' => 'Notebook C1-T7', 'evidence' => 'Copied notebook exports JSON and previews a snippet for format comments.'],
    ['id' => '1g', 'text' => 'Perform memory information on the data and recommend what non-default data types would optimize dataframe memory settings.', 'section' => 'Notebook C1-T8', 'evidence' => 'Copied notebook measures memory usage and recommends category conversion candidates.'],
    ['id' => '1h', 'text' => 'Recommend what changes should be made on the dataframe before attempting a detailed data analysis.', 'section' => 'Notebook C1-T9', 'evidence' => 'Copied notebook recommends dropping the index-like `Unnamed: 0` column before downstream analysis.'],
    ['id' => '1i', 'text' => 'Export the dataframe as a new CSV file `NSMES1988new.csv` and store it locally for other assignments.', 'section' => 'Notebook C1-T9', 'evidence' => 'Copied notebook exports the cleaned dataframe to `outputs/NSMES1988new.csv`.'],
    ['id' => '1j', 'text' => 'Write a short report on the visual observations of the data.', 'section' => 'PDF p.16', 'evidence' => 'This PDF requirement is not yet surfaced as a dedicated visual-observations report in the copied notebook or current website page.'],
];

$walkthrough = [
    [
        'id' => '1a',
        'title' => 'Library Imports Required by the PDF',
        'notebookSection' => 'C?-T1',
        'requirement' => 'Import relevant Python libraries necessary for Python programming and Numpy for numerical operations.',
        'summary' => 'The copied notebook explicitly documents the `pandas` import used for dataframe operations. The PDF mentions Numpy as part of the task statement, but a separate `numpy` import is not shown in the copied notebook cells.',
        'results' => [
            'Copied notebook import evidence: `import pandas as pd`.',
            'The page now separates the PDF requirement from the notebook evidence instead of assuming all requested imports were shown.',
            'No dedicated `numpy` import cell is surfaced in the copied notebook content.',
        ],
        'code' => <<<'PY'
import pandas as pd  # DataFrames + CSV/JSON IO + analysis tables
PY,
    ],
    [
        'id' => '1b',
        'title' => 'Load the Source CSV into a Dataframe',
        'notebookSection' => 'C?-T2',
        'requirement' => 'Import the CSV file `NSMES1988.csv` into a dataframe.',
        'summary' => 'The copied notebook loads the required CSV file from the capstone folder and confirms the shape immediately after reading it into a dataframe.',
        'results' => [
            'The dataset is loaded from the expected default filename: `NSMES1988.csv`.',
            'The notebook confirms shape immediately after loading: `(4406, 19)`.',
            'A head preview is displayed as initial evidence that the dataframe loaded successfully.',
        ],
        'code' => <<<'PY'
dataset_path = DATASET_PATH
df = pd.read_csv(dataset_path)

print("Loaded:", dataset_path)
print("Shape:", df.shape)
display(df.head())
PY,
    ],
    [
        'id' => '1c',
        'title' => 'Inspection and Basic Profiling',
        'notebookSection' => 'C1-T4',
        'requirement' => 'Inspect the data and report details such as rows, columns, and data types.',
        'summary' => 'The notebook profiles the dataset with `shape`, `columns`, `info`, numeric `describe()`, and a head preview before any transformation.',
        'results' => [
            '`df.shape = (4406, 19)`.',
            '11 numeric columns and 8 non-numeric columns were identified.',
            '`Unnamed: 0` is visible during inspection and is later treated as index-like cleanup work.',
        ],
        'code' => <<<'PY'
# Inspection
print("Shape:", df.shape)
print("\nColumns:")
print(df.columns.tolist())

print("\nInfo:")
df.info()

print("\nDescribe (numeric):")
display(df.describe())

print("\nHead:")
display(df.head())
PY,
    ],
    [
        'id' => '1d',
        'title' => 'Missing Values and Cleanliness Check',
        'notebookSection' => 'C1-T5',
        'requirement' => 'Find out if the data is clean or if the data has missing values.',
        'summary' => 'Missing-value counts and percentages were computed for every field to verify whether any treatment was required before export.',
        'results' => [
            'All copied columns returned `0` missing values.',
            'No missing-value treatment was required before continuing to export tasks.',
            'The cleanliness check is now mapped directly to the PDF bullet instead of being inferred from the workflow prompt.',
        ],
        'code' => <<<'PY'
# Missing values
na_counts = df.isna().sum().sort_values(ascending=False)
na_pct = (df.isna().mean() * 100).round(2)
missing_summary = pd.DataFrame({"missing_count": na_counts, "missing_pct": na_pct})
display(missing_summary[missing_summary["missing_count"] > 0] if (missing_summary["missing_count"] > 0).any() else missing_summary.head())
PY,
    ],
    [
        'id' => '1e',
        'title' => 'Age and Income Interpretation',
        'notebookSection' => 'C1-T6',
        'requirement' => 'Comment on the data types, their values and range, specifically on `age` and `income` columns.',
        'summary' => 'The page preserves the notebook interpretation that age is stored as years divided by 10 and verifies the ranges for both `age` and `income`.',
        'results' => [
            '`age` uses `float64` with a range of `6.6` to `10.9`.',
            '`income` uses `float64` with a range of `-1.0125` to `54.8351`.',
            'Example interpretation preserved from the project notes: `age = 6.9` corresponds to 69 years.',
        ],
        'code' => <<<'PY'
# Age + income notes
for col in ["age", "income"]:
    if col in df.columns:
        print(f"\n{col} dtype:", df[col].dtype)
        print(df[col].describe())
    else:
        print(f"Column not found: {col}")
PY,
    ],
    [
        'id' => '1f',
        'title' => 'JSON Export and Format Comment',
        'notebookSection' => 'C1-T7',
        'requirement' => 'Export the data to JSON as `NSMES1988.json` and view and enter your comments.',
        'summary' => 'The notebook exported the full dataframe using `records` orientation and previewed a snippet to confirm the row-wise object structure.',
        'results' => [
            'Artifact saved as `outputs/NSMES1988.json`.',
            'The JSON is row-oriented and suitable for downstream systems that expect one object per record.',
            'The page now keeps the JSON-format commentary tied to the exact PDF bullet.',
        ],
        'code' => <<<'PY'
# Export JSON
json_path = BASE_DIR / "outputs" / "NSMES1988.json"
json_path.parent.mkdir(parents=True, exist_ok=True)

df.to_json(json_path, orient="records")
print("Saved:", json_path)

# Preview first ~500 chars
with open(json_path, "r", encoding="utf-8") as f:
    snippet = f.read(500)
print("\nJSON snippet (first 500 chars):\n", snippet)
PY,
    ],
    [
        'id' => '1g',
        'title' => 'Memory Usage and Dtype Recommendations',
        'notebookSection' => 'C1-T8',
        'requirement' => 'Perform memory information on the data and recommend what non-default data types would optimize dataframe memory settings.',
        'summary' => 'The PDF explicitly asks for memory information, and the copied notebook measures total dataframe memory and identifies category-conversion candidates.',
        'results' => [
            'Total memory usage: `2,263,919` bytes (`2.159 MB`).',
            'Recommended category columns: `health`, `adl`, `region`, `gender`, `married`, `employed`, `insurance`, `medicaid`.',
            'This item remains on the page because it is directly stated on PDF p.16.',
        ],
        'code' => <<<'PY'
# Memory usage
mem = df.memory_usage(deep=True).sum()
print("Total memory (bytes):", mem)
print("Total memory (MB):", round(mem / (1024**2), 3))
candidate_category = [c for c in ["health","adl","region","gender","married","employed","insurance","medicaid"] if c in df.columns]
print("Recommended category columns:", candidate_category)
PY,
    ],
    [
        'id' => '1h',
        'title' => 'Recommended Dataframe Changes Before Detailed Analysis',
        'notebookSection' => 'C1-T9',
        'requirement' => 'Recommend what changes should be made on the dataframe before attempting a detailed data analysis.',
        'summary' => 'The copied notebook recommends one safe structural cleanup before deeper analysis: remove the index-like `Unnamed: 0` column.',
        'results' => [
            'Recommended cleanup: drop `Unnamed: 0` before detailed analysis.',
            'The recommendation is separated here because the PDF states it as its own bullet before the final CSV export.',
            'The same cleanup step is reused in the cleaned CSV handoff export.',
        ],
        'code' => <<<'PY'
df_clean = df.copy()

if "Unnamed: 0" in df_clean.columns:
    df_clean = df_clean.drop(columns=["Unnamed: 0"])
    print("Dropped column: Unnamed: 0")
PY,
    ],
    [
        'id' => '1i',
        'title' => 'Cleaned CSV Handoff Export',
        'notebookSection' => 'C1-T9',
        'requirement' => 'Export the dataframe as a new CSV file `NSMES1988new.csv` and store it locally for other assignments.',
        'summary' => 'After the recommended cleanup is applied, the notebook saves the cleaned handoff file for later capstone work.',
        'results' => [
            'Artifact saved as `outputs/NSMES1988new.csv`.',
            'Resulting shape: `(4406, 18)`.',
            'The exported file is the cleaned handoff used for the next assignment stage.',
        ],
        'code' => <<<'PY'
out_csv = BASE_DIR / "outputs" / "NSMES1988new.csv"
out_csv.parent.mkdir(parents=True, exist_ok=True)

df_clean.to_csv(out_csv, index=False)
print("Saved:", out_csv)
print("Shape:", df_clean.shape)
PY,
    ],
    [
        'id' => '1j',
        'title' => 'Short Report on Visual Observations',
        'notebookSection' => 'PDF p.16',
        'requirement' => 'Write a short report on the visual observations of the data.',
        'summary' => 'The PDF includes a visual-observations report as its final task, but the copied notebook and current staged artifacts do not yet expose a dedicated plot or written visual-summary section for Capstone 1.',
        'results' => [
            'This PDF requirement is now listed explicitly instead of being silently dropped from the checklist.',
            'No dedicated visual-report cell or saved plot is surfaced in the copied Capstone 1 notebook.',
            'This section should be updated from source evidence once the visual observations report is added to the staged materials.',
        ],
        'code' => <<<'PY'
# PDF source-of-truth note
# The Capstone 1 PDF requires a short report on visual observations.
# That report is not yet surfaced as a dedicated notebook section or saved plot
# in the copied website materials, so the website marks this item as pending
# source-backed evidence instead of inventing completion.
PY,
    ],
];
?>
<section class="content-card p-4 p-lg-5 mb-4">
    <div class="d-flex flex-column flex-lg-row justify-content-between gap-4">
        <div>
            <span class="hero-chip mb-3">Applied Data Science</span>
            <h2 class="section-title">Capstone 1: Data Import and Cleaning</h2>
            <p class="mb-3">This page maps Capstone 1 directly from the copied project PDF. The PDF is the source of truth for the checklist, and the notebook is used only as supporting evidence for the items it actually covers.</p>
            <p class="mb-0"><strong>Mapped source folder:</strong> <?php echo htmlspecialchars($capstoneRoot, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="artifact-card p-3">
            <span class="artifact-label mb-2">Quick Facts</span>
            <ul class="mb-0 ps-3">
                <li>Dataset: <code>NSMES1988.csv</code></li>
                <li>Notebook workflow: <code>C1-T4</code> through <code>C1-T9</code></li>
                <li>Primary exports: <code>NSMES1988.json</code>, <code>NSMES1988new.csv</code></li>
                <li>Current execution mode: artifact-backed presentation with no live rerun yet</li>
            </ul>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Requirement Checklist</h2>
    <p>The checklist below mirrors the PDF task bullets from pages 15 and 16. Each card shows where supporting notebook evidence exists, and it leaves unsupported PDF items visible instead of replacing them with prompt-driven filler.</p>
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
    <p>Each block below is keyed to a PDF task bullet first. Where the copied notebook contains direct evidence, the page shows that exact code. Where the staged materials do not yet contain direct evidence, the page says so explicitly.</p>
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
    <p>The links below expose the copied Capstone 1 materials through the PHP app so I can present the original project files directly inside the FrancisBurnetCom structure.</p>
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
    <p>I use this section to keep the notebook preview, Colab launch, and project file links together in one place on the site.</p>
    <p class="text-muted mb-0"><?php echo htmlspecialchars($publicDatasetRepoNote, ENT_QUOTES, 'UTF-8'); ?></p>
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="integration-console">
                <div class="console-toolbar">
                    <div class="console-lights" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="console-title">Capstone 1 Notebook Workspace</div>
                    <div class="console-state <?php echo $colabLaunchReady ? 'is-ready' : 'is-pending'; ?>"><?php echo $colabLaunchReady ? 'Colab Launch Ready' : 'Colab Launch Pending'; ?></div>
                </div>
                <div class="console-body">
                    <div class="console-panel">
                        <span class="artifact-label mb-2">Embedded Notebook Preview</span>
                        <?php if ($verificationNotebookAvailable): ?>
                            <iframe
                                class="console-frame"
                                src="<?php echo htmlspecialchars($verificationNotebookViewUrl, ENT_QUOTES, 'UTF-8'); ?>"
                                title="Capstone 1 notebook preview"
                                loading="lazy"
                            ></iframe>
                        <?php else: ?>
                            <div class="console-placeholder">
                                The Colab notebook artifact is not available yet.
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
                <p class="mb-3">The notebook preview stays on this site, and the launch button opens the matching Google Colab notebook from the public project source.</p>
                <div class="artifact-actions">
                    <?php if ($colabLaunchReady): ?>
                        <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) $colabConfig['launchUrl'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open in Colab</a>
                    <?php else: ?>
                        <span class="btn btn-secondary disabled">Open in Colab Pending Notebook URL</span>
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
                                <?php if (!empty($input['url'])): ?>
                                    <a href="<?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer"><?php echo htmlspecialchars((string) $input['url'], ENT_QUOTES, 'UTF-8'); ?></a>
                                <?php else: ?>
                                    <span>Available after the site is served from the live public domain.</span>
                                <?php endif; ?>
                                <div class="text-muted small mt-1"><?php echo htmlspecialchars($input['note'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <p class="mb-0 mt-3 text-muted">I keep the default Colab and notebook source links in the public `FrancisBurnet/francisburnet` repository, and I can still override them with environment variables if the notebook path changes later.</p>
            </div>
        </div>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Execution Notes</h2>
    <div class="status-note p-3">
        <p class="mb-2"><strong>Current mode:</strong> I present Capstone 1 as notebook-backed project evidence with downloadable artifacts.</p>
        <p class="mb-2">I have not added a server-side rerun endpoint. The PHP page is focused on showing the code, files, and outputs clearly inside the site.</p>
        <p class="mb-0">The notebook still opens in Google Colab when launched, while this page remains the place where I organize the capstone materials and outputs.</p>
    </div>
</section>

<section class="content-card p-4 p-lg-5 mb-4">
    <h2 class="section-title">Outputs and Results</h2>
    <div class="row g-3 mt-1">
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Outputs</span>
                <ul class="mb-0 ps-3">
                    <li><code>outputs/NSMES1988.json</code> preserves the row-wise JSON export requested by the capstone.</li>
                    <li><code>outputs/NSMES1988new.csv</code> becomes the cleaned handoff file for Capstone 2.</li>
                    <li>The raw dataset stayed complete with no missing-value remediation required.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Key Findings</span>
                <ul class="mb-0 ps-3">
                    <li>Age is encoded as years divided by 10 and needs interpretation in the narrative.</li>
                    <li><code>Unnamed: 0</code> behaves like an index column and was dropped from the cleaned export.</li>
                    <li>Memory optimization opportunities are concentrated in repeated label columns.</li>
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
                    <li>Copied project PDF</li>
                    <li>Notebook source with executed outputs</li>
                    <li>Requirements checklist for the website workflow</li>
                    <li>JSON and cleaned CSV artifacts</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="evidence-card p-3">
                <span class="artifact-label mb-2">Pending Additions</span>
                <ul class="mb-0 ps-3">
                    <li>Screenshots have not been copied into the project yet.</li>
                    <li>If screenshots are added later, store them in <code>Capstone 1/Screenshots/</code> with ordered filenames.</li>
                    <li>This page is now structured to surface those screenshots once they exist.</li>
                </ul>
            </div>
        </div>
    </div>
</section>