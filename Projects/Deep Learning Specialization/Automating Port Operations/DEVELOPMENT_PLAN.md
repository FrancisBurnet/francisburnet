# Automating Port Operations - Development Plan

## Purpose

This file is the planning source of truth for the first end-of-class project that will be published under the website Projects navigation.

Project type: Deep Learning Specialization end project
Website role: first published item under the top-level Projects page
Public interaction goal: browser-based vessel classifier with upload and phone-camera support

## Permanent Project Root

Keep the copied project materials in this folder:

`Projects/Deep Learning Specialization/Automating Port Operations/`

This folder is the permanent source root for the website-facing project package. The copied dataset, copied problem statement, notebook outputs, screenshots, writeup, and planning documents should all live under this root.

## Governing Documents

Use these rule documents together:

1. `X:\SIMPLILEARN\Project_DEV_Rules_PROMPT.md`
2. `X:\SIMPLILEARN\FrancisBurnetCom\PERMANANCE_RULES_PROMPT.md`
3. `X:\SIMPLILEARN\FrancisBurnetCom\docs\Project_DEV_Rules_PROMPT_PHP_TRANSLATION.md`

Rule application order for this project:

- The problem statement is the source of truth for project requirements.
- The project development rules govern the notebook and evidence package.
- The PHP translation governs the website implementation pattern.
- The permanence rules govern permanent file placement, deployment safety, and reproducibility.

## Source Inputs To Copy Here

Problem statement source:

`X:\SIMPLILEARN\MS_AI_Deep_Learning_Specialization\Course_End_Projects\1714053668_project_automating_port_operations.docx`

Dataset source:

`X:\SIMPLILEARN\MS_AI_Deep_Learning_Specialization\Course_End_Projects\Course_End_Project_Dataset\Automatic_Port_Operation`

These sources should be copied into this project root before website implementation begins.

## Intended Folder Structure

```text
Projects/
  Deep Learning Specialization/
    Automating Port Operations/
      DEVELOPMENT_PLAN.md
      1714053668_project_automating_port_operations.docx
      requirements/
        automating_port_operations_requirements.md
      data/
        boat_type_classification_dataset/
      notebooks/
        automating_port_operations_ordered_by_requirement.ipynb
      outputs/
        figures/
        tables/
        models/
        manifests/
      Screenshots/
      writeup/
        Writeup.pdf
```

## Assignment Snapshot

Current extracted assignment direction:

1. Build a custom CNN image classifier.
2. Build a transfer-learning image classifier using MobileNetV2.
3. Use the prescribed train/test split logic for each model.
4. Produce training graphs for loss and accuracy.
5. Produce evaluation outputs including accuracy, precision, recall, confusion matrix, and classification report.
6. Compare both models and identify the better deployment candidate.

## Current Dataset Reality

Observed class folders:

- `buoy`
- `cruise_ship`
- `ferry_boat`
- `freight_boat`
- `gondola`
- `inflatable_boat`
- `kayak`
- `paper_boat`
- `sailboat`

Observed class-count summary from the source dataset:

- `sailboat`: 389
- `kayak`: 203
- `gondola`: 193
- `cruise_ship`: 191
- `ferry_boat`: 63
- `buoy`: 53
- `paper_boat`: 31
- `freight_boat`: 23
- `inflatable_boat`: 16

Planning consequence:

- The public app must be described honestly as a vessel-type image classifier built from the provided course dataset.
- The public app must not be described as full port-scene object detection.
- Minority classes are likely to be weak in live camera conditions.
- `paper_boat` is an out-of-context class for real harbor scenes and must be acknowledged explicitly in the page copy or execution notes.

## Website Positioning Decision

This project is not being added to the incremental capstone registry.

This project will become:

- the first published item under the top-level `Projects` navigation link
- the template for future end-of-class project publishing
- a separate project-family pattern alongside the existing capstone pages

## Reusable Project Publishing Architecture

Future published projects should follow one clean parallel architecture instead of reusing the incremental-capstone registry.

### Content Root Pattern

- Keep all published end projects under `Projects/<Program Name>/<Project Name>/`.
- Keep each project self-contained with its copied directions, copied data, notebook evidence, outputs, screenshots, and writeup.
- Do not mix end projects into `Incremental Capstones/`.

### Website Pattern

- Use `web/public/projects.php` as the landing page for all published end projects.
- Add a shared end-project registry in `web/includes/config.php` separate from the capstone registry.
- Give each published project a thin public route in `web/public/`.
- Move each project body into a dedicated include under `web/includes/projects/`.

### Scaling Pattern

- The Projects landing page should group cards by program family.
- Each project card should be generated from shared metadata instead of hardcoded page markup.
- Shared project metadata should include label, public title, route, program family, source folder, summary, hero copy, and live-demo flags.
- Shared rendering helpers should be reused for artifact cards, notebook embeds, and viewer-first download links.

### Separation Rule

- Incremental capstones remain in the capstone architecture.
- End-of-class published projects use the Projects architecture.
- Shared site helpers may be reused, but registry structure, folder root, and landing-page flow should remain distinct.

## Scope Guardrails

The first live version should do the following:

1. Show the project overview, requirement checklist, walkthrough, notebook evidence, and saved artifacts.
2. Provide a real browser demo using sample images, file upload, and optional webcam access.
3. Run a browser-friendly exported model, most likely the MobileNetV2 deployment candidate.
4. Present the interaction as dominant-frame classification, not multi-object detection.

The first live version should not do the following:

1. Claim real-time port-operations automation beyond the course evidence.
2. Claim object detection, vessel tracking, or scene segmentation unless that is actually implemented.
3. Hide dataset imbalance or class mismatch issues.
4. Depend on local-only runtime paths in the public page.

## Recommended Build Sequence

### Phase 1 - Permanent Project Staging

1. Create the permanent project root under `Projects/Deep Learning Specialization/Automating Port Operations/`.
2. Copy the DOCX problem statement into the project root.
3. Copy the dataset into `data/boat_type_classification_dataset/`.
4. Keep this development plan updated when scope or implementation decisions change.

### Phase 2 - Requirements And Evidence Mapping

1. Extract the problem statement into a strict requirement checklist.
2. Save the checklist in `requirements/automating_port_operations_requirements.md`.
3. Map each requirement to notebook sections, outputs, screenshots, and page evidence blocks.

### Phase 3 - Notebook Execution Package

1. Build the notebook in requirement order.
2. Train the custom CNN.
3. Train the MobileNetV2 transfer-learning model.
4. Export plots, metrics tables, confusion matrix, classification report, and model comparison artifacts.
5. Save all final evidence into permanent project folders under this root.

### Phase 4 - Deployment Candidate Selection

1. Evaluate both trained models.
2. Select the better website deployment candidate.
3. Prefer the strongest browser-feasible model for TensorFlow.js export.
4. Preserve the full two-model comparison in notebook evidence even if only one model is deployed live.

### Phase 5 - Website Integration

1. Replace the placeholder content on `web/public/projects.php` with a real Projects landing page.
2. Add this project as the first published project card on that page.
3. Create a dedicated project route and a dedicated include for the body content.
4. Reuse the Session 10 mask-demo interaction pattern for camera and upload flows.
5. Link notebook, copied problem statement, screenshots, outputs, and model artifacts from the page.

### Phase 6 - Validation

1. Validate the project page locally at the Herd site.
2. Validate browser inference with sample images first.
3. Validate upload flow next.
4. Validate phone-camera behavior on a real HTTPS-reachable host.
5. Confirm the copied assets and page still work after restart and fresh checkout.

## Drift Guards

To avoid drift during implementation, keep these rules in force:

1. Do not create duplicate planning documents in other folders for this project.
2. Do not treat the original course folder as the live project root.
3. Do not implement website behavior before the copied source package exists here.
4. Do not change the public claim beyond what the dataset and trained model actually support.
5. Do not introduce browser-only or server-only fixes without storing them in permanent project files.
6. Do not allow notebook scratch outputs to become the only copy of required artifacts.
7. Do not switch the public project path once website wiring starts unless this document is updated first.

## Planned Naming And Routing

Working project title:

- `Automating Port Operations`

Working public positioning title:

- `Vessel Type Classifier for Port Operations`

Working slug candidates for later confirmation:

- `automating-port-operations.php`
- `project-automating-port-operations.php`
- `vessel-classifier-port-operations.php`

Do not finalize the public slug until the Projects landing-page pattern is approved.

## Immediate Next Actions

1. Copy the source DOCX and dataset into this project root.
2. Generate the requirements checklist from the copied problem statement.
3. Define the permanent notebook filename and output naming scheme.
4. Build the first version of the Projects landing page around this project as the lead entry.

## Change Log

- 2026-05-18: Created the permanent development-plan source file and fixed the intended project root for the first published Projects entry.