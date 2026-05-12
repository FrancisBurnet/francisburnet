from pathlib import Path
import pandas as pd

BASE_DIR = Path(__file__).resolve().parent
INPUT_FILE = BASE_DIR / "NSMES1988.csv"
OUTPUT_FILE = BASE_DIR / "NSMES1988new.csv"


def clean_nsmes_dataframe(df: pd.DataFrame) -> pd.DataFrame:
    cleaned = df.copy()

    cleaned.columns = [column.strip() for column in cleaned.columns]

    object_columns = cleaned.select_dtypes(include=["object", "string", "str"]).columns
    for column in object_columns:
        cleaned[column] = cleaned[column].astype(str).str.strip()
        cleaned[column] = cleaned[column].replace({"": pd.NA, "nan": pd.NA, "None": pd.NA})

    cleaned = cleaned.drop_duplicates().reset_index(drop=True)

    return cleaned


def main() -> None:
    if not INPUT_FILE.exists():
        raise FileNotFoundError(f"Input dataset not found: {INPUT_FILE}")

    df = pd.read_csv(INPUT_FILE)
    cleaned_df = clean_nsmes_dataframe(df)

    cleaned_df.to_csv(OUTPUT_FILE, index=False)

    print(f"Input rows: {len(df):,}")
    print(f"Output rows: {len(cleaned_df):,}")
    print(f"Columns: {len(cleaned_df.columns):,}")
    print(f"Saved cleaned dataset to: {OUTPUT_FILE}")


if __name__ == "__main__":
    main()
