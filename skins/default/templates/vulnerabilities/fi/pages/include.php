<?php $this->layout($this->data['themeName'].'/templates/vulnerabilities/fi/index', $this->data) ?>
<div class="body_padded">
    <h1>Vulnerability: File Inclusion</h1>

    <?php if (!$this->data['allowUrlInclude']): ?>
    <div class="warning">The PHP function <em>allow_url_include</em> is not enabled.</div>
    <?php endif ?>

    <?php if (!$this->data['allowUrlFopen']): ?>
    <div class="warning">The PHP function <em>allow_url_fopen</em> is not enabled.</div>
    <?php endif ?>

    <div class="vulnerable_code_area">
        [<em><a href="?page=file1.php">file1.php</a></em>] - [<em><a href="?page=file2.php">file2.php</a></em>] - [<em><a href="?page=file3.php">file3.php</a></em>]
    </div>

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('https://en.wikipedia.org/wiki/Remote_File_Inclusion') ?></li>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Top_10_2007-A3') ?></li>
    </ul>
</div>