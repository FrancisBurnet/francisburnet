# Capstone PDF Audit

Audit date: 2026-05-11

Purpose: verify whether each FrancisBurnetCom capstone page is mapped from the copied assignment PDF or still using the generic placeholder implementation.

## Method

- Checked each public capstone route under `web/public/`.
- Confirmed whether the route uses a custom include or the shared generic include.
- Verified whether the copied capstone folder contains:
  - a session PDF
  - a requirements markdown file
  - a notebook file
- Extracted PDF text with `pypdf` and recorded a simple count of bullet-like task lines as a quick complexity signal.

## Status Summary

| Capstone | Route | Page status | PDF staged | Requirements file staged | Notebook staged | PDF task signal | Audit note |
| --- | --- | --- | --- | --- | --- | --- | --- |
| Capstone 1 | `capstone-1.php` | Custom PDF-mapped page | Yes | Yes | Yes | 17 bullet-like lines | Remapped against the PDF. Still missing a source-backed visual observations report section. |
| Capstone 2 | `capstone-2.php` | Generic placeholder page | Yes | No | Yes | 10 bullet-like lines | PDF tasks exist, but the website page is still generic and not requirement-mapped. |
| Capstone 3 | `capstone-3.php` | Generic placeholder page | Yes | No | Yes | 18 bullet-like lines | PDF tasks exist, but the website page is still generic and not requirement-mapped. |
| Capstone 4 | `capstone-4.php` | Generic placeholder page | Yes | No | Yes | 6 bullet-like lines | PDF tasks exist, but the website page is still generic and not requirement-mapped. |
| Capstone 5 | `capstone-session-5.php` | Generic placeholder page | Yes | No | No | 0 bullet-like lines in quick scan | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 6 | `capstone-session-6.php` | Generic placeholder page | Yes | No | No | 19 bullet-like lines | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 7 | `capstone-session-7.php` | Generic placeholder page | Yes | No | No | 0 bullet-like lines in quick scan | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 8 | `capstone-session-8.php` | Generic placeholder page | Yes | No | No | 9 bullet-like lines | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 9 | `capstone-session-9.php` | Generic placeholder page | Yes | No | No | 22 bullet-like lines | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 10 | `capstone-session-10.php` | Generic placeholder page | Yes | No | No | 26 bullet-like lines | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 11 | `capstone-session-11.php` | Generic placeholder page | Yes | No | No | 22 bullet-like lines | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |
| Capstone 12 | `capstone-session-12.php` | Generic placeholder page | Yes | No | No | 31 bullet-like lines | PDF tasks exist, but no staged requirements file or notebook is present in the live capstone folder. |

## Route Findings

- Only `capstone-1.php` loads a custom include: `web/includes/capstones/capstone-1-content.php`.
- Every remaining capstone route still loads `web/includes/capstone-page-content.php`.
- That shared include is a structural placeholder and does not render PDF-derived requirement items.

## Requirement Mapping Findings

- The original prompt and the PHP translation both require strict extraction from the directions file.
- Current implementation drift is therefore an execution issue, not a rules issue.
- Capstone 1 showed the pattern clearly: partial requirement mapping caused real PDF tasks to be merged or omitted until the PDF was re-read.
- The same risk should be assumed for Capstones 2 through 12 until each page is rebuilt from its own PDF.

## Content Gaps By Stage

- Capstones 2 through 12 need requirements extraction files generated from their PDFs.
- Capstones 2 through 12 need custom page content includes instead of the generic placeholder body.
- Capstones 5 through 12 also need staged notebook evidence copied into the live capstone folders if the notebook is meant to support the walkthrough.

## Recommended Remediation Order

1. Capstone 2
   - Small next step after Capstone 1 because the data lineage continues from `NSMES1988new.csv` and the PDF tasks are relatively compact.
2. Capstones 3 and 4
   - Same applied data science track and same source dataset family.
3. Capstones 5 through 8
   - Machine learning track; verify notebook availability before page implementation.
4. Capstones 9 through 12
   - Deep learning track; likely higher implementation effort and more artifact types.

## Working Rule Going Forward

- Treat each capstone PDF as the source of truth.
- Do not allow the generic page template or the implementation prompt to invent, merge, or suppress assignment requirements.
- If notebook or artifact evidence is missing for a real PDF requirement, show the requirement and mark the evidence gap explicitly.