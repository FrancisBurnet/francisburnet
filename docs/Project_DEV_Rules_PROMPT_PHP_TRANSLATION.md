# Project DEV Rules Prompt PHP Translation

Source document preserved without modification: `X:\SIMPLILEARN\Project_DEV_Rules_PROMPT.md`

Use this translated prompt when building any capstone inside the FrancisBurnetCom website.

This document is based on the original notebook-first project rules. The grading logic stays the same, but the primary deliverable is now a PHP capstone page backed by copied artifacts, requirements files, and controlled execution hooks.

When a capstone is running under the current GitHub-backed FrancisBurnetCom deployment model, notebook inputs should still come from approved GitHub-backed sources. The PHP page maps to the copied capstone artifacts inside `Incremental Capstones/`, but the notebook runtime source of truth for datasets remains GitHub-backed rather than a machine-local dataset path.

## Project Family Boundary

This translated prompt is the implementation standard for capstone pages and also establishes the boundary for future published end-of-class projects.

- Incremental capstones belong under `Incremental Capstones/` and use the capstone registry and capstone page pattern.
- Published end-of-class projects belong under `Projects/` and should use a separate project registry and project page pattern.
- Do not force published end projects into the capstone registry just because they share some artifact helpers or page components.
- Shared PHP helpers, styling, notebook viewers, artifact links, and demo infrastructure may be reused across both families, but the content architecture should stay cleanly separated.

## Published Projects Architecture

When building a top-level published project for the `Projects` navigation:

- Keep the copied source package under `Projects/<Program Name>/<Project Name>/`.
- Use `web/public/projects.php` as the landing page for all published projects.
- Add project metadata to a dedicated end-project registry in `web/includes/config.php` rather than the capstone arrays.
- Use thin routes in `web/public/` and dedicated body includes under `web/includes/projects/`.
- Keep the same evidence standards: requirements, notebooks, screenshots, outputs, writeup, and honest execution notes.
- Treat the first published project as a reusable template for future projects, not as a one-off page.

## 0) Core Outputs Required

Create or maintain these items for each capstone:

### A) Requirements document
- File: `<project_name>_requirements.md`
- Store in the capstone source folder under `Incremental Capstones/.../requirements/` when that folder exists; otherwise keep it in the capstone root.
- Number requirements in strict order: `1a, 1b, 1c ... 2a, 2b ...`
- Convert every actionable instruction from the directions file into a checklist item.
- Keep the requirements file neutral and grading-friendly.
- Public page copy can use first-person Francis Burnet voice, but the requirements file should stay source-driven and neutral.

### B) PHP capstone page
- Route file: `web/public/<capstone-page>.php`
- The route must load shared config, header, navigation, and footer.
- The page content must follow the existing site pattern and render requirement-driven sections in strict order.
- Once a capstone is PDF-mapped, move the body into a dedicated include such as `web/includes/capstones/<capstone-key>-content.php` and keep the route thin.
- The shared `web/includes/capstone-page-content.php` file is only for generic placeholder pages that have not been rebuilt from their own PDFs yet.

### C) Source asset mapping
- Every page must point to the copied capstone folder inside `Incremental Capstones/`.
- Display the mapped source folder clearly on the page.
- Link to available notebooks, PDFs, screenshots, figures, tables, and exported artifacts using relative paths or generated links from the PHP app.

### D) Artifact package
- Keep or create these folders inside the copied capstone source folder where applicable:
  - `data/`
  - `outputs/tables/`
  - `outputs/figures/`
  - `outputs/models/` if modeling is used
  - `requirements/`
  - `Screenshots/`
- Keep `Writeup.pdf` or `Writeup.docx` in the capstone root when required by the course.
- This copied artifact package is the permanent site-facing capstone structure. Notebook runtime scratch files are acceptable only when the final required artifacts are exported back into the copied capstone `outputs/` folders with stable names.

### E) Page sections required
Each capstone page must include these sections in this order:
1. Intro or evidence-map summary block
2. Requirement Checklist
3. Requirement Walkthrough
4. Data and Artifact Links
5. Interactive Lab (only when the capstone uses TensorFlow and the lab is configured)
6. Colab Notebook
7. Execution Notes
8. Outputs and Results
9. Submission Evidence

## 1) Requirements Extraction Rules

1. Read the directions file line by line.
2. Convert every actionable instruction into a numbered requirement item.
3. Ignore pure headers, spacing, and decorative text.
4. If one paragraph contains multiple actions, split it into multiple requirement items.
5. Preserve the original order from the directions file exactly.
6. Report extraction counts:
   - total lines reviewed
   - total actionable requirements created

## 2) PHP Page Structure Rules

- Build one visible walkthrough block per requirement ID.
- Do not merge multiple requirement IDs into one walkthrough block.
- Use descriptive headings such as `1a - Load the dataset`.
- Immediately under each heading, show:
  - what this step does
  - which input files or fields are used
  - what output or artifact proves completion
- Use cards or sections consistent with the site layout already used in FrancisBurnetCom.
- Keep navigation, header, footer, typography, and styling inside the shared PHP framework. Do not build standalone page chrome per capstone.
- Use a custom include for each PDF-mapped capstone page so the page can hold real requirement arrays, walkthrough data, and artifact links without overloading the route file.
- Keep optional PDF items visible as their own requirement blocks. If the optional evidence is missing, say so explicitly; if it exists, present it as optional rather than folding it into a required deliverable.

## 3) Documentation Style Rules

