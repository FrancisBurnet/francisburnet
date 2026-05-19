# Automating Port Operations Evidence Manifest

## Purpose

This manifest keeps the project outputs, evidence files, and visibility decisions pinned to named paths so the notebook, website page, and future deployment package do not drift apart.

## Project Root

`Projects/Deep Learning Specialization/Automating Port Operations/`

## Core Project Files

| Item | Path | Status | Visibility |
| --- | --- | --- | --- |
| Problem statement | `1714053668_project_automating_port_operations.docx` | staged | private until explicitly approved for public linking |
| Requirements checklist | `requirements/automating_port_operations_requirements.md` | created | public-safe project artifact |
| Ordered notebook | `notebooks/automating_port_operations_ordered_by_requirement.ipynb` | scaffolded | public-safe project artifact |
| Development plan | `DEVELOPMENT_PLAN.md` | created | internal only |

## Dataset Assets

| Item | Path | Status | Visibility |
| --- | --- | --- | --- |
| Boat image dataset root | `data/boat_type_classification_dataset/` | staged and verified | private until deployment scope is confirmed |
| Class folders | `data/boat_type_classification_dataset/<class_name>/` | staged and verified | private until deployment scope is confirmed |

## Notebook Evidence Targets

| Requirement | Planned output | Path | Status |
| --- | --- | --- | --- |
| 1a-1b | dataset inventory summary | `outputs/manifests/dataset_inventory.md` | created |
| 2a-2h | custom CNN training and evaluation evidence | `outputs/figures/custom_cnn_*.png` and `outputs/tables/custom_cnn_*.csv` | planned |
| 3a-3f | MobileNetV2 training and evaluation evidence | `outputs/figures/mobilenetv2_*.png` and `outputs/tables/mobilenetv2_*.csv` | planned |
| 4a | comparison summary | `outputs/tables/model_comparison.csv` and `outputs/figures/model_comparison.png` | planned |

## Model Artifact Targets

| Item | Path | Status | Visibility |
| --- | --- | --- | --- |
| Custom CNN saved model | `outputs/models/custom_cnn/` | planned | public only if selected for live demo |
| MobileNetV2 saved model | `outputs/models/mobilenetv2/` | planned | public-safe candidate |
| Browser export candidate | `outputs/models/tfjs/` | planned | public only after validation |

## Screenshot Targets

| Screenshot | Path | Status |
| --- | --- | --- |
| Dataset load and class counts | `Screenshots/01_dataset_load.png` | planned |
| Custom CNN training evidence | `Screenshots/02_custom_cnn_training.png` | planned |
| Transfer-learning training evidence | `Screenshots/03_transfer_learning_training.png` | planned |
| Model comparison evidence | `Screenshots/04_model_comparison.png` | planned |
| Final browser-demo evidence | `Screenshots/05_live_demo_validation.png` | planned |

## Writeup Target

| Item | Path | Status | Visibility |
| --- | --- | --- | --- |
| Project writeup | `writeup/Writeup.pdf` | planned | public-safe project artifact |

## Live Deployment Guard

Do not include these internal-only documents in any live deployment package:

- `DEVELOPMENT_PLAN.md`
- `PERMANANCE_RULES_PROMPT.md`
- `docs/Project_DEV_Rules_PROMPT_PHP_TRANSLATION.md`
- other internal planning or prompt/rules documents not intended as public-facing project evidence

## Notes

- The final live demo should expose only approved public artifacts.
- The problem statement and raw dataset remain staged here for project build continuity, but their public exposure must be decided deliberately rather than by default.
- The browser demo should be promoted only after the selected model passes local validation and phone-reachable HTTPS validation.