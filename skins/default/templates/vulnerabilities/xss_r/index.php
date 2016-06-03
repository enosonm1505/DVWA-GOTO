<?php $this->layout($this->data['themeName'].'/templates/base', $this->data) ?>
<div class="body_padded">
    <h1>Vulnerability: Reflected Cross Site Scripting (XSS)</h1>

    <div class="vulnerable_code_area">
        <form name="XSS" action="#" method="GET">
            <p>
                What's your name?
                <input type="text" name="name">
                <input type="submit" value="Submit">
            </p>

            <?php if ($this->data['vulnerabilityFile'] == 'impossible.php'): ?>
                <?= $this->data['tokenField'] ?>
            <?php endif ?>
        </form>
        <?= $this->data['html'] ?>
    </div>

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)') ?></li>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/XSS_Filter_Evasion_Cheat_Sheet') ?></li>
        <li><?= $this->externalLink('https://en.wikipedia.org/wiki/Cross-site_scripting') ?></li>
        <li><?= $this->externalLink('http://www.cgisecurity.com/xss-faq.html') ?></li>
        <li><?= $this->externalLink('http://www.scriptalert1.com/') ?></li>
    </ul>
</div>