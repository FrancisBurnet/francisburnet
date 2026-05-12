<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Incremental Capstone';
$currentSubPage = 'Capstone 4';
$capstoneProject = $capstoneProjects[3];
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php require __DIR__ . '/../includes/capstones/capstone-4-content.php'; ?>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>