from __future__ import annotations

import json
import sys
from dataclasses import dataclass
from pathlib import Path

import nbformat as nbf
import numpy as np
import pandas as pd
from nbconvert.preprocessors import ExecutePreprocessor


ROOT = Path(__file__).resolve().parents[1]


@dataclass(frozen=True)
class CapstonePaths:
    root: Path
    requirements: Path
    notebook: Path
    outputs: Path
    plots: Path


def ensure_dirs(*paths: Path) -> None:
    for path in paths:
        path.mkdir(parents=True, exist_ok=True)


def build_session_5_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Machine Learning Using Python" / "Capstone Session 5"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        requirements=root / "requirements" / "capstone_session_5_requirements.md",
        notebook=root / "capstone_session_5.ipynb",
        outputs=outputs,
        plots=plots,
    )


def build_session_6_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Machine Learning Using Python" / "Capstone Session 6"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        requirements=root / "requirements" / "capstone_session_6_requirements.md",
        notebook=root / "capstone_session_6.ipynb",
        outputs=outputs,
        plots=plots,
    )


def build_session_7_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Machine Learning Using Python" / "Capstone Session 7"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        requirements=root / "requirements" / "capstone_session_7_requirements.md",
        notebook=root / "capstone_session_7.ipynb",
        outputs=outputs,
        plots=plots,
    )


def build_session_8_paths() -> CapstonePaths:
    root = ROOT / "Incremental Capstones" / "Machine Learning Using Python" / "Capstone Session 8"
    outputs = root / "outputs"
    plots = outputs / "plots"
    return CapstonePaths(
        root=root,
        requirements=root / "requirements" / "capstone_session_8_requirements.md",
        notebook=root / "capstone_session_8.ipynb",
        outputs=outputs,
        plots=plots,
    )


def write_and_execute_notebook(paths: CapstonePaths, notebook: nbf.NotebookNode) -> None:
    ensure_dirs(paths.outputs, paths.plots)

    notebook.metadata["kernelspec"] = {
        "display_name": "Python 3",
        "language": "python",
        "name": "python3",
    }
    notebook.metadata["language_info"] = {
        "name": "python",
        "version": f"{sys.version_info.major}.{sys.version_info.minor}.{sys.version_info.micro}",
    }

    with paths.notebook.open("w", encoding="utf-8") as handle:
        nbf.write(notebook, handle)

    executor = ExecutePreprocessor(timeout=1200, kernel_name="python3")
    executor.preprocess(notebook, {"metadata": {"path": str(paths.root)}})

    with paths.notebook.open("w", encoding="utf-8") as handle:
        nbf.write(notebook, handle)


def write_session_5_notebook(paths: CapstonePaths) -> None:
    ensure_dirs(paths.outputs, paths.plots)

    notebook = nbf.v4.new_notebook()

    dataset_path = paths.root / "FloridaBikeRentals.csv"
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 5\n\n"
            "This notebook is generated from the copied `Capstone_Session_5.pdf` task list and the staged `FloridaBikeRentals.csv` dataset. "
            "It follows the same requirement-first workflow used across the FrancisBurnet capstone site."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Predict hourly bike rental demand and compare Linear Regression, Lasso Regression, and Ridge Regression using the required preprocessing and exploratory analysis steps."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "from IPython.display import display\n"
            "from sklearn.compose import ColumnTransformer\n"
            "from sklearn.linear_model import Lasso, LinearRegression, Ridge\n"
            "from sklearn.metrics import mean_absolute_error, mean_squared_error, r2_score\n"
            "from sklearn.model_selection import train_test_split\n"
            "from sklearn.pipeline import Pipeline\n"
            "from sklearn.preprocessing import OneHotEncoder, StandardScaler\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "DATASET_PATH = BASE_DIR / 'FloridaBikeRentals.csv'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')\n"
            "pd.set_option('display.max_columns', 100)"
        ),
        nbf.v4.new_markdown_cell("## Load and audit the staged dataset"),
        nbf.v4.new_code_cell(
            "df = pd.read_csv(DATASET_PATH, encoding='latin1')\n"
            "df.columns = [column.replace('�', '°').strip() for column in df.columns]\n"
            "display(df.head())\n"
            "print('Shape:', df.shape)\n"
            "print('Columns:', df.columns.tolist())\n"
            "null_counts = df.isna().sum().sort_values(ascending=False)\n"
            "display(null_counts[null_counts > 0])"
        ),
        nbf.v4.new_markdown_cell("## Feature engineering from the required date column"),
        nbf.v4.new_code_cell(
            "df['Date'] = pd.to_datetime(df['Date'], dayfirst=True)\n"
            "df['day'] = df['Date'].dt.day\n"
            "df['month'] = df['Date'].dt.month\n"
            "df['day_of_week'] = df['Date'].dt.day_name()\n"
            "df['is_weekend'] = df['Date'].dt.dayofweek >= 5\n"
            "display(df[['Date', 'day', 'month', 'day_of_week', 'is_weekend']].head())"
        ),
        nbf.v4.new_markdown_cell("## Required exploratory analysis plots"),
        nbf.v4.new_code_cell(
            "numeric_df = df.select_dtypes(include=['number']).copy()\n"
            "fig, ax = plt.subplots(figsize=(12, 8))\n"
            "sns.heatmap(numeric_df.corr(numeric_only=True), cmap='coolwarm', center=0, ax=ax)\n"
            "ax.set_title('Feature Correlation Heatmap')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'correlation_heatmap.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "sns.histplot(df['Rented Bike Count'], kde=True, ax=ax)\n"
            "ax.set_title('Distribution of Rented Bike Count')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'rented_bike_count_distribution.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "fig = df.select_dtypes(include=['number']).hist(figsize=(16, 14), bins=30)\n"
            "plt.tight_layout()\n"
            "plt.savefig(PLOTS_DIR / 'numeric_feature_histograms.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close('all')"
        ),
        nbf.v4.new_code_cell(
            "for column in ['Seasons', 'Holiday', 'Functioning Day']:\n"
            "    fig, ax = plt.subplots(figsize=(10, 5))\n"
            "    sns.boxplot(data=df, x=column, y='Rented Bike Count', ax=ax)\n"
            "    ax.set_title(f'Rented Bike Count by {column}')\n"
            "    ax.tick_params(axis='x', rotation=20)\n"
            "    fig.tight_layout()\n"
            "    safe_name = column.lower().replace(' ', '_')\n"
            "    fig.savefig(PLOTS_DIR / f'boxplot_{safe_name}.png', dpi=150)\n"
            "    plt.show()\n"
            "    plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "catplot_specs = [\n"
            "    ('Hour', 'hour'),\n"
            "    ('Holiday', 'holiday'),\n"
            "    ('Rainfall(mm)', 'rainfall'),\n"
            "    ('Snowfall (cm)', 'snowfall'),\n"
            "    ('day_of_week', 'day_of_week'),\n"
            "    ('is_weekend', 'is_weekend'),\n"
            "]\n"
            "inferences = []\n"
            "for column, slug in catplot_specs:\n"
            "    fig, ax = plt.subplots(figsize=(12, 5))\n"
            "    grouped = df.groupby(column, dropna=False)['Rented Bike Count'].mean().sort_values(ascending=False)\n"
            "    sns.barplot(x=grouped.index.astype(str), y=grouped.values, ax=ax)\n"
            "    ax.set_title(f'Mean Rented Bike Count by {column}')\n"
            "    ax.tick_params(axis='x', rotation=30)\n"
            "    fig.tight_layout()\n"
            "    fig.savefig(PLOTS_DIR / f'catplot_{slug}.png', dpi=150)\n"
            "    plt.show()\n"
            "    plt.close(fig)\n"
            "    inferences.append({\n"
            "        'feature': column,\n"
            "        'highest_mean_group': str(grouped.index[0]),\n"
            "        'highest_mean_value': round(float(grouped.iloc[0]), 3),\n"
            "        'lowest_mean_group': str(grouped.index[-1]),\n"
            "        'lowest_mean_value': round(float(grouped.iloc[-1]), 3),\n"
            "    })\n"
            "display(pd.DataFrame(inferences))"
        ),
        nbf.v4.new_markdown_cell(
            "## Modeling\n\n"
            "The PDF requires `get_dummies()`, an 80:20 split with `random_state=1`, standard scaling, and comparison of Linear Regression, Lasso Regression, and Ridge Regression. "
            "The PDF does not specify regularization strengths, so the notebook uses sklearn defaults for Lasso and Ridge and records that choice in the summary output."
        ),
        nbf.v4.new_code_cell(
            "target = 'Rented Bike Count'\n"
            "feature_df = df.drop(columns=['Date'])\n"
            "X = feature_df.drop(columns=[target])\n"
            "y = feature_df[target]\n"
            "categorical_columns = X.select_dtypes(include=['object', 'bool']).columns.tolist()\n"
            "numeric_columns = [column for column in X.columns if column not in categorical_columns]\n"
            "\n"
            "preprocessor = ColumnTransformer(\n"
            "    transformers=[\n"
            "        ('num', StandardScaler(), numeric_columns),\n"
            "        ('cat', OneHotEncoder(handle_unknown='ignore'), categorical_columns),\n"
            "    ]\n"
            ")\n"
            "\n"
            "X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=1)\n"
            "print('Train shape:', X_train.shape, 'Test shape:', X_test.shape)\n"
            "encoded_preview = pd.get_dummies(X, columns=categorical_columns, drop_first=False)\n"
            "display(encoded_preview.head())"
        ),
        nbf.v4.new_code_cell(
            "models = {\n"
            "    'Linear Regression': LinearRegression(),\n"
            "    'Lasso Regression': Lasso(),\n"
            "    'Ridge Regression': Ridge(),\n"
            "}\n"
            "\n"
            "results = []\n"
            "prediction_frames = []\n"
            "for name, estimator in models.items():\n"
            "    pipeline = Pipeline([('preprocessor', preprocessor), ('model', estimator)])\n"
            "    pipeline.fit(X_train, y_train)\n"
            "    predictions = pipeline.predict(X_test)\n"
            "    rmse = float(np.sqrt(mean_squared_error(y_test, predictions)))\n"
            "    mae = float(mean_absolute_error(y_test, predictions))\n"
            "    r2 = float(r2_score(y_test, predictions))\n"
            "    results.append({'model': name, 'rmse': rmse, 'mae': mae, 'r2': r2})\n"
            "    prediction_frames.append(pd.DataFrame({\n"
            "        'model': name,\n"
            "        'actual': y_test.reset_index(drop=True),\n"
            "        'predicted': pd.Series(predictions),\n"
            "    }).head(25))\n"
            "\n"
            "results_df = pd.DataFrame(results).sort_values('rmse').reset_index(drop=True)\n"
            "display(results_df)\n"
            "best_model = results_df.iloc[0].to_dict()\n"
            "print('Best model by RMSE:', best_model['model'])"
        ),
        nbf.v4.new_code_cell(
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "results_df.plot(x='model', y=['rmse', 'mae'], kind='bar', ax=ax)\n"
            "ax.set_title('Model Error Comparison')\n"
            "ax.set_ylabel('Error')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'model_error_comparison.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "\n"
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "results_df.plot(x='model', y='r2', kind='bar', color='teal', ax=ax)\n"
            "ax.set_title('Model R2 Comparison')\n"
            "ax.set_ylabel('R2 Score')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'model_r2_comparison.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "results_df.to_csv(OUTPUTS_DIR / 'session_5_model_metrics.csv', index=False)\n"
            "pd.concat(prediction_frames, ignore_index=True).to_csv(OUTPUTS_DIR / 'session_5_prediction_samples.csv', index=False)\n"
            "summary = {\n"
            "    'dataset_shape': list(df.shape),\n"
            "    'train_rows': int(X_train.shape[0]),\n"
            "    'test_rows': int(X_test.shape[0]),\n"
            "    'target': target,\n"
            "    'categorical_columns': categorical_columns,\n"
            "    'numeric_columns': numeric_columns,\n"
            "    'model_results': results,\n"
            "    'best_model': best_model,\n"
            "    'catplot_inferences': inferences,\n"
            "    'notes': [\n"
            "        'Categorical features are encoded with pd.get_dummies() preview and pipeline one-hot encoding for model training.',\n"
            "        'Lasso and Ridge use sklearn default alpha values because the PDF does not specify hyperparameters.',\n"
            "    ],\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_5_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
        nbf.v4.new_markdown_cell(
            "## Conclusion\n\n"
            "This notebook stages the required exploratory analysis, encoding preview, model comparison, and saved artifacts for the website workflow. "
            "The plot files and summary outputs in `outputs/` are the evidence layer the custom Session 5 page can surface next."
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def write_session_6_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 6\n\n"
            "This notebook is generated from the copied `Capstone_Session_6.pdf` directions and the staged `adultcensusincome.csv` dataset."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Build and compare classification models for Adult Census income prediction while preserving the PDF-ordered exploratory, preprocessing, imbalance, and evaluation flow."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "from IPython.display import display\n"
            "from imblearn.over_sampling import RandomOverSampler\n"
            "from sklearn.ensemble import RandomForestClassifier\n"
            "from sklearn.linear_model import LogisticRegression\n"
            "from sklearn.metrics import accuracy_score, f1_score\n"
            "from sklearn.model_selection import train_test_split\n"
            "from sklearn.naive_bayes import GaussianNB\n"
            "from sklearn.neighbors import KNeighborsClassifier\n"
            "from sklearn.preprocessing import LabelEncoder, StandardScaler\n"
            "from sklearn.svm import SVC\n"
            "from sklearn.tree import DecisionTreeClassifier\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "DATASET_PATH = BASE_DIR / 'adultcensusincome.csv'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')\n"
            "pd.set_option('display.max_columns', 100)"
        ),
        nbf.v4.new_code_cell(
            "df = pd.read_csv(DATASET_PATH)\n"
            "display(df.head())\n"
            "print('Shape:', df.shape)\n"
            "object_columns = df.select_dtypes(include=['object', 'string']).columns.tolist()\n"
            "question_mark_counts = {column: int((df[column].astype(str).str.strip() == '?').sum()) for column in object_columns}\n"
            "print('Question mark counts:', question_mark_counts)"
        ),
        nbf.v4.new_code_cell(
            "df = df.replace(' ?', np.nan).replace('?', np.nan)\n"
            "for column in object_columns:\n"
            "    if df[column].isna().any():\n"
            "        df[column] = df[column].fillna(df[column].mode().iloc[0])\n"
            "for column in df.columns:\n"
            "    if df[column].isna().any():\n"
            "        df[column] = df[column].fillna(df[column].median())\n"
            "print('Remaining null values:', int(df.isna().sum().sum()))"
        ),
        nbf.v4.new_code_cell(
            "fig, ax = plt.subplots(figsize=(8, 5))\n"
            "income_counts = df['income'].value_counts()\n"
            "sns.barplot(x=income_counts.index, y=income_counts.values, ax=ax)\n"
            "ax.set_title('Income Distribution')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'income_barplot.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "balance_summary = {\n"
            "    'class_counts': income_counts.to_dict(),\n"
            "    'minority_ratio': round(float(income_counts.min() / income_counts.max()), 4),\n"
            "}\n"
            "balance_summary"
        ),
        nbf.v4.new_code_cell(
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "sns.histplot(df['age'], kde=True, ax=ax)\n"
            "ax.set_title('Age Distribution')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'age_distribution.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "\n"
            "for column in ['education', 'education.num']:\n"
            "    fig, ax = plt.subplots(figsize=(12, 5))\n"
            "    counts = df[column].value_counts().sort_values(ascending=False).head(15) if column == 'education' else df[column].value_counts().sort_index()\n"
            "    sns.barplot(x=counts.index.astype(str), y=counts.values, ax=ax)\n"
            "    ax.set_title(f'{column} Barplot')\n"
            "    ax.tick_params(axis='x', rotation=35)\n"
            "    fig.tight_layout()\n"
            "    fig.savefig(PLOTS_DIR / f'{column.replace('.', '_')}_barplot.png', dpi=150)\n"
            "    plt.show()\n"
            "    plt.close(fig)\n"
            "\n"
            "marital_counts = df['marital.status'].value_counts()\n"
            "fig, ax = plt.subplots(figsize=(8, 8))\n"
            "ax.pie(marital_counts.values, labels=marital_counts.index, autopct='%1.1f%%', startangle=90)\n"
            "ax.set_title('Marital Status Distribution')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'marital_status_pie.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "df['age_band'] = pd.cut(df['age'], bins=[16, 25, 35, 45, 55, 65, 100], include_lowest=True)\n"
            "for column in ['age_band', 'education', 'marital.status', 'sex']:\n"
            "    fig, ax = plt.subplots(figsize=(12, 5))\n"
            "    grouped = pd.crosstab(df[column], df['income'])\n"
            "    grouped.plot(kind='bar', stacked=False, ax=ax)\n"
            "    ax.set_title(f'Income Count by {column}')\n"
            "    ax.tick_params(axis='x', rotation=35)\n"
            "    fig.tight_layout()\n"
            "    fig.savefig(PLOTS_DIR / f'income_by_{str(column).replace('.', '_')}.png', dpi=150)\n"
            "    plt.show()\n"
            "    plt.close(fig)"
        ),
        nbf.v4.new_code_cell(
            "encoded_df = df.copy()\n"
            "label_encoders = {}\n"
            "for column in encoded_df.select_dtypes(include=['object', 'string', 'category']).columns:\n"
            "    encoder = LabelEncoder()\n"
            "    encoded_df[column] = encoder.fit_transform(encoded_df[column].astype(str))\n"
            "    label_encoders[column] = encoder\n"
            "\n"
            "fig, ax = plt.subplots(figsize=(12, 8))\n"
            "sns.heatmap(encoded_df.corr(numeric_only=True), cmap='viridis', ax=ax)\n"
            "ax.set_title('Encoded Feature Correlation Heatmap')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'correlation_heatmap.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "correlation_to_income = encoded_df.corr(numeric_only=True)['income'].sort_values(ascending=False).to_dict()\n"
            "correlation_to_income"
        ),
        nbf.v4.new_code_cell(
            "X = encoded_df.drop(columns=['income'])\n"
            "y = encoded_df['income']\n"
            "X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42, stratify=y)\n"
            "scaler = StandardScaler()\n"
            "X_train_scaled = scaler.fit_transform(X_train)\n"
            "X_test_scaled = scaler.transform(X_test)\n"
            "sampler = RandomOverSampler(random_state=42)\n"
            "X_train_balanced, y_train_balanced = sampler.fit_resample(X_train_scaled, y_train)\n"
            "print('Balanced train distribution:', pd.Series(y_train_balanced).value_counts().to_dict())"
        ),
        nbf.v4.new_code_cell(
            "models = {\n"
            "    'Logistic Regression': LogisticRegression(max_iter=1000),\n"
            "    'KNN Classifier': KNeighborsClassifier(),\n"
            "    'SVM Classifier': SVC(),\n"
            "    'Naive Bayes Classifier': GaussianNB(),\n"
            "    'Decision Tree Classifier': DecisionTreeClassifier(random_state=42),\n"
            "    'Random Forest Classifier': RandomForestClassifier(random_state=42, n_estimators=200),\n"
            "}\n"
            "results = []\n"
            "for name, model in models.items():\n"
            "    model.fit(X_train_balanced, y_train_balanced)\n"
            "    predictions = model.predict(X_test_scaled)\n"
            "    results.append({\n"
            "        'model': name,\n"
            "        'accuracy': float(accuracy_score(y_test, predictions)),\n"
            "        'f1_score': float(f1_score(y_test, predictions)),\n"
            "    })\n"
            "results_df = pd.DataFrame(results).sort_values(['f1_score', 'accuracy'], ascending=False).reset_index(drop=True)\n"
            "display(results_df)\n"
            "best_model = results_df.iloc[0].to_dict()\n"
            "best_model"
        ),
        nbf.v4.new_code_cell(
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "results_df.plot(x='model', y=['accuracy', 'f1_score'], kind='bar', ax=ax)\n"
            "ax.set_title('Session 6 Model Comparison')\n"
            "ax.set_ylim(0, 1.05)\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'model_comparison.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "results_df.to_csv(OUTPUTS_DIR / 'session_6_model_metrics.csv', index=False)\n"
            "summary = {\n"
            "    'dataset_shape': list(df.shape),\n"
            "    'question_mark_counts_before_cleaning': question_mark_counts,\n"
            "    'balance_summary': balance_summary,\n"
            "    'balanced_train_distribution': pd.Series(y_train_balanced).value_counts().to_dict(),\n"
            "    'correlation_to_income': correlation_to_income,\n"
            "    'model_results': results,\n"
            "    'best_model': best_model,\n"
            "    'notes': [\n"
            "        'RandomOverSampler is used as the explicit imbalance-fix technique from the PDF options.',\n"
            "        'The split is stratified to preserve the original class ratio before balancing the training data.',\n"
            "    ],\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_6_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def write_session_7_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 7\n\n"
            "This notebook is generated from the copied `Capstone_Session_7.pdf` directions and the staged `CC GENERAL.csv` dataset."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Cluster credit card users using PCA and K-means while preserving the requirement order from the copied PDF."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "from IPython.display import display\n"
            "from sklearn.cluster import KMeans\n"
            "from sklearn.decomposition import PCA\n"
            "from sklearn.preprocessing import StandardScaler\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "DATASET_PATH = BASE_DIR / 'CC GENERAL.csv'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')\n"
            "pd.set_option('display.max_columns', 100)"
        ),
        nbf.v4.new_code_cell(
            "df = pd.read_csv(DATASET_PATH)\n"
            "display(df.head())\n"
            "print('Shape:', df.shape)\n"
            "print(df.isna().sum().sort_values(ascending=False).head())"
        ),
        nbf.v4.new_code_cell(
            "working_df = df.drop(columns=['CUST_ID']).copy()\n"
            "for column in working_df.columns:\n"
            "    if working_df[column].isna().any():\n"
            "        working_df[column] = working_df[column].fillna(working_df[column].median())\n"
            "print('Remaining null values:', int(working_df.isna().sum().sum()))"
        ),
        nbf.v4.new_code_cell(
            "scaler = StandardScaler()\n"
            "scaled = scaler.fit_transform(working_df)\n"
            "pca_full = PCA()\n"
            "pca_full.fit(scaled)\n"
            "explained = np.cumsum(pca_full.explained_variance_ratio_)\n"
            "components_needed = int(np.argmax(explained >= 0.85) + 1)\n"
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "ax.plot(range(1, len(explained) + 1), explained, marker='o')\n"
            "ax.axhline(0.85, color='red', linestyle='--')\n"
            "ax.axvline(components_needed, color='green', linestyle='--')\n"
            "ax.set_title('PCA Cumulative Explained Variance')\n"
            "ax.set_xlabel('Components')\n"
            "ax.set_ylabel('Cumulative Explained Variance')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'pca_explained_variance.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "components_needed"
        ),
        nbf.v4.new_code_cell(
            "pca_two = PCA(n_components=2, random_state=42)\n"
            "pca_features = pca_two.fit_transform(scaled)\n"
            "covariance = pd.DataFrame(pca_full.get_covariance(), index=working_df.columns, columns=working_df.columns)\n"
            "covariance.to_csv(OUTPUTS_DIR / 'session_7_covariance_matrix.csv')\n"
            "upper_triangle = covariance.where(np.triu(np.ones(covariance.shape), k=1).astype(bool))\n"
            "top_pair = upper_triangle.stack().abs().sort_values(ascending=False).index[0]\n"
            "{'top_covariance_pair': top_pair, 'value': float(covariance.loc[top_pair[0], top_pair[1]])}"
        ),
        nbf.v4.new_code_cell(
            "cluster_range = list(range(2, 12))\n"
            "inertias = []\n"
            "for n_clusters in cluster_range:\n"
            "    model = KMeans(n_clusters=n_clusters, random_state=42, n_init=20)\n"
            "    model.fit(pca_features)\n"
            "    inertias.append(float(model.inertia_))\n"
            "\n"
            "x = np.array(cluster_range)\n"
            "y = np.array(inertias)\n"
            "line_start = np.array([x[0], y[0]])\n"
            "line_end = np.array([x[-1], y[-1]])\n"
            "line_vector = line_end - line_start\n"
            "line_vector = line_vector / np.linalg.norm(line_vector)\n"
            "points = np.column_stack([x, y])\n"
            "distances = []\n"
            "for point in points:\n"
            "    vector = point - line_start\n"
            "    projection = line_start + np.dot(vector, line_vector) * line_vector\n"
            "    distances.append(np.linalg.norm(point - projection))\n"
            "ideal_clusters = int(x[int(np.argmax(distances))])\n"
            "\n"
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "ax.plot(cluster_range, inertias, marker='o')\n"
            "ax.axvline(ideal_clusters, color='red', linestyle='--')\n"
            "ax.set_title('KMeans Elbow Curve')\n"
            "ax.set_xlabel('Number of clusters')\n"
            "ax.set_ylabel('Inertia')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'kmeans_elbow.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "ideal_clusters"
        ),
        nbf.v4.new_code_cell(
            "final_model = KMeans(n_clusters=ideal_clusters, random_state=42, n_init=20)\n"
            "clusters = final_model.fit_predict(pca_features)\n"
            "cluster_df = pd.DataFrame({'pca_1': pca_features[:, 0], 'pca_2': pca_features[:, 1], 'cluster': clusters})\n"
            "fig, ax = plt.subplots(figsize=(10, 6))\n"
            "sns.scatterplot(data=cluster_df, x='pca_1', y='pca_2', hue='cluster', palette='tab10', ax=ax)\n"
            "ax.set_title('KMeans Clusters on 2-Component PCA Space')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'cluster_scatter.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "cluster_sizes = cluster_df['cluster'].value_counts().sort_index().to_dict()\n"
            "cluster_df.head()"
        ),
        nbf.v4.new_code_cell(
            "cluster_df.to_csv(OUTPUTS_DIR / 'session_7_cluster_assignments.csv', index=False)\n"
            "summary = {\n"
            "    'dataset_shape': list(df.shape),\n"
            "    'filled_missing_values': {'MINIMUM_PAYMENTS': int(df['MINIMUM_PAYMENTS'].isna().sum()), 'CREDIT_LIMIT': int(df['CREDIT_LIMIT'].isna().sum())},\n"
            "    'components_for_85_percent_variance': components_needed,\n"
            "    'top_covariance_pair': {'columns': list(top_pair), 'value': float(covariance.loc[top_pair[0], top_pair[1]])},\n"
            "    'cluster_range': cluster_range,\n"
            "    'inertias': inertias,\n"
            "    'ideal_clusters': ideal_clusters,\n"
            "    'cluster_sizes': cluster_sizes,\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_7_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def write_session_8_notebook(paths: CapstonePaths) -> None:
    notebook = nbf.v4.new_notebook()
    outputs_path = paths.outputs.as_posix()
    plots_path = paths.plots.as_posix()

    notebook.cells = [
        nbf.v4.new_markdown_cell(
            "# Capstone Session 8\n\n"
            "This notebook is generated from the copied `Capstone_Session_8.pdf` directions and the staged `movies.csv` and `ratings.csv` datasets."
        ),
        nbf.v4.new_markdown_cell(
            "## Objective\n\n"
            "Demonstrate user-based, item-based, and model-based recommendation techniques using the staged movie ratings data."
        ),
        nbf.v4.new_markdown_cell(
            "## Environment Note\n\n"
            "The PDF names `KNNBasic`, `SVD`, and `NMF`, which are commonly run through `scikit-surprise`. That package cannot be built in this Python 3.12 Windows environment without Microsoft C++ Build Tools, so the notebook records a compatible fallback: a manual KNN/MSD recommender plus `TruncatedSVD` and `NMF` cross-validation over the same staged ratings matrix."
        ),
        nbf.v4.new_code_cell(
            "from pathlib import Path\n"
            "import json\n"
            "\n"
            "import matplotlib.pyplot as plt\n"
            "import numpy as np\n"
            "import pandas as pd\n"
            "import seaborn as sns\n"
            "from IPython.display import display\n"
            "from sklearn.decomposition import NMF, TruncatedSVD\n"
            "from sklearn.metrics import mean_squared_error\n"
            "from sklearn.metrics.pairwise import pairwise_distances\n"
            "from sklearn.model_selection import KFold\n"
            "\n"
            "BASE_DIR = Path(r'''" + paths.root.as_posix() + "''')\n"
            "MOVIES_PATH = BASE_DIR / 'movies.csv'\n"
            "RATINGS_PATH = BASE_DIR / 'ratings.csv'\n"
            "OUTPUTS_DIR = Path(r'''" + outputs_path + "''')\n"
            "PLOTS_DIR = Path(r'''" + plots_path + "''')\n"
            "OUTPUTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "PLOTS_DIR.mkdir(parents=True, exist_ok=True)\n"
            "sns.set_theme(style='whitegrid')\n"
            "pd.set_option('display.max_columns', 100)"
        ),
        nbf.v4.new_code_cell(
            "movies = pd.read_csv(MOVIES_PATH)\n"
            "ratings = pd.read_csv(RATINGS_PATH)\n"
            "merged = ratings.merge(movies[['movieId', 'title']], on='movieId', how='left')\n"
            "user_item = merged.pivot_table(index='userId', columns='title', values='rating')\n"
            "display(merged.head())\n"
            "print('Movies shape:', movies.shape)\n"
            "print('Ratings shape:', ratings.shape)\n"
            "print('User-item shape:', user_item.shape)"
        ),
        nbf.v4.new_code_cell(
            "user_filled = user_item.apply(lambda row: row.fillna(row.mean()), axis=1)\n"
            "user_corr = user_filled.T.corr()\n"
            "user_1_corr = user_corr.loc[1].drop(index=1).dropna().sort_values(ascending=False)\n"
            "top_50_users = user_1_corr.head(50)\n"
            "movie_32_title = movies.loc[movies['movieId'] == 32, 'title'].iloc[0]\n"
            "movie_32_ratings = merged.loc[merged['movieId'] == 32, ['userId', 'rating']].set_index('userId')\n"
            "eligible = top_50_users[top_50_users.index.isin(movie_32_ratings.index)]\n"
            "if eligible.empty:\n"
            "    predicted_user_1_rating = float(merged.loc[merged['movieId'] == 32, 'rating'].mean())\n"
            "else:\n"
            "    weighted_ratings = movie_32_ratings.loc[eligible.index, 'rating']\n"
            "    denominator = float(np.abs(eligible).sum())\n"
            "    predicted_user_1_rating = float(np.dot(eligible.values, weighted_ratings.values) / denominator) if denominator else float(weighted_ratings.mean())\n"
            "\n"
            "top_50_df = top_50_users.reset_index()\n"
            "top_50_df.columns = ['userId', 'correlation']\n"
            "top_50_df.to_csv(OUTPUTS_DIR / 'session_8_top_50_user_correlations.csv', index=False)\n"
            "display(top_50_df.head(10))\n"
            "{'movieId_32_title': movie_32_title, 'predicted_user_1_rating_for_movie_32': round(predicted_user_1_rating, 4)}"
        ),
        nbf.v4.new_code_cell(
            "item_filled = user_item.apply(lambda column: column.fillna(column.mean()), axis=0)\n"
            "movie_corr = item_filled.corr()\n"
            "jurassic_title = 'Jurassic Park (1993)'\n"
            "jurassic_similar = movie_corr[jurassic_title].drop(index=jurassic_title).dropna().sort_values(ascending=False).head(10)\n"
            "similar_movies_df = jurassic_similar.reset_index()\n"
            "similar_movies_df.columns = ['title', 'correlation']\n"
            "similar_movies_df.to_csv(OUTPUTS_DIR / 'session_8_similar_movies.csv', index=False)\n"
            "display(similar_movies_df)"
        ),
        nbf.v4.new_code_cell(
            "all_user_ids = sorted(ratings['userId'].unique())\n"
            "all_movie_ids = sorted(ratings['movieId'].unique())\n"
            "user_index = {user_id: idx for idx, user_id in enumerate(all_user_ids)}\n"
            "movie_index = {movie_id: idx for idx, movie_id in enumerate(all_movie_ids)}\n"
            "global_mean = float(ratings['rating'].mean())\n"
            "\n"
            "def build_train_matrix(train_df):\n"
            "    return train_df.pivot(index='userId', columns='movieId', values='rating').reindex(index=all_user_ids, columns=all_movie_ids)\n"
            "\n"
            "def predict_knn_msd(train_df, test_df, neighbors=20):\n"
            "    train_matrix = build_train_matrix(train_df)\n"
            "    user_means = train_matrix.mean(axis=1).fillna(global_mean)\n"
            "    filled = train_matrix.apply(lambda row: row.fillna(user_means.loc[row.name]), axis=1)\n"
            "    msd = pairwise_distances(filled, metric='sqeuclidean') / filled.shape[1]\n"
            "    similarity = 1 / (1 + msd)\n"
            "    predictions = []\n"
            "    for row in test_df.itertuples(index=False):\n"
            "        user_id = int(row.userId)\n"
            "        movie_id = int(row.movieId)\n"
            "        uidx = user_index[user_id]\n"
            "        midx = movie_index[movie_id]\n"
            "        movie_ratings = train_matrix.iloc[:, midx]\n"
            "        rated_mask = movie_ratings.notna().to_numpy(copy=True)\n"
            "        rated_mask[uidx] = False\n"
            "        if not rated_mask.any():\n"
            "            predictions.append(global_mean)\n"
            "            continue\n"
            "        neighbor_scores = similarity[uidx, rated_mask]\n"
            "        neighbor_ratings = movie_ratings[rated_mask].to_numpy(dtype=float)\n"
            "        if neighbor_scores.size > neighbors:\n"
            "            top_idx = np.argsort(neighbor_scores)[-neighbors:]\n"
            "            neighbor_scores = neighbor_scores[top_idx]\n"
            "            neighbor_ratings = neighbor_ratings[top_idx]\n"
            "        denominator = float(np.abs(neighbor_scores).sum())\n"
            "        if denominator == 0:\n"
            "            predictions.append(float(np.nanmean(neighbor_ratings)))\n"
            "        else:\n"
            "            predictions.append(float(np.dot(neighbor_scores, neighbor_ratings) / denominator))\n"
            "    return np.clip(np.array(predictions), 0.5, 5.0)\n"
            "\n"
            "def predict_svd(train_df, test_df, n_components=20):\n"
            "    train_matrix = build_train_matrix(train_df)\n"
            "    user_means = train_matrix.mean(axis=1).fillna(global_mean)\n"
            "    filled = train_matrix.apply(lambda row: row.fillna(user_means.loc[row.name]), axis=1)\n"
            "    model = TruncatedSVD(n_components=n_components, random_state=42)\n"
            "    latent = model.fit_transform(filled)\n"
            "    reconstructed = latent @ model.components_\n"
            "    predictions = []\n"
            "    for row in test_df.itertuples(index=False):\n"
            "        predictions.append(float(reconstructed[user_index[int(row.userId)], movie_index[int(row.movieId)]]))\n"
            "    return np.clip(np.array(predictions), 0.5, 5.0)\n"
            "\n"
            "def predict_nmf(train_df, test_df, n_components=20):\n"
            "    train_matrix = build_train_matrix(train_df)\n"
            "    user_means = train_matrix.mean(axis=1).fillna(global_mean)\n"
            "    filled = train_matrix.apply(lambda row: row.fillna(user_means.loc[row.name]), axis=1)\n"
            "    model = NMF(n_components=n_components, init='nndsvda', random_state=42, max_iter=300)\n"
            "    W = model.fit_transform(filled)\n"
            "    H = model.components_\n"
            "    reconstructed = W @ H\n"
            "    predictions = []\n"
            "    for row in test_df.itertuples(index=False):\n"
            "        predictions.append(float(reconstructed[user_index[int(row.userId)], movie_index[int(row.movieId)]]))\n"
            "    return np.clip(np.array(predictions), 0.5, 5.0)"
        ),
        nbf.v4.new_code_cell(
            "kf = KFold(n_splits=5, shuffle=True, random_state=42)\n"
            "fold_records = []\n"
            "for fold, (train_idx, test_idx) in enumerate(kf.split(ratings), start=1):\n"
            "    train_df = ratings.iloc[train_idx][['userId', 'movieId', 'rating']]\n"
            "    test_df = ratings.iloc[test_idx][['userId', 'movieId', 'rating']]\n"
            "\n"
            "    knn_predictions = predict_knn_msd(train_df, test_df, neighbors=20)\n"
            "    svd_predictions = predict_svd(train_df, test_df, n_components=20)\n"
            "    nmf_predictions = predict_nmf(train_df, test_df, n_components=20)\n"
            "\n"
            "    fold_records.extend([\n"
            "        {'fold': fold, 'model': 'KNNBasic-style MSD', 'rmse': float(np.sqrt(mean_squared_error(test_df['rating'], knn_predictions))), 'parameters': 'neighbors=20, similarity=msd'},\n"
            "        {'fold': fold, 'model': 'SVD', 'rmse': float(np.sqrt(mean_squared_error(test_df['rating'], svd_predictions))), 'parameters': 'n_components=20'},\n"
            "        {'fold': fold, 'model': 'NMF', 'rmse': float(np.sqrt(mean_squared_error(test_df['rating'], nmf_predictions))), 'parameters': 'n_components=20'},\n"
            "    ])\n"
            "\n"
            "fold_results = pd.DataFrame(fold_records)\n"
            "display(fold_results.head(9))\n"
            "summary_results = fold_results.groupby(['model', 'parameters'], as_index=False)['rmse'].mean().sort_values('rmse').reset_index(drop=True)\n"
            "display(summary_results)\n"
            "best_model = summary_results.iloc[0].to_dict()\n"
            "best_model"
        ),
        nbf.v4.new_code_cell(
            "fig, ax = plt.subplots(figsize=(10, 5))\n"
            "summary_results.plot(x='model', y='rmse', kind='bar', ax=ax, color=['#1f77b4', '#ff7f0e', '#2ca02c'])\n"
            "ax.set_title('Session 8 Model-Based RMSE Comparison')\n"
            "ax.set_ylabel('Average 5-Fold RMSE')\n"
            "fig.tight_layout()\n"
            "fig.savefig(PLOTS_DIR / 'model_based_rmse.png', dpi=150)\n"
            "plt.show()\n"
            "plt.close(fig)\n"
            "\n"
            "fold_results.to_csv(OUTPUTS_DIR / 'session_8_model_cv_results.csv', index=False)\n"
            "summary = {\n"
            "    'movie_id_32_title': movie_32_title,\n"
            "    'predicted_user_1_rating_for_movie_32': round(predicted_user_1_rating, 4),\n"
            "    'top_50_user_correlations_saved': 'session_8_top_50_user_correlations.csv',\n"
            "    'similar_movies_for_jurassic_park': similar_movies_df.to_dict(orient='records'),\n"
            "    'model_cv_results': summary_results.to_dict(orient='records'),\n"
            "    'best_model': best_model,\n"
            "    'environment_note': 'scikit-surprise could not be installed because Microsoft Visual C++ Build Tools are missing in this Windows Python 3.12 environment.',\n"
            "}\n"
            "with open(OUTPUTS_DIR / 'session_8_summary.json', 'w', encoding='utf-8') as handle:\n"
            "    json.dump(summary, handle, indent=2)\n"
            "summary"
        ),
    ]

    write_and_execute_notebook(paths, notebook)


def main() -> int:
    if len(sys.argv) != 2:
        print("Usage: generate_capstone_artifacts.py session-5|session-6|session-7|session-8")
        return 1

    target = sys.argv[1].strip().lower()
    if target == "session-5":
        paths = build_session_5_paths()
        write_session_5_notebook(paths)
    elif target == "session-6":
        paths = build_session_6_paths()
        write_session_6_notebook(paths)
    elif target == "session-7":
        paths = build_session_7_paths()
        write_session_7_notebook(paths)
    elif target == "session-8":
        paths = build_session_8_paths()
        write_session_8_notebook(paths)
    else:
        print(f"Unsupported target: {target}")
        return 1

    print(f"Generated {paths.notebook}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())