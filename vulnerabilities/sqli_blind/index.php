<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'Vulnerability: SQL Injection (Blind)' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'sqli_blind';
$page[ 'help_button' ]   = 'sqli_blind';
$page[ 'source_button' ] = 'sqli_blind';

dvwaDatabaseConnect();

$method            = 'GET';
$vulnerabilityFile = '';
switch( $_COOKIE[ 'security' ] ) {
	case 'low':
		$vulnerabilityFile = 'low.php';
		break;
	case 'medium':
		$vulnerabilityFile = 'medium.php';
		$method = 'POST';
		break;
	case 'high':
		$vulnerabilityFile = 'high.php';
		break;
	default:
		$vulnerabilityFile = 'impossible.php';
		break;
}

require_once DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/sqli_blind/source/{$vulnerabilityFile}";

if ($vulnerabilityFile == 'medium.php') {
	$query  = "SELECT COUNT(*) FROM users;";
	$result = mysql_query($query) or die('<pre>' . mysql_error() . '</pre>');
	$num    = mysql_result($result, 0);
	$i      = 0;
	$options = array();
	while( $i < $num ) {
		$i++;
		array_push($options, $i);
	}
}

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, [
	'title' => $page['title'],
	'tokenField' => tokenField(),
	'vulnerabilityFile' => $vulnerabilityFile,
	'html' => $html,
	'magicQuotesEnabled' => ini_get('magic_quotes_gpc'),
	'safeModeEnabled' => ini_get('safe_mode'),
	'method' => $method,
	'options' => $options
]);

echo renderPage('vulnerabilities/sqli_blind/index', $templateVars);

?>
