<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Incremental Capstone';
$currentSubPage = 'Capstone 5';
$capstoneProject = $capstoneProjects[4];
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php require __DIR__ . '/../includes/capstones/capstone-session-5-content.php'; ?>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>