<?php $this->layout($this->data['themeName'].'/templates/base', $this->data) ?>

<div class="body_padded">
    <h1>Vulnerability: Command Injection</h1>

    <div class="vulnerable_code_area">
        <h2>Ping a device</h2>

        <form name="ping" action="#" method="post">
            <p>
                Enter an IP address:
                <input type="text" name="ip" size="30">
                <input type="submit" name="Submit" value="Submit">
            </p>

            <?php if ($this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            <?= $this->data['tokenField'] ?>
            <?php endif ?>
        </form>
        <?= $this->data['html'] ?>
    </div>

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('http://www.scribd.com/doc/2530476/Php-Endangers-Remote-Code-Execution') ?></li>
        <li><?= $this->externalLink('http://www.ss64.com/bash/') ?></li>
        <li><?= $this->externalLink('http://www.ss64.com/nt/') ?></li>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Command_Injection') ?></li>
    </ul>
</div>