<?php
require_once __DIR__ . '/../includes/config.php';
$contactEmail = $contactEmail ?? 'hello@francisburnet.com';
$contactLinkedInUrl = $contactLinkedInUrl ?? 'https://linkedin.com/in/francisburnet';
$contactLinkedInLabel = $contactLinkedInLabel ?? 'linkedin.com/in/francisburnet';
$contactMailingAddress = $contactMailingAddress ?? 'PO Box 1381, Bellmawr, NJ 08099';
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
        <p>Contact details for collaboration and project inquiries.</p>
        <ul>
            <li>Email: <?php echo htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></li>
            <li>LinkedIn: <a href="<?php echo htmlspecialchars($contactLinkedInUrl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noreferrer"><?php echo htmlspecialchars($contactLinkedInLabel, ENT_QUOTES, 'UTF-8'); ?></a></li>
            <li>Mailing Address: <?php echo htmlspecialchars($contactMailingAddress, ENT_QUOTES, 'UTF-8'); ?></li>
        </ul>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
