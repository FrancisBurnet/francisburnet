# Dataset Credits and Terms of Use

## Capstone Session 10 — Face Mask Detection

This capstone uses a composite dataset assembled from the two open-source sources described below.

---

### Source 1 — Primary Dataset (with_mask / without_mask)

| Field | Value |
|---|---|
| **Title** | Face Mask Detection (12K images) |
| **Author** | Prajna Bhandary (chandrikadeb7) |
| **Repository** | https://github.com/chandrikadeb7/Face-Mask-Detection |
| **Kaggle mirror** | https://www.kaggle.com/datasets/ashishjangra27/face-mask-12k-images-dataset |
| **License** | MIT License |
| **Classes used** | `with_mask` (3,725 images), `without_mask` (3,828 images) |
| **Staged as** | `data/with_mask/`, `data/without_mask/` |

**MIT License notice:**
> Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files, to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software. The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

---

### Source 2 — Third Class (mask_weared_incorrect)

| Field | Value |
|---|---|
| **Title** | Face Mask Detection — Balanced 3-Class Dataset |
| **Author** | Vijay Kumar (vijaykumar1799) |
| **Kaggle URL** | https://www.kaggle.com/datasets/vijaykumar1799/face-mask-detection |
| **License** | CC0 1.0 Universal (Public Domain Dedication) |
| **Classes used** | `mask_weared_incorrect` (2,994 images) |
| **Staged as** | `data/mask_weared_incorrect/` |
| **Upstream sources** | Assembled from `ashishjangra27/face-mask-12k-images-dataset` and `andrewmvd/face-mask-detection`, both CC0 |

**CC0 1.0 notice:**
> The person who associated a work with this deed has dedicated the work to the public domain by waiving all of their rights to the work worldwide under copyright law, including all related and neighboring rights, to the extent allowed by law. You can copy, modify, distribute and perform the work, even for commercial purposes, all without asking permission.

---

## Composite Dataset — Face_mask_detection.zip

The file `Face_mask_detection.zip` committed to this repository is a composite of the two sources above, containing:

| Class folder | Image count | Source |
|---|---|---|
| `with_mask` | 3,725 | Source 1 (MIT) |
| `without_mask` | 3,828 | Source 1 (MIT) |
| `mask_weared_incorrect` | 2,994 | Source 2 (CC0) |
| **Total** | **10,547** | |

The composite ZIP is used solely for academic capstone purposes and is redistributed under the terms of the most restrictive applicable license (MIT). Attribution to both upstream authors is required when sharing or reproducing this composite.

---

## Usage Policy for This Project

1. The dataset is used exclusively for the Simplilearn Deep Learning Specialization Capstone Session 10 academic exercise.
2. No commercial use is made of the dataset images.
3. The `mask_weared_incorrect` images from Vijay Kumar's Kaggle dataset are CC0 and carry no additional restriction, but attribution is maintained here as a best practice.
4. The MIT-licensed images from Prajna Bhandary's repository require this attribution notice to accompany any distribution that includes those images.
5. The composite ZIP is committed to a private/educational GitHub repository (`FrancisBurnet/francisburnet`) solely to serve as a reproducible dataset source for the capstone notebook.

---

*Document created: 2026-05-13. Maintainer: Francis Burnet.*
