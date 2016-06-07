<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
    <h1>DVWA Security <img src="<?= $this->data['templateRoot'] ?>images/lock.png"/></h1>
    <br />

    <h2>Security Level</h2>
    
    <?= $this->data['securityHtml'] ?>

    <form action="#" method="POST">
        <p>Security level is currently: <em><?= $this->data['securityLevel'] ?></em>.<p>
        
        <p>You can set the security level to low, medium, high or impossible. The security level changes the vulnerability level of DVWA:</p>
        <ol>
            <li> Low - This security level is completely vulnerable and <em>has no security measures at all</em>. It's use is to be as an example of how web application vulnerabilities manifest through bad coding practices and to serve as a platform to teach or learn basic exploitation techniques.</li>
            <li> Medium - This setting is mainly to give an example to the user of <em>bad security practices</em>, where the developer has tried but failed to secure an application. It also acts as a challenge to users to refine their exploitation techniques.</li>
            <li> High - This option is an extension to the medium difficulty, with a mixture of <em>harder or alternative bad practices</em> to attempt to secure the code. The vulnerability may not allow the same extent of the exploitation, similar in various Capture The Flags (CTFs) competitions.</li>
            <li> Impossible - This level should be <em>secure against all vulnerabilities</em>. It is used to compare the vulnerable source code to the secure source code.<br />
                Priority to DVWA v1.9, this level was known as 'high'.</li>
        </ol>
        <select name="security">
            <?php foreach ($this->data['securityLevels'] as $securityLevel): ?>
            <option value="<?= $securityLevel ?>"<?= ($securityLevel == $this->data['securityLevel'] ? ' selected="selected"' : '') ?>><?= ucfirst($securityLevel) ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" value="Submit" name="seclev_submit">
        <?= $this->data['tokenField'] ?>
    </form>

    <br />
    <hr />
    <br />

    <h2>PHPIDS</h2>
    <?php if (!$this->data['logWritable']): ?>
    <div class="warning"><em>Cannot write to the PHPIDS log file</em>: <?= $this->data['PHPIDSPath'] ?></div>
    <?php endif ?>
    <p><?= $this->externalLink('https://github.com/PHPIDS/PHPIDS', 'PHPIDS') ?> v<?= $this->data['PHPIDSVersion'] ?> (PHP-Intrusion Detection System) is a security layer for PHP based web applications.</p>
    <p>PHPIDS works by filtering any user supplied input against a blacklist of potentially malicious code. It is used in DVWA to serve as a live example of how Web Application Firewalls (WAFs) can help improve security and in some cases how WAFs can be circumvented.</p>
    <p>You can enable PHPIDS across this site for the duration of your session.</p>

    <p>
        <?php if ($this->data['PHPIDSEnabled']): ?>
        <em>enabled</em>. [<a href="?phpids=off">Disable PHPIDS</a>]
        <?php else: ?>
        <em>disabled</em>. [<a href="?phpids=on">Enable PHPIDS</a>]
        <?php endif ?>
    </p>
    [<a href="?test=%22><script>eval(window.name)</script>">Simulate attack</a>] -
    [<a href="ids_log.php">View IDS log</a>]
</div>