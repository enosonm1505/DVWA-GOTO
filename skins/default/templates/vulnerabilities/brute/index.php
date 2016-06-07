<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
    <h1>Vulnerability: Brute Force</h1>

    <div class="vulnerable_code_area">
        <h2>Login</h2>

        <form action="#" method="<?= $this->data['method'] ?>">
            Username:<br />
            <input type="text" name="username"><br />
            Password:<br />
            <input type="password" AUTOCOMPLETE="off" name="password"><br />
            <br />
            <input type="submit" value="Login" name="Login">

            <?php if ($this->data['vulnerabilityFile'] == 'high.php' || $this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            <?= $this->data['tokenField'] ?>
            <?php endif ?>
        </form>
        <?= $this->data['html'] ?>
    </div>

    <h2>More Information</h2>
    <ul>
        <li><?= $this->externalLink('https://www.owasp.org/index.php/Testing_for_Brute_Force_(OWASP-AT-004)') ?></li>
        <li><?= $this->externalLink('http://www.symantec.com/connect/articles/password-crackers-ensuring-security-your-password') ?></li>
        <li><?= $this->externalLink('http://www.sillychicken.co.nz/Security/how-to-brute-force-http-forms-in-windows.html') ?></li>
    </ul>
</div>