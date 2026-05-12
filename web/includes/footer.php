<?php

declare(strict_types=1);

$legalItems = $legalItems ?? [];
$contactEmail = $contactEmail ?? 'capstone-team@example.com';
$contactLocation = $contactLocation ?? 'Classroom Demo Environment';
$pageScripts = $pageScripts ?? '';
?>
<footer class="footer-shell mt-5">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-6">
                <h2 class="footer-title">Contact Info</h2>
                <p class="mb-1">Email: <a href="mailto:<?php echo htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($contactEmail, ENT_QUOTES, 'UTF-8'); ?></a></p>
                <p class="mb-0">Location: <?php echo htmlspecialchars($contactLocation, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <div class="col-md-6">
                <h2 class="footer-title">Policy Links</h2>
                <ul class="policy-list mb-0">
                    <?php foreach ($legalItems as $item): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src="assets/js/main.js"></script>
<?php echo $pageScripts; ?>
</body>
</html>
