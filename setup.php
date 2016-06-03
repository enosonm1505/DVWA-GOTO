<?php

$dir = dirname(__FILE__);
$templates = require $dir.'/templates/templates.php';

define('DVWA_WEB_PAGE_TO_ROOT', '');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array('phpids'));

$page = dvwaPageNewGrab();
$page['title']   = 'Setup' . $page['title_separator'].$page['title'];
$page['page_id'] = 'setup';

if(isset($_POST['create_db'])) {
	// Anti-CSRF
	checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'setup.php');

	if($DBMS == 'MySQL') {
		include_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/DBMS/MySQL.php';
	}
	elseif($DBMS == 'PGSQL') {
		// include_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/DBMS/PGSQL.php';
		dvwaMessagePush('PostgreSQL is not yet fully supported.');
		dvwaPageReload();
	}
	else {
		dvwaMessagePush('ERROR: Invalid database selected. Please review the config file syntax.');
		dvwaPageReload();
	}
}

// Anti-CSRF
generateSessionToken();

$configPath = realpath( getcwd() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php");

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, $templates->getTemplateVariables());
$templateVars = array_merge($templateVars, [
	'title' => $page['title'],
	'configPath' => $configPath,
	'tokenField' => tokenField(),
	'DVWAOS' => $DVWAOS,
	'DBMS' => $DBMS,
	'SERVER_NAME' => $SERVER_NAME,
	'phpDisplayErrors' => $phpDisplayErrors,
	'phpSafeMode' => $phpSafeMode,
	'phpURLInclude' => $phpURLInclude,
	'phpURLFopen' => $phpURLFopen,
	'phpMagicQuotes' => $phpMagicQuotes,
	'phpGD' => $phpGD,
	'phpMySQL' => $phpMySQL,
	'phpPDO' => $phpPDO,
	'MYSQL_USER' => $MYSQL_USER,
	'MYSQL_PASS' => $MYSQL_PASS,
	'MYSQL_DB' => $MYSQL_DB,
	'MYSQL_SERVER' => $MYSQL_SERVER,
	'DVWARecaptcha' => $DVWARecaptcha,
	'DVWAUploadsWrite' => $DVWAUploadsWrite,
	'DVWAPHPWrite' => $DVWAPHPWrite
]);

echo $templates->render('setup', $templateVars);

?>
