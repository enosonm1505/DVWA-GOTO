<?php $this->layout('sections/base', $this->data) ?>

<div class="body_padded">
	<h1>Vulnerability: Insecure CAPTCHA</h1>

	<?php if (!$this->data['captchaKeySet']): ?>
        <div class="warning"><em>reCAPTCHA API key missing</em> from config file: <?= $this->data['configPath'] ?></div>
    <?php endif ?>

	<div class="vulnerable_code_area">
		<form action="#" method="POST"<?= ($this->data['hideForm'] ? ' style="display: none;"' : '') ?>>
			<h3>Change your password:</h3>
			<br />

			<input type="hidden" name="step" value="1" />
            <?php if ($this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            Current password:<br />
            <input type="password" AUTOCOMPLETE="off" name="password_current"><br />
            <?php endif ?>
            New password:<br />
            <input type="password" AUTOCOMPLETE="off" name="password_new"><br />
            Confirm new password:<br />
            <input type="password" AUTOCOMPLETE="off" name="password_conf"><br />
            
            <?= $this->data['recaptchaHtml'] ?>

            <?php if ($this->data['vulnerabilityFile'] == 'high.php'): ?>
            <!-- **DEV NOTE**   Response: 'hidd3n_valu3'   &&   User-Agent: 'reCAPTCHA'   **/DEV NOTE** -->
            <?php endif ?>

            <?php if ($this->data['vulnerabilityFile'] == 'high.php' || $this->data['vulnerabilityFile'] == 'impossible.php'): ?>
            <?= $this->data['tokenField'] ?>
            <?php endif ?>
			<br />

			<input type="submit" value="Change" name="Change">
		</form>
		<?= $this->data['html'] ?>
	</div>

	<h2>More Information</h2>
	<ul>
		<li><?= $this->externalLink('http://www.captcha.net/') ?></li>
		<li><?= $this->externalLink('https://www.google.com/recaptcha/') ?></li>
		<li><?= $this->externalLink('https://www.owasp.org/index.php/Testing_for_Captcha_(OWASP-AT-012)') ?></li>
	</ul>
</div>