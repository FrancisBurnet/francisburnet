<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Contact';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Contact Infographic';
    $heroCaption = 'Class and collaboration contact pathways for this capstone platform.';
    $heroImageAlt = 'Contact page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Contact Info</h2>
        <p>Use this section to publish class-safe contact details for feedback and collaboration requests.</p>
        <ul>
            <li>Email: <?php echo htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></li>
            <li>Location: <?php echo htmlspecialchars($contactLocation, ENT_QUOTES, 'UTF-8'); ?></li>
        </ul>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
