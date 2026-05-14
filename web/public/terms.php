<?php
require_once __DIR__ . '/../includes/config.php';
$currentPage = 'Terms of Use';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main class="container py-5">
    <?php
    $heroTitle = 'Terms of Use Infographic';
    $heroCaption = 'Acceptable-use and system safety constraints for interactive model runs.';
    $heroImageAlt = 'Terms of use page infographic placeholder';
    require __DIR__ . '/../includes/page-hero.php';
    ?>

    <section class="content-card p-4 p-lg-5">
        <h2 class="section-title">Terms of Use</h2>
        <p><strong>Last Updated: May 14, 2026</strong></p>
        <p>These Terms of Use govern your access to and use of FrancisBurnet.com. By visiting, browsing, downloading from, linking to, launching tools from, or otherwise using this website, you agree to these Terms.</p>
        <p>If you do not agree with these Terms, do not use the website.</p>

        <h3 class="h5 mt-4">Purpose of the Website</h3>
        <p>FrancisBurnet.com is a personal educational portfolio website. It is designed to present coursework, capstone projects, technical demonstrations, software concepts, data science workflows, machine learning examples, deep learning experiments, charts, notebooks, project artifacts, and related professional materials.</p>
        <p>The website is intended for informational, educational, portfolio, and demonstration purposes only.</p>

        <h3 class="h5 mt-4">Permitted Use</h3>
        <p>You may use this website for lawful personal, educational, review, hiring, collaboration, or informational purposes.</p>
        <p>You may view pages, read project explanations, review examples, download publicly available artifacts, and open linked tools only in a lawful and respectful manner.</p>

        <h3 class="h5 mt-4">Prohibited Use</h3>
        <ul>
            <li>Use the website for unlawful, harmful, abusive, deceptive, or malicious purposes.</li>
            <li>Attempt to gain unauthorized access to the website, server, files, databases, APIs, code, or hosting environment.</li>
            <li>Abuse, overload, scrape, attack, scan, or interfere with the website or its infrastructure.</li>
            <li>Attempt to run unauthorized code through exposed parameter controls, notebooks, forms, APIs, or demos.</li>
            <li>Upload, submit, or transmit malware, spam, phishing content, or harmful files.</li>
            <li>Misrepresent the website, its owner, or any affiliation with third-party organizations.</li>
            <li>Remove copyright, attribution, license, or ownership notices from downloaded materials.</li>
            <li>Use project examples or model outputs as a substitute for professional review.</li>
            <li>Submit confidential, regulated, protected, or sensitive data unless a secure process is specifically provided.</li>
        </ul>

        <h3 class="h5 mt-4">Educational Code, Notebooks, and Artifacts</h3>
        <p>This website may include code snippets, notebooks, datasets, CSV files, JSON files, images, charts, reports, PDFs, screenshots, and other project artifacts.</p>
        <p>These materials are provided for educational review and portfolio demonstration. They may not be suitable for production use. You are responsible for reviewing, testing, validating, securing, and licensing any code, file, dataset, or workflow before using it outside this website.</p>

        <h3 class="h5 mt-4">Artificial Intelligence and Model Demonstrations</h3>
        <p>AI, machine learning, and deep learning examples on this website may involve experimental workflows, sample datasets, limited training runs, or educational assumptions. Outputs may be inaccurate, incomplete, biased, outdated, or unsuitable for real-world use.</p>
        <p>You agree not to rely on any AI or model output from this website for legal, medical, financial, employment, safety, compliance, academic grading, or production business decisions without independent review by a qualified person.</p>

        <h3 class="h5 mt-4">Third-Party Links, Tools, and Embeds</h3>
        <p>This website may include links to or embeds from third-party platforms, including Google Colab, Google services, TensorFlow Playground, GitHub, LinkedIn, open-source projects, course-related resources, documentation websites, and other external tools.</p>
        <p>Third-party services are governed by their own terms, privacy policies, licenses, and rules. FrancisBurnet.com is not responsible for third-party content, availability, security, cookies, pricing, data practices, warranties, or restrictions.</p>
        <p>You are responsible for reviewing and complying with all third-party terms before using an external service.</p>

        <h3 class="h5 mt-4">Course Materials and Third-Party Content</h3>
        <p>Some pages may reference course assignments, class instructions, educational datasets, program names, technology names, trademarks, or third-party resources. These references are provided for educational and identification purposes only.</p>
        <p>Third-party course materials, datasets, trademarks, code libraries, screenshots, documentation, and embedded tools remain the property of their respective owners. Nothing on this website transfers ownership of third-party intellectual property.</p>

        <h3 class="h5 mt-4">Intellectual Property</h3>
        <p>Unless otherwise stated, original text, original explanations, original project organization, original commentary, original site design, original screenshots created by the site owner, and original portfolio content on FrancisBurnet.com are owned by Francis Burnet or used with permission.</p>
        <p>You may not copy, republish, sell, redistribute, frame, mirror, or commercially exploit original website content without written permission, except where allowed by applicable law or by a clearly stated license.</p>
        <p>Open-source code, third-party libraries, course materials, datasets, trademarks, documentation, and externally embedded tools remain subject to their own licenses and ownership rules.</p>

        <h3 class="h5 mt-4">No User Account or Payment Relationship</h3>
        <p>Unless a specific feature is added later, FrancisBurnet.com does not currently provide paid user accounts, subscriptions, ecommerce checkout, online course sales, or paid software access through this website.</p>
        <p>If such features are added, additional terms may apply.</p>

        <h3 class="h5 mt-4">No Warranty</h3>
        <p>The website is provided "as is" and "as available." FrancisBurnet.com does not guarantee that the website, files, links, embeds, tools, notebooks, datasets, models, code, or outputs will be accurate, complete, secure, uninterrupted, error-free, or fit for any particular purpose.</p>

        <h3 class="h5 mt-4">Limitation of Liability</h3>
        <p>To the fullest extent permitted by law, FrancisBurnet.com and its owner are not liable for damages, losses, claims, errors, security issues, data loss, business interruption, third-party service problems, reliance on educational outputs, or consequences arising from your use of the website, files, code, notebooks, embeds, links, or project materials.</p>

        <h3 class="h5 mt-4">Changes to the Website</h3>
        <p>FrancisBurnet.com may update, remove, reorganize, restrict, or discontinue any page, file, artifact, link, notebook, embed, project, feature, or policy at any time without notice.</p>

        <h3 class="h5 mt-4">Governing Law</h3>
        <p>These Terms are intended to be governed by the laws of the State of New Jersey, unless another law is required to apply.</p>

        <h3 class="h5 mt-4">Contact</h3>
        <p class="mb-0"><strong>Email:</strong> <a href="mailto:hello@francisburnet.com">hello@francisburnet.com</a><br>
        <strong>Mailing Address:</strong> PO Box 1381, Bellmawr, NJ 08099</p>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
