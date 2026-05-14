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

    <!-- ── Training Highlights ─────────────────────────────────────────────── -->
    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Training Highlights</h2>
        <p class="mb-4">Each capstone runs a real training pipeline — raw data, cleaned splits, model fit, evaluation, and exported artefacts. Below are the standout projects.</p>

        <div class="row g-3">

            <div class="col-md-6 col-lg-4">
                <div class="highlight-tile h-100 p-3 rounded-3">
                    <span class="highlight-badge">Deep Learning · Session 10</span>
                    <h3 class="h6 fw-bold mt-2 mb-1">3-Class Face Mask Detector</h3>
                    <p class="small mb-2">EfficientNetB0 and ResNet50 trained on 12,000+ images across three classes: <em>with_mask</em>, <em>without_mask</em>, <em>mask_worn_incorrect</em>. Model exported to TensorFlow.js and Teachable Machine — both run live in-browser.</p>
                    <div class="d-flex flex-wrap gap-1 mt-auto">
                        <a class="btn btn-sm btn-primary" href="capstone-session-10.php">View Capstone</a>
                        <a class="btn btn-sm btn-outline-primary" href="assets/demos/session-10-maskdetector.html" target="_blank">Live Demo ↗</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="highlight-tile h-100 p-3 rounded-3">
                    <span class="highlight-badge">Machine Learning · Session 5</span>
                    <h3 class="h6 fw-bold mt-2 mb-1">Bike Rental Demand Forecasting</h3>
                    <p class="small mb-2">Regression pipeline on UCI Bike Sharing dataset: feature engineering on weather/season/time variables, Random Forest + Linear Regression comparison, RMSE and R² evaluation.</p>
                    <div class="d-flex flex-wrap gap-1 mt-auto">
                        <a class="btn btn-sm btn-primary" href="capstone-session-5.php">View Capstone</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="highlight-tile h-100 p-3 rounded-3">
                    <span class="highlight-badge">Machine Learning · Session 6</span>
                    <h3 class="h6 fw-bold mt-2 mb-1">Adult Census Income Classifier</h3>
                    <p class="small mb-2">Binary classification on the UCI Adult Census dataset: encode + scale, train Decision Tree / Logistic Regression / Random Forest, ROC-AUC comparison, confusion matrix analysis.</p>
                    <div class="d-flex flex-wrap gap-1 mt-auto">
                        <a class="btn btn-sm btn-primary" href="capstone-session-6.php">View Capstone</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="highlight-tile h-100 p-3 rounded-3">
                    <span class="highlight-badge">ML · Unsupervised</span>
                    <h3 class="h6 fw-bold mt-2 mb-1">Mall Customer Segmentation</h3>
                    <p class="small mb-2">K-Means clustering on spending-score and income features. Elbow-method optimal-k selection, PCA 2D visualisation of cluster centroids, actionable segment labels.</p>
                    <div class="d-flex flex-wrap gap-1 mt-auto">
                        <a class="btn btn-sm btn-primary" href="capstone-session-8.php">View Capstone</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="highlight-tile h-100 p-3 rounded-3">
                    <span class="highlight-badge">ML · Association Rules</span>
                    <h3 class="h6 fw-bold mt-2 mb-1">Market Basket Analysis</h3>
                    <p class="small mb-2">Apriori algorithm on 7,500 retail transactions. Frequent itemset mining, confidence/lift-ranked association rules, actionable product-pairing insights.</p>
                    <div class="d-flex flex-wrap gap-1 mt-auto">
                        <a class="btn btn-sm btn-primary" href="capstone-session-9.php">View Capstone</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="highlight-tile h-100 p-3 rounded-3">
                    <span class="highlight-badge">Deep Learning</span>
                    <h3 class="h6 fw-bold mt-2 mb-1">MNIST Digit Recognition (CNN)</h3>
                    <p class="small mb-2">Convolutional Neural Network on 70,000 handwritten digits. Multiple conv/pool/dense configurations compared, training curves logged, test accuracy benchmarked against baseline MLP.</p>
                    <div class="d-flex flex-wrap gap-1 mt-auto">
                        <a class="btn btn-sm btn-primary" href="capstone-session-7.php">View Capstone</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ── Datasets on GitHub ──────────────────────────────────────────────── -->
    <section class="content-card p-4 p-lg-5 mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
            <h2 class="section-title mb-0">Datasets Hosted on GitHub</h2>
            <a class="btn btn-sm btn-outline-dark"
               href="https://github.com/FrancisBurnet/francisburnet/tree/main/Incremental%20Capstones"
               target="_blank" rel="noopener">Browse repo ↗</a>
        </div>
        <p class="mb-4">All datasets are version-controlled directly in the GitHub repo alongside their notebooks. Image data uses Git LFS — notebook clones pull full binary data automatically, no manual download step.</p>

        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Dataset</th>
                        <th>Rows / Size</th>
                        <th>Task</th>
                        <th>Capstone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>NSMES1988 (Health Survey)</strong></td>
                        <td>Multi-year survey · health + socioeconomic</td>
                        <td>EDA / Regression / Classification</td>
                        <td>Sessions 1–4 — Applied Data Science</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%201/NSMES1988.csv" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Florida Bike Rentals</strong></td>
                        <td>17,379 rows · weather + time features</td>
                        <td>Regression (Random Forest / Linear)</td>
                        <td>Session 5 — Machine Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%205/FloridaBikeRentals.csv" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Adult Census Income</strong></td>
                        <td>48,842 rows · 14 features</td>
                        <td>Binary Classification (DT / LR / RF)</td>
                        <td>Session 6 — Machine Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%206/adultcensusincome.csv" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Credit Card (CC General)</strong></td>
                        <td>Transactional · spending features</td>
                        <td>Clustering / Unsupervised (K-Means, PCA)</td>
                        <td>Session 7 — Machine Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%207/CC%20GENERAL.csv" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Movies &amp; Ratings</strong></td>
                        <td>User–item rating matrix</td>
                        <td>Collaborative Filtering / Recommendation</td>
                        <td>Session 8 — Machine Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/tree/main/Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%208" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Churn Modeling</strong></td>
                        <td>10,000 rows · customer demographics + account</td>
                        <td>Binary Classification (ANN)</td>
                        <td>Session 9 — Deep Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/blob/main/Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%209/Churn_Modeling.csv" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Face Mask Images</strong></td>
                        <td>~12,000 images · 3 classes · Git LFS</td>
                        <td>Image Classification (EfficientNetB0 / ResNet50)</td>
                        <td>Session 10 — Deep Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/tree/main/Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%2010" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                    <tr>
                        <td><strong>Grammar &amp; Product Reviews</strong></td>
                        <td>Text corpus · product review sentences</td>
                        <td>Sentiment Analysis (LSTM / NLP)</td>
                        <td>Session 11 — Deep Learning</td>
                        <td><a href="https://github.com/FrancisBurnet/francisburnet/tree/main/Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%2011" target="_blank" rel="noopener" class="btn btn-xs btn-link p-0">↗</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- ── Interactive Playgrounds ────────────────────────────────────────── -->
    <section class="content-card p-4 p-lg-5 mb-4">
        <h2 class="section-title">Interactive Playgrounds</h2>
        <p class="mb-4">Explore the models and tools that power this portfolio — directly in your browser, no install required.</p>

        <div class="row g-4 mb-4">
            <!-- Mask Detector Demo -->
            <div class="col-lg-6">
                <div class="playground-card h-100 p-3 rounded-3">
                    <div class="playground-icon">🎭</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">Face Mask Detector — Live</h3>
                    <p class="small mb-3">Upload an image or use your webcam to run the 3-class ResNet50 capstone model in real time — fully in-browser via TensorFlow.js. Classifies <em>with_mask</em>, <em>without_mask</em>, and <em>mask_worn_incorrect</em>.</p>
                    <a class="btn btn-primary btn-sm" href="assets/demos/session-10-maskdetector.html" target="_blank">Open Mask Demo ↗</a>
                </div>
            </div>
            <!-- TF Playground -->
            <div class="col-lg-6">
                <div class="playground-card h-100 p-3 rounded-3">
                    <div class="playground-icon">🔬</div>
                    <h3 class="h6 fw-bold mt-2 mb-1">TensorFlow Playground</h3>
                    <p class="small mb-3">Google's browser-based neural network sandbox. Adjust layers, activations, learning rate, and dataset interactively — watch the decision boundary form in real time. Embedded full-size below.</p>
                    <a class="btn btn-outline-secondary btn-sm"
                       href="https://playground.tensorflow.org/"
                       target="_blank" rel="noopener">Open TF Playground ↗</a>
                </div>
            </div>
        </div>

        <!-- TF Playground embed -->
        <div>
            <p class="small text-muted mb-2">TensorFlow Playground — embedded below. Use the controls inside the frame to experiment.</p>
            <div class="tf-playground-shell">
                <iframe
                    src="https://playground.tensorflow.org/"
                    class="tf-playground-frame"
                    title="TensorFlow Playground"
                    sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-top-navigation-by-user-activation"
                    loading="lazy"
                    scrolling="no"
                    allowfullscreen
                ></iframe>
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
