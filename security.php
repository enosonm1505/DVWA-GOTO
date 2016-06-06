<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated', 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'DVWA Security' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'security';

$securityHtml = '';
if( isset( $_POST['seclev_submit'] ) ) {
	// Anti-CSRF
	checkToken( $_REQUEST[ 'user_token' ], $_SESSION[ 'session_token' ], 'security.php' );

	$securityLevel = '';
	switch( $_POST[ 'security' ] ) {
		case 'low':
			$securityLevel = 'low';
			break;
		case 'medium':
			$securityLevel = 'medium';
			break;
		case 'high':
			$securityLevel = 'high';
			break;
		default:
			$securityLevel = 'impossible';
			break;
	}

	dvwaSecurityLevelSet( $securityLevel );
	dvwaMessagePush( "Security level set to {$securityLevel}" );
	dvwaPageReload();
}

if( isset( $_GET['phpids'] ) ) {
	switch( $_GET[ 'phpids' ] ) {
		case 'on':
			dvwaPhpIdsEnabledSet( true );
			dvwaMessagePush( "PHPIDS is now enabled" );
			break;
		case 'off':
			dvwaPhpIdsEnabledSet( false );
			dvwaMessagePush( "PHPIDS is now disabled" );
			break;
	}

	dvwaPageReload();
}

// Anti-CSRF
generateSessionToken();

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, [
	'title' => $page['title'],
	'tokenField' => tokenField(),
	'securityLevel' => dvwaSecurityLevelGet(),
	'securityLevels' => array('low', 'medium', 'high', 'impossible'),
	'securityHtml' => $securityHtml,
	'logWritable' => is_writable($PHPIDSPath),
	'PHPIDSPath' => $PHPIDSPath,
	'PHPIDSVersion' => dvwaPhpIdsVersionGet(),
	'PHPIDSEnabled' => dvwaPhpIdsIsEnabled()
]);

echo renderPage('security', $templateVars);

?>