For every requirement block:

### A) Pre-step explanation
- Keep it short and grading-friendly.
- State purpose, inputs, and expected output.

### B) Completion summary
- Confirm what happened.
- Include counts whenever rows, values, files, or artifacts changed.
- If nothing changed, say so explicitly.

### C) Evidence links
- Link directly to the notebook section artifact, exported table, figure, PDF, screenshot, or saved file that proves completion.

Requirements files should stay neutral.
Public capstone page copy should read naturally in first-person Francis Burnet voice and should not sound like internal planning notes or third-party review commentary.

## 4) PHP Framework Integration Rules

- Reuse `web/includes/config.php`, header, navigation, footer, and shared content styles.
- Escape displayed text with `htmlspecialchars`.
- Use relative URLs for site pages and artifacts.
- Do not hardcode machine-specific public URLs.
- Keep all deployable assets inside the FrancisBurnetCom root.
- Use the artifact helper functions for site links instead of hand-built filesystem paths in page markup.
- Artifact presentation should be view-first: browser viewer link first, direct download second.
- If a capstone needs dynamic interaction, use HTML forms that fit the current PHP layout.
- If a form submits values, validate on the server side before invoking any backend process.
- If a capstone uses TensorFlow concepts, an optional Interactive Lab section may be added between Data and Artifact Links and the Colab Notebook section.
- The first approved Interactive Lab is TensorFlow Playground, embedded through shared metadata so only TensorFlow-relevant pages render it.
- Treat the Interactive Lab as concept support only. The graded evidence remains the requirement walkthrough, notebook, saved artifacts, and screenshots.

## 5) Python and Notebook Integration Rules

- Python notebooks remain valid evidence and implementation artifacts.
- The PHP page does not replace the notebook; it organizes and presents it.
- When a notebook is structured in requirement order, begin the notebook with the source problem statement before the table of contents so the reader can see exactly where the numbered task list comes from.
- The preferred notebook opening order is: title, problem statement, table of contents, run guidance, then requirement-by-requirement sections.
- Do not introduce a requirement table of contents without first showing the originating problem statement or a faithful source-task block.
- Under the current deployment model, notebook inputs should come from approved GitHub-backed dataset URLs even though the PHP page itself links to copied capstone artifacts under `Incremental Capstones/`.
- If execution is needed, call only approved Python scripts or endpoints from the PHP layer.
- Until a safe backend controller exists, present execution as a documented placeholder rather than fake interactivity.
- Any script path shown on the site must resolve to a copied artifact under FrancisBurnetCom.
- Notebook previews on the site should use the artifact viewer in embed mode so the iframe shows notebook content instead of recursively embedding the full site shell.
- If a public notebook source URL is configured, include both `Launch Colab` and `View Notebook Source` actions in the page's notebook section.

## 6) Data Safety Rules

- Never silently drop rows or values.
- If rows are removed, report how many and why.
- Preserve raw columns when derived columns are created.
- Show before and after counts when cleaning or transforming data.
- Keep removed or rejected records in saved artifacts when required for traceability.

## 7) File Path Rules

- Never hardcode machine-specific source paths in rendered page content.
- Point the site to copied capstone assets under `Incremental Capstones/`.
- If an artifact is missing, show a clear placeholder note instead of a broken claim.
- Prefer links that are stable within the site root.

## 8) Output Rules

- Tables must have clear labels.
- Charts must include title, axis labels, units, and readable ticks.
- File export sections must print or display saved file names and relative locations.
- Use screenshots only after successful execution and give them ordered names.
- If an optional export is created, label it as optional in both the walkthrough and artifact links instead of presenting it as a required output.

## 9) Modeling Rules

If the capstone includes machine learning or deep learning:

- Show reproducible train/test logic and seed information.
- Explain metrics in plain language.
- Include a baseline when appropriate.
- State an explicit best-model selection if model comparison is part of the directions.
- If a final prediction helper exists, place it in the final page section only.

## 10) Final Interaction Rules

If the project requires a small prediction helper or user-input workflow:

- Put it in the final requirement-aligned section only.
- Use one clear input group per logical question.
- Validate every field.
- Echo submitted values back to the user before reporting results.
- Clearly separate automatically calculated values from user-entered values.

## 11) Submission Evidence Rules

- Keep the writeup concise and grading-friendly.
- Make every statement traceable to a requirement block, artifact, or notebook output.
- Maintain a `Screenshots/` folder with milestone evidence.
- Ensure the page, requirements document, writeup, screenshots, and artifacts all tell the same requirement-ordered story.

## 12) Build Sequence

1. Read the capstone directions file.
2. Extract requirements into `<project_name>_requirements.md` in strict order.
3. Map the copied capstone source folder and identify notebooks, datasets, PDFs, screenshots, and outputs.
4. Create or update the dedicated custom include for that capstone and keep the public route thin.
5. Render the page sections in requirement order.
6. Add view-first artifact links and evidence blocks.
7. If the capstone uses TensorFlow, add the optional Interactive Lab through shared metadata instead of page-specific markup.
8. Add the notebook preview and Colab/source actions when the notebook path is configured.
9. Add safe run controls only if a real backend path exists.
10. Verify the page inside the FrancisBurnetCom site.

## 13) Start Now

When building a capstone page:

1. Use the capstone directions file as the source of truth.
2. Use this PHP translation as the implementation standard.
3. Preserve strict requirement order across the page.
4. Make the result easy to grade, easy to navigate, and impossible to misinterpret.