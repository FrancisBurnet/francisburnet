<?php

declare(strict_types=1);

$navItems = $navItems ?? [];
$currentPage = $currentPage ?? '';
$currentSubPage = $currentSubPage ?? '';
?>
<nav class="navbar navbar-expand-lg nav-shell sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php foreach ($navItems as $item): ?>
                    <?php
                    $hasChildren = !empty($item['children']);
                    $childActive = false;
                    $childrenAreGrouped = $hasChildren && isset($item['children'][0]['children']);
                    if ($hasChildren) {
                        foreach ($item['children'] as $child) {
                            if ($childrenAreGrouped) {
                                foreach ($child['children'] as $grandchild) {
                                    if (strcasecmp($currentSubPage, $grandchild['label']) === 0) {
                                        $childActive = true;
                                        break 2;
                                    }
                                }
                            } elseif (strcasecmp($currentSubPage, $child['label']) === 0) {
                                $childActive = true;
                                break;
                            }
                        }
                    }
                    $active = strcasecmp($currentPage, $item['label']) === 0 || $childActive ? 'active' : '';
                    ?>
                    <?php if ($hasChildren): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo $active; ?>" href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">All Capstones</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <?php foreach ($item['children'] as $child): ?>
                                    <?php if ($childrenAreGrouped): ?>
                                        <li><h6 class="dropdown-header"><?php echo htmlspecialchars($child['label'], ENT_QUOTES, 'UTF-8'); ?></h6></li>
                                        <li>
                                            <a class="dropdown-item" href="<?php echo htmlspecialchars($item['href'] . '#' . $child['anchor'], ENT_QUOTES, 'UTF-8'); ?>">
                                                View <?php echo htmlspecialchars($child['label'], ENT_QUOTES, 'UTF-8'); ?>
                                            </a>
                                        </li>
                                        <?php foreach ($child['children'] as $grandchild): ?>
                                            <?php $childItemActive = strcasecmp($currentSubPage, $grandchild['label']) === 0 ? 'active' : ''; ?>
                                            <li>
                                                <a class="dropdown-item <?php echo $childItemActive; ?>" href="<?php echo htmlspecialchars($grandchild['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                                    <?php echo htmlspecialchars($grandchild['label'], ENT_QUOTES, 'UTF-8'); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                        <li><hr class="dropdown-divider"></li>
                                    <?php else: ?>
                                        <?php $childItemActive = strcasecmp($currentSubPage, $child['label']) === 0 ? 'active' : ''; ?>
                                        <li>
                                            <a class="dropdown-item <?php echo $childItemActive; ?>" href="<?php echo htmlspecialchars($child['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <?php echo htmlspecialchars($child['label'], ENT_QUOTES, 'UTF-8'); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $active; ?>" href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
