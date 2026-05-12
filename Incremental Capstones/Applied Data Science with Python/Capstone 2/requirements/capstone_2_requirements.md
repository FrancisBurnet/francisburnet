# Capstone 2 Requirements

Source directions file: `Capstone_Session_2.pdf`
Reference notebook used for evidence mapping: `capstone_2.ipynb`

## 1. Data Processing and Statistical Analysis
Source of truth: PDF task bullets on pages 7 and 8

1a. Import relevant Python libraries.
Status: Supported by notebook setup/import cells that load `Path`, `datetime`, `display`, and `pandas` for runtime setup and dataframe analysis.

1b. Import the CSV file `NSMES1988new.csv` into a dataframe.
Status: Supported by the copied notebook load step and dataset preview.

1c. Perform memory analysis of the new dataframe and compare it with the memory of the dataframe in the previous week and mark your comments.
Status: Supported by the copied notebook memory comparison against the Capstone 1 memory reference.

1d. Perform the following operations on age and income columns: multiply age by 10 and income by 10000.
Status: Supported by the copied notebook through scaled analysis columns `age_years` and `income_dollars`, which preserve the raw source fields while exposing real-world units.

1e. Perform basic statistical analysis on the new dataframe and generate a brief report on the outcome.
Status: Supported by the copied notebook descriptive summary tables and the written interpretation captured in the markdown report cell.

1f. Save the dataframe as `NSMES1988updated.csv` file in the local space for possible future use.
Status: Supported by the copied notebook export step and the staged output artifact `outputs/NSMES1988updated.csv`.

1g. Invoke `describe` command on the dataframe and compare that with the basic statistical analysis done in the previous step.
Status: Supported by the copied notebook `describe(include="all")` output and the comparison narrative in the following markdown cell.

1h. Indicate which of the columns are not eligible for statistical analysis and indicate possible datatype changes, and report.
Status: Supported by the copied notebook recommendation table for categorical fields and downcast candidates.

1i. Make changes to the recommended file from the previous step and export it as a new `.csv` file for possible future use. Optional.
Status: Supported by the staged optional follow-on artifact `outputs/NSMES1988optimized_optional.csv`, which preserves the optional export as a separate file from the required handoff CSV.

1j. Prepare a brief report and enter it in the markup cells of the JupyterLab notebook.
Status: Supported by the copied notebook markdown commentary for the statistical analysis and final conclusions sections.

## Requirements Extraction Counts
- PDF pages reviewed for actionable task extraction: 2
- Actionable requirement items extracted from the copied Capstone 2 directions file: 10
- Required items with direct staged notebook or artifact evidence: 9
- Optional item now staged as its own artifact: 1 (`1i` optional follow-on CSV export)