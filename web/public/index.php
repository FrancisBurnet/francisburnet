<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Home';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">

    <section class="content-card p-4 p-lg-5 mb-4 text-center">
        <img
            src="assets/images/fb-logo-long-dark.png"
            alt="Francis Burnet – AI Engineering Portfolio"
            class="home-hero-logo mb-4"
        >
        <p class="lead mb-0" style="max-width:52rem;margin:0 auto;">A production-facing portfolio that transforms class capstones into live, reviewable AI workflows across data science, machine learning, and deep learning.</p>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Built From Scratch — Full-Stack AI Portfolio</h2>
        <p class="mb-4">Every layer of this site was designed and engineered custom — from the server infrastructure and PHP application layer to the front-end styling, AI model hosting, and CI/CD-style deploy pipeline. There is no CMS, no page builder, and no third-party template.</p>

        <div class="row g-3">

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">🖥️</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Server &amp; Hosting</h3>
                    <ul class="stack-list mb-0">
                        <li>Plesk on Linux VPS</li>
                        <li>PHP 8.x via FastCGI</li>
                        <li>SFTP + SSH deploy pipeline</li>
                        <li>Laravel Herd (local dev)</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">⚙️</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Back-End</h3>
                    <ul class="stack-list mb-0">
                        <li>PHP — custom MVC-style routing</li>
                        <li>JSON-driven result feeds</li>
                        <li>Dynamic includes architecture</li>
                        <li>Per-capstone content modules</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">🎨</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Front-End &amp; Branding</h3>
                    <ul class="stack-list mb-0">
                        <li>Bootstrap 5 (custom-configured)</li>
                        <li>Hand-authored CSS design system</li>
                        <li>Custom FB logo + monogram</li>
                        <li>Responsive across all breakpoints</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">🤖</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">AI &amp; ML Layer</h3>
                    <ul class="stack-list mb-0">
                        <li>Python / TensorFlow / Keras</li>
                        <li>TensorFlow.js (in-browser inference)</li>
                        <li>Teachable Machine integration</li>
                        <li>Jupyter notebooks (Colab-ready)</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">🗂️</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Data &amp; Storage</h3>
                    <ul class="stack-list mb-0">
                        <li>Git LFS for large datasets</li>
                        <li>CSV / image / JSON datasets</li>
                        <li>GitHub as source-of-truth</li>
                        <li>Exported model artefacts on-server</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">🚀</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Deploy &amp; DevOps</h3>
                    <ul class="stack-list mb-0">
                        <li>PowerShell build + zip pipeline</li>
                        <li>Posh-SSH SFTP upload</li>
                        <li>SSH unzip-to-docroot on server</li>
                        <li>Git versioned every release</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">📓</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Notebooks &amp; Science</h3>
                    <ul class="stack-list mb-0">
                        <li>pandas, NumPy, scikit-learn</li>
                        <li>Matplotlib / Seaborn</li>
                        <li>EfficientNet, ResNet50, LSTM</li>
                        <li>K-Means, PCA, Market Basket</li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="stack-tile h-100 p-3 rounded-3">
                    <div class="stack-tile-icon">🛠️</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Toolchain</h3>
                    <ul class="stack-list mb-0">
                        <li>VS Code + GitHub Copilot</li>
                        <li>Google Colab (GPU training)</li>
                        <li>Python venv (3.12, local CPU)</li>
                        <li>PowerShell 7 + Posh-SSH</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">What This Portfolio Does</h2>
        <div class="row g-3 mt-1">
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Explain</h3>
                    <p class="mb-0">Each page explains objective, source data, and requirement coverage in grading-first structure.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Run</h3>
                    <p class="mb-0">Notebooks and live demos let visitors inspect the actual model outputs, not just screenshots.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 h-100">
                    <h3 class="h5">Visualize</h3>
                    <p class="mb-0">Results render as charts, metrics, downloadable artifacts, and linked capstone materials.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Quick Launch</h2>
        <p>Use these entry points to explore the incremental capstone portfolio.</p>
        <div class="d-flex flex-wrap gap-2">
            <a class="btn btn-primary" href="incremental-capstone.php">Open Incremental Capstone Hub</a>
            <a class="btn btn-outline-dark" href="projects.php">Open Projects</a>
            <a class="btn btn-outline-secondary" href="about.php">Read About</a>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
