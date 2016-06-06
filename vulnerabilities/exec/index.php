<?php

define('DVWA_WEB_PAGE_TO_ROOT', '../../');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array('authenticated', 'phpids'));

$page = dvwaPageNewGrab();
$page['title']   = 'Vulnerability: Command Injection' . $page['title_separator'].$page['title'];
$page['page_id'] = 'exec';
$page['help_button']   = 'exec';
$page['source_button'] = 'exec';

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

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/exec/source/{$vulnerabilityFile}";

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, [
	'title' => $page['title'],
	'tokenField' => tokenField(),
	'vulnerabilityFile' => $vulnerabilityFile,
	'html' => $html
]);

echo renderPage('vulnerabilities/exec/index', $templateVars);

?>
