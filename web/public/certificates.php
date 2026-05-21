<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Certificates';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

$certificateItems = [
    [
        'label' => 'Microsoft Certified AI Engineer (Certificate)',
        'href' => 'assets/certificates/Microsoft_Certified_AI_Engineer.pdf',
        'type' => 'PDF',
    ],
    [
        'label' => 'Microsoft Certified AI Engineer (Image)',
        'href' => 'assets/certificates/Microsoft_Certified_AI_Engineer.png',
        'type' => 'PNG',
    ],
    [
        'label' => 'Applied Data Science with Python',
        'href' => 'assets/certificates/Applied_Data_Science_with_Python.pdf',
        'type' => 'PDF',
    ],
    [
        'label' => 'Machine Learning Using Python',
        'href' => 'assets/certificates/Machine_Learning_Using_Python.pdf',
        'type' => 'PDF',
    ],
    [
        'label' => 'MS AI Python for AI',
        'href' => 'assets/certificates/MS AI Python for AI Certificate FVB.pdf',
        'type' => 'PDF',
    ],
    [
        'label' => 'Basics of Programming',
        'href' => 'assets/certificates/Basics Of Programming Certificate FVB.pdf',
        'type' => 'PDF',
    ],
    [
        'label' => 'Webinar Certificate',
        'href' => 'assets/certificates/Webinar Certificate_Template (49)-79.pdf',
        'type' => 'PDF',
    ],
];
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Certification Portfolio';
    $heroCaption = 'Verified course and program certificates for the Microsoft AI engineering learning path.';
    $heroImageAlt = 'Certificates page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Certificates</h2>
        <p>All certificates are embedded below for direct viewing. You can still open each file in a new tab when needed.</p>

        <div class="d-grid gap-4">
            <?php foreach ($certificateItems as $item): ?>
                <?php
                $href = $item['href'];
                $label = $item['label'];
                $type = strtoupper((string) $item['type']);
                $isPdf = $type === 'PDF';
                ?>
                <article class="border rounded-4 bg-white p-3 p-lg-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                        <h3 class="h5 mb-0"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></h3>
                        <div class="d-flex gap-2">
                            <span class="badge text-bg-light border"><?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?></span>
                            <a class="btn btn-sm btn-outline-primary" href="<?php echo htmlspecialchars($href, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer">Open in New Tab</a>
                        </div>
                    </div>

                    <?php if ($isPdf): ?>
                        <div class="ratio" style="--bs-aspect-ratio: 130%;">
                            <iframe
                                src="<?php echo htmlspecialchars($href . '#view=FitH', ENT_QUOTES, 'UTF-8'); ?>"
                                title="<?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>"
                                loading="lazy"
                                style="border: 1px solid #dee2e6; border-radius: 0.75rem; background: #fff;"
                            ></iframe>
                        </div>
                    <?php else: ?>
                        <img
                            src="<?php echo htmlspecialchars($href, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="<?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>"
                            class="img-fluid border rounded-3"
                            loading="lazy"
                        >
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
