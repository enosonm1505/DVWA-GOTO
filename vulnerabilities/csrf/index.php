<?php

$dir = dirname(__FILE__);
$templates = require $dir.'/../../templates/templates.php';

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: Cross Site Request Forgery (CSRF)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'csrf';
$page[ 'help_button' ]   = 'csrf';
$page[ 'source_button' ] = 'csrf';

dvwaDatabaseConnect();

$vulnerabilityFile = '';
switch ( $_COOKIE[ 'security' ] ) {
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

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/csrf/source/{$vulnerabilityFile}";

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, $templates->getTemplateVariables(DVWA_WEB_PAGE_TO_ROOT));
$templateVars = array_merge($templateVars, [
	'title' => $page['title'],
	'tokenField' => tokenField(),
	'vulnerabilityFile' => $vulnerabilityFile,
	'html' => $html
]);

echo $templates->render('vulnerabilities/csrf/index', $templateVars);

?>
