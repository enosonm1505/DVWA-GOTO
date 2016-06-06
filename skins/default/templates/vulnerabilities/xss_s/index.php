<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
    <h1>Vulnerability: Stored Cross Site Scripting (XSS)</h1>

    <div class="vulnerable_code_area">
        <form method="post" name="guestform" onsubmit="return validate_form(this)">
        <table width="550" border="0" cellpadding="2" cellspacing="1">
            <tr>
                <td width="100">Name *</td>
                <td><input name="txtName" type="text" size="30" maxlength="10"></td>
            </tr>
            <tr>
                <td width="100">Message *</td>
                <td><textarea name="mtxMessage" cols="50" rows="3" maxlength="50"></textarea></td>
            </tr>
            <tr>
                <td width="100">&nbsp;</td>
                <td><input name="btnSign" type="submit" value="Sign Guestbook" onClick="return checkForm();"></td>
            </tr>
        </table>

        <?php if ($this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            <?= $this->data['tokenField'] ?>
        <?php endif ?>
        </form>
    <?= $this->data['html'] ?>
    </div>
    <br />

    <?php foreach ($this->data['guestBook'] as $entry): ?>
    <div id="guestbook_comments">Name: <?= $entry['name'] ?><br />
        Message: <?= $entry['comment'] ?><br />
    </div>
    <?php endforeach ?>

    <br />

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)') ?></li>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/XSS_Filter_Evasion_Cheat_Sheet') ?></li>
        <li><?= $this->externalLink('https://en.wikipedia.org/wiki/Cross-site_scripting') ?></li>
        <li><?= $this->externalLink('http://www.cgisecurity.com/xss-faq.html') ?></li>
        <li><?= $this->externalLink('http://www.scriptalert1.com/') ?></li>
    </ul>
</div>