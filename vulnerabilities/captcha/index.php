<?php

$dir = dirname(__FILE__);
$templates = require $dir.'/../../templates/templates.php';

define('DVWA_WEB_PAGE_TO_ROOT', '../../');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';
require_once DVWA_WEB_PAGE_TO_ROOT . "external/recaptcha/recaptchalib.php";

dvwaPageStartup(array('authenticated', 'phpids'));

$page = dvwaPageNewGrab();
$page['title']   = 'Vulnerability: Insecure CAPTCHA' . $page['title_separator'].$page['title'];
$page['page_id'] = 'captcha';
$page['help_button']   = 'captcha';
$page['source_button'] = 'captcha';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch ($_COOKIE['security']) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}

$hide_form = false;
require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/captcha/source/{$vulnerabilityFile}";

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, $templates->getTemplateVariables(DVWA_WEB_PAGE_TO_ROOT));
$templateVars = array_merge($templateVars, [
	'title' => $page['title'],
	'tokenField' => tokenField(),
	'vulnerabilityFile' => $vulnerabilityFile,
	'html' => $html,
	'captchaKeySet' => $_DVWA['recaptcha_public_key'] == "",
	'configPath' => realpath(getcwd() . DIRECTORY_SEPARATOR . DVWA_WEB_PAGE_TO_ROOT . "config" . DIRECTORY_SEPARATOR . "config.inc.php"),
	'hideForm' => $hide_form,
	'recaptchaHtml' => recaptcha_get_html($_DVWA['recaptcha_public_key']),
]);

echo $templates->render('vulnerabilities/captcha/index', $templateVars);
?>
