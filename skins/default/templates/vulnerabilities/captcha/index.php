<?php $this->layout($this->data['themeName'].'/templates/base', $this->data) ?>

<div class="body_padded">
	<h1>Vulnerability: Insecure CAPTCHA</h1>

	<?php if (!$this->data['captchaKeySet']): ?>
        <div class="warning"><em>reCAPTCHA API key missing</em> from config file: <?= $this->data['configPath'] ?></div>
    <? endif ?>

	<div class="vulnerable_code_area">
		<form action="#" method="POST" ";

if( $hide_form )
    $page[ 'body' ] .= "style="display:none;"";

$page[ 'body' ] .= ">
			<h3>Change your password:</h3>
			<br />

			<input type="hidden" name="step" value="1" />\n";

if( $vulnerabilityFile == 'impossible.php' ) {
    $page[ 'body' ] .= "
			Current password:<br />
			<input type="password" AUTOCOMPLETE="off" name="password_current"><br />";
}

$page[ 'body' ] .= "			New password:<br />
			<input type="password" AUTOCOMPLETE="off" name="password_new"><br />
			Confirm new password:<br />
			<input type="password" AUTOCOMPLETE="off" name="password_conf"><br />

			" . recaptcha_get_html( $_DVWA[ 'recaptcha_public_key' ] );
if( $vulnerabilityFile == 'high.php' )
    $page[ 'body' ] .= "\n\n			<!-- **DEV NOTE**   Response: 'hidd3n_valu3'   &&   User-Agent: 'reCAPTCHA'   **/DEV NOTE** -->\n";

if( $vulnerabilityFile == 'high.php' || $vulnerabilityFile == 'impossible.php' )
    $page[ 'body' ] .= "\n			" . tokenField();

$page[ 'body' ] .= "
			<br />

			<input type="submit" value="Change" name="Change">
		</form>
		{$html}
	</div>

	<h2>More Information</h2>
	<ul>
		<li>" . dvwaExternalLinkUrlGet( 'http://www.captcha.net/' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'https://www.google.com/recaptcha/' ) . "</li>
		<li>" . dvwaExternalLinkUrlGet( 'https://www.owasp.org/index.php/Testing_for_Captcha_(OWASP-AT-012)' ) . "</li>
	</ul>
</div>