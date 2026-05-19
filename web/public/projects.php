<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Projects';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';

function render_project_status_badge(string $status): string
{
    $normalizedStatus = strtolower(trim($status));

    if ($normalizedStatus === 'in planning') {
        return 'text-bg-warning';
    }

    if ($normalizedStatus === 'planned') {
        return 'text-bg-secondary';
    }

    return 'text-bg-dark';
}
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Projects Infographic';
    $heroCaption = 'Portfolio overview for published end-of-class projects, ordered to match the course sequence used on the capstone side of the site.';
    $heroImageAlt = 'Projects page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Projects</h2>
        <p>This section tracks the published end-of-class projects. The groups below follow the same course order as the incremental capstone hub so the site structure stays consistent as more projects are added.</p>

        <div class="alert alert-secondary mb-4" role="alert">
            Internal planning documents remain internal. This page only surfaces public-facing project placeholders and live project entries.
        </div>

        <?php foreach ($publishedProjectProgramGroups as $group): ?>
            <section id="<?php echo htmlspecialchars($group['anchor'], ENT_QUOTES, 'UTF-8'); ?>" class="mb-4 mb-lg-5">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-3">
                    <div>
                        <span class="artifact-label d-inline-block mb-2">Course Track</span>
                        <h3 class="h4 mb-2"><?php echo htmlspecialchars($group['label'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="text-secondary mb-0"><?php echo htmlspecialchars($group['summary'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="text-secondary small">
                        Source folder family: <?php echo htmlspecialchars($group['programFolder'], ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-2 g-3">
                    <?php foreach ($group['children'] as $project): ?>
                        <?php
                        $projectTitle = $project['publicTitle'] ?? $project['label'];
                        $statusClass = render_project_status_badge((string) ($project['status'] ?? 'Planned'));
                        ?>
                        <div class="col">
                            <article class="artifact-card p-3 h-100">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                    <div>
                                        <span class="artifact-label d-inline-block mb-2"><?php echo htmlspecialchars($project['programLabel'] ?? $group['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                                        <h4 class="h5 mb-1"><?php echo htmlspecialchars($projectTitle, ENT_QUOTES, 'UTF-8'); ?></h4>
                                        <p class="text-secondary mb-0 small"><?php echo htmlspecialchars($project['label'], ENT_QUOTES, 'UTF-8'); ?></p>
                                    </div>
                                    <span class="badge <?php echo htmlspecialchars($statusClass, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars((string) ($project['status'] ?? 'Planned'), ENT_QUOTES, 'UTF-8'); ?></span>
                                </div>

                                <p class="mb-3"><?php echo htmlspecialchars((string) ($project['summary'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>

                                <div class="d-flex flex-wrap gap-2">
                                    <?php if (!empty($project['available'])): ?>
                                        <a class="btn btn-primary btn-sm" href="<?php echo htmlspecialchars($project['href'], ENT_QUOTES, 'UTF-8'); ?>">Open Project</a>
                                    <?php else: ?>
                                        <a class="btn btn-outline-dark btn-sm" href="<?php echo htmlspecialchars($project['href'], ENT_QUOTES, 'UTF-8'); ?>">View Section</a>
                                        <span class="btn btn-outline-secondary btn-sm disabled" aria-disabled="true">Public Page Pending</span>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
