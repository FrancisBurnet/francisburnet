# Combined Capstone Submission

This folder consolidates all 4 capstones into one grading-ready package.

## Folder contents
- `00_capstone_all_in_one.ipynb` (single combined notebook for grading)
- `01_capstone_1.ipynb`
- `02_capstone_2.ipynb`
- `03_capstone_3.ipynb`
- `04_capstone_4.ipynb`
- `NSMES1988.csv` (original dataset)
- `prepare_dataset.py` (creates cleaned handoff dataset)
- `requirements.txt`
- `outputs/` (generated artifacts)

## Run order (recommended)
1. Install dependencies.
2. Run `prepare_dataset.py` to create `NSMES1988new.csv` from `NSMES1988.csv`.
3. Run `00_capstone_all_in_one.ipynb` from top to bottom.

## Local setup
```bash
pip install -r requirements.txt
python prepare_dataset.py
```

## Google Colab setup
1. Upload this entire folder (including `outputs/`) to Colab session storage or Google Drive.
2. In a notebook cell, run:
```python
!pip install -r requirements.txt
!python prepare_dataset.py
```
3. Open and run `00_capstone_all_in_one.ipynb` in sequence from top to bottom.

## Notes
- `prepare_dataset.py` writes the cleaned dataset as `NSMES1988new.csv` in this same folder.
- `02_capstone_2.ipynb` will generate `outputs/NSMES1988updated.csv`, which is then used by Capstones 3 and 4.
- The individual notebooks (`01` to `04`) are retained as source references; the combined notebook is the grading-ready submission artifact.
