<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Incremental Capstone';
$currentSubPage = 'Capstone 2';
$capstoneProject = $capstoneProjects[1];
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php require __DIR__ . '/../includes/capstones/capstone-2-content.php'; ?>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>