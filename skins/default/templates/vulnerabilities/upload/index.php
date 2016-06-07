<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
    <h1>Vulnerability: File Upload</h1>

    <?php if (!$this->data['folderWritable']): ?>
    <div class="warning">Incorrect folder permissions: {$PHPUploadPath}<br /><em>Folder is not writable.</em></div>
    <?php endif ?>

    <?php if (!$this->data['phpGdInstalled']): ?>
    <div class="warning">The PHP module <em>GD is not installed</em>.</div>
    <?php endif ?>

    <div class="vulnerable_code_area">
        <form enctype="multipart/form-data" action="#" method="POST">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
            Choose an image to upload:<br /><br />
            <input name="uploaded" type="file" /><br />
            <br />
            <input type="submit" name="Upload" value="Upload" />

            <?php if ($this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            <?= $this->data['tokenField'] ?>
            <?php endif ?>
        </form>
        <?= $this->data['html'] ?>
    </div>

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Unrestricted_File_Upload') ?></li>
        <li><?= $this->externalLink('https://blogs.securiteam.com/index.php/archives/1268') ?></li>
        <li><?= $this->externalLink('https://www.acunetix.com/websitesecurity/upload-forms-threat/') ?></li>
    </ul>
</div>