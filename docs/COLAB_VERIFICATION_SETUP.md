# Colab Notebook Setup

This document describes the current implementation path for the live Colab notebook that accompanies Capstone 1.

## Goal

Present a public Colab notebook for Capstone 1 that:

1. opens directly from the FrancisBurnet project source,
2. downloads the matching dataset and artifacts from the live FrancisBurnet site,
3. runs the same published workflow as the capstone materials, and
4. stays aligned with the files hosted in the repository and on the site.

## Current Repository Target

- Source-control repository: `https://github.com/FrancisBurnet/francisburnet`
- Branch: `main`
- Notebook path: `Incremental Capstones/Applied Data Science with Python/Capstone 1/capstone_1_colab_verification.ipynb`

## Recommended Publishing Model

- Keep the main repository in source control.
- Publish the notebook from a public repository when anonymous Colab access is required.
- Datasets used by the Colab notebooks may also be pulled from a small public GitHub repository on the FrancisBurnet account when that makes the Colab flow simpler.
- Keep the live FrancisBurnet site as the canonical HTTPS source for datasets, notebooks, and exported artifacts.

## Current Live Colab Wiring

- Default notebook source URL:
  - `https://github.com/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%201/capstone_1_colab_verification.ipynb`
- Default Colab launch URL:
  - `https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%201/capstone_1_colab_verification.ipynb`

## Capstone 1 Assets Already Prepared

- Site page: `web/public/capstone-1.php`
- Custom page content: `web/includes/capstones/capstone-1-content.php`
- Colab notebook artifact:
  - `Incremental Capstones/Applied Data Science with Python/Capstone 1/capstone_1_colab_verification.ipynb`

## Live Environment Variables

Set these environment variables in the live environment only if you need to override the source-controlled defaults:

- `COLAB_CAPSTONE_1_LAUNCH_URL`
  - Example: the final `Open in Colab` URL that points to the public notebook entry.
- `COLAB_CAPSTONE_1_NOTEBOOK_SOURCE_URL`
  - Example: the public GitHub notebook URL for the published source notebook.
- `COLAB_CAPSTONE_1_DATASET_MIRROR_URL` (optional)
  - Use only if you also publish a small public dataset mirror repository.

## Public Flow

1. Open Capstone 1 on the live site.
2. Open the `Colab Notebook` section for the live notebook and artifact URLs.
3. Click `Open in Colab` once the launch URL is configured.
4. Run all cells.
5. Confirm the notebook completes with the expected published outputs.

## Notes

- The Colab notebook template should default to `https://francisburnet.com` as the canonical site base.
- If a public dataset repository is used, document that repository on the project page so the published Colab flow stays easy to understand.
- The site artifact URLs remain the source of truth even if a public notebook repository is introduced.