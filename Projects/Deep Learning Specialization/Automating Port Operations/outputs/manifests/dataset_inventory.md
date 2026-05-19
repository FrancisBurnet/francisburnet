# Dataset Inventory

## Requirement Coverage

- Supports requirement `1a` by confirming the staged dataset root and class folders.
- Supports requirement `1b` by pinning the intended loader configuration before notebook execution.

## Staged Dataset Root

`data/boat_type_classification_dataset/`

## Class Inventory

| Class | Image Count |
| --- | ---: |
| `buoy` | 53 |
| `cruise_ship` | 191 |
| `ferry_boat` | 63 |
| `freight_boat` | 23 |
| `gondola` | 193 |
| `inflatable_boat` | 16 |
| `kayak` | 203 |
| `paper_boat` | 31 |
| `sailboat` | 389 |

## Dataset Totals

- Total images: `1162`
- File extension counts:
  - `.jpg`: `1162`

## Loading Specification For Requirement 1b

The source project directions specify this initial loading configuration:

- Loader: `tf.keras.preprocessing.image_dataset_from_directory`
- Normalization: scale pixel values with `1./255`
- Batch size: `32`

This inventory does not execute the loader yet. It pins the staged dataset path and confirms the expected class distribution before the requirement-ordered notebook implementation begins.

## Notes

- The staged dataset copy under `Projects/Deep Learning Specialization/Automating Port Operations/` is now the working project source for this end-project package.
- The class imbalance remains material and should be discussed later in the notebook and public execution notes.
- `paper_boat` remains an out-of-context class for real harbor scenes and must be handled honestly in the final public positioning.