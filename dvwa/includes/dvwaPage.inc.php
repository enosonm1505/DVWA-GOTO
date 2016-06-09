<?php

if(!defined('DVWA_WEB_PAGE_TO_ROOT')) {
  die('DVWA System error- WEB_PAGE_TO_ROOT undefined');
  exit;
}

session_start(); // Creates a 'Full Path Disclosure' vuln.

define('ROOT_DIRECTORY', __DIR__ . '/../../');
require ROOT_DIRECTORY.'vendor/autoload.php';

// Include configs
require_once DVWA_WEB_PAGE_TO_ROOT . 'config/config.inc.php';
require_once('dvwaPhpIds.inc.php');
require_once DVWA_WEB_PAGE_TO_ROOT . 'templates/TemplateController.php';

global $templateController;
$templateController = new DVWA\Templates\TemplateController();

// Declare the $html variable
if(!isset($html)) {
  $html = "";
}

// Valid security levels
$security_levels = array('low', 'medium', 'high', 'impossible');
if(!isset($_COOKIE['security']) || !in_array($_COOKIE['security'], $security_levels)) {
  // Set security cookie to impossible if no cookie exists
  if(in_array($_DVWA['default_security_level'], $security_levels)) {
    dvwaSecurityLevelSet($_DVWA['default_security_level']);
  }
  else {
    dvwaSecurityLevelSet('impossible');
  }

  if($_DVWA['default_phpids_level'] == 'enabled')
    dvwaPhpIdsEnabledSet(true);
  else
    dvwaPhpIdsEnabledSet(false);
}

// DVWA version
function dvwaVersionGet() {
  return '1.10 *Development*';
}

// DVWA release date
function dvwaReleaseDateGet() {
  return '2015-10-08';
}


// Start session functions --

function &dvwaSessionGrab() {
  if(!isset($_SESSION['dvwa'])) {
    $_SESSION['dvwa'] = array();
  }
  return $_SESSION['dvwa'];
}


function dvwaPageStartup($pActions) {
  if(in_array('authenticated', $pActions)) {
    if(!dvwaIsLoggedIn()) {
      dvwaRedirect(DVWA_WEB_PAGE_TO_ROOT . 'login.php');
    }
  }

  if(in_array('phpids', $pActions)) {
    if(dvwaPhpIdsIsEnabled()) {
      dvwaPhpIdsTrap();
    }
  }
}


function dvwaPhpIdsEnabledSet($pEnabled) {
  $dvwaSession =& dvwaSessionGrab();
  if($pEnabled) {
    $dvwaSession['php_ids'] = 'enabled';
  }
  else {
    unset($dvwaSession['php_ids']);
  }
}


function dvwaPhpIdsIsEnabled() {
  $dvwaSession =& dvwaSessionGrab();
  return isset($dvwaSession['php_ids']);
}


function dvwaLogin($pUsername) {
  $dvwaSession =& dvwaSessionGrab();
  $dvwaSession['username'] = $pUsername;
}


function dvwaIsLoggedIn() {
  $dvwaSession =& dvwaSessionGrab();
  return isset($dvwaSession['username']);
}


function dvwaLogout() {
  $dvwaSession =& dvwaSessionGrab();
  unset($dvwaSession['username']);
}


function dvwaPageReload() {
  dvwaRedirect($_SERVER['PHP_SELF']);
}

function dvwaCurrentUser() {
  $dvwaSession =& dvwaSessionGrab();
  return (isset($dvwaSession['username']) ? $dvwaSession['username'] : '') ;
}

// -- END (Session functions)

function &dvwaPageNewGrab() {
  $returnArray = array(
    'title'           => 'Damn Vulnerable Web Application (DVWA) v' . dvwaVersionGet() . '',
    'title_separator' => ' :: ',
    'body'            => '',
    'page_id'         => '',
    'help_button'     => '',
    'source_button'   => '',
  );
  return $returnArray;
}


function dvwaSecurityLevelGet() {
  return isset($_COOKIE['security']) ? $_COOKIE['security'] : 'medium';
}


function dvwaSecurityLevelSet($pSecurityLevel) {
  if($pSecurityLevel == 'medium') {
    $httponly = true;
  }
  else {
    $httponly = false;
  }
  setcookie(session_name(), session_id(), null, '/', null, null, $httponly);
  setcookie('security', $pSecurityLevel, NULL, NULL, NULL, NULL, $httponly);
}


// Start message functions --

function dvwaMessagePush($pMessage) {
  $dvwaSession =& dvwaSessionGrab();
  if(!isset($dvwaSession['messages'])) {
    $dvwaSession['messages'] = array();
  }
  $dvwaSession['messages'][] = $pMessage;
}


function dvwaMessagePop() {
  $dvwaSession =& dvwaSessionGrab();
  if(!isset($dvwaSession['messages']) || count($dvwaSession['messages']) == 0) {
    return false;
  }
  return array_shift($dvwaSession['messages']);
}


function messagesPopAllToHtml() {
  $messages = array();
  while($message = dvwaMessagePop()) {   // TODO- sharpen!
    array_push($messages, $message);
    //$messagesHtml .= "<div class=\"message\">{$message}</div>";
  }

  return $messages;
}

// --END (message functions)

function renderPage($template, $variables) {
  global $templateController;

  $templateVars = $templateController->getTemplateVariables();
  $templateVars = array_merge($templateVars, $variables);

  return $templateController->render($template, $templateVars);
}

function getPageVariables($page) {
  global $templateController;

  $menuBlocks = array();

  $alternativeMenu = $templateController->config->alternativeMenu;

  $menuBlocks['home'] = array();
  if ($alternativeMenu) {
    $menuBlocks['home'][] = array('id' => 'home', 'name' => 'Home', 'url' => '.');
  }
  if(dvwaIsLoggedIn()) {
    if (!$alternativeMenu) {
      $menuBlocks['home'][] = array('id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php');
    }

    if (!$alternativeMenu) {
      //$menuBlocks['home'][] = array('id' => 'setup', 'name' => 'Setup / Reset DB', 'url' => 'setup.php');
    }
  }
  else {
    if (!$alternativeMenu) {
      //$menuBlocks['home'][] = array('id' => 'setup', 'name' => 'Setup DVWA', 'url' => 'setup.php');
    }

    $menuBlocks['home'][] = array('id' => 'login', 'name' => 'Login', 'url' => 'login.php');
    //$menuBlocks['home'][] = array('id' => 'instructions', 'name' => 'Instructions', 'url' => 'instructions.php');
  }

  if(dvwaIsLoggedIn()) {
    $menuBlocks['vulnerabilities'] = array();
    $menuBlocks['vulnerabilities'][] = array('id' => 'brute', 'name' => 'Brute Force', 'url' => 'vulnerabilities/brute/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'exec', 'name' => 'Command Injection', 'url' => 'vulnerabilities/exec/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'csrf', 'name' => 'CSRF', 'url' => 'vulnerabilities/csrf/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'fi', 'name' => 'File Inclusion', 'url' => 'vulnerabilities/fi/.?page=include.php');
    $menuBlocks['vulnerabilities'][] = array('id' => 'upload', 'name' => 'File Upload', 'url' => 'vulnerabilities/upload/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'captcha', 'name' => 'Insecure CAPTCHA', 'url' => 'vulnerabilities/captcha/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'sqli', 'name' => 'SQL Injection', 'url' => 'vulnerabilities/sqli/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'sqli_blind', 'name' => 'SQL Injection (Blind)', 'url' => 'vulnerabilities/sqli_blind/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'xss_r', 'name' => 'XSS (Reflected)', 'url' => 'vulnerabilities/xss_r/');
    $menuBlocks['vulnerabilities'][] = array('id' => 'xss_s', 'name' => 'XSS (Stored)', 'url' => 'vulnerabilities/xss_s/');
  }

  if ($alternativeMenu) {
    //$menuBlocks['settings'] = array();
    //$menuBlocks['settings'][] = array('id' => 'setup', 'name' => 'Setup DVWA', 'url' => 'setup.php');
  }

  $menuBlocks['meta'] = array();
  if(dvwaIsLoggedIn()) {
    $category = $alternativeMenu ? 'settings' : 'meta';
    //$menuBlocks[$category][] = array('id' => 'security', 'name' => 'DVWA Security', 'url' => 'security.php');
    //$menuBlocks[$category][] = array('id' => 'phpinfo', 'name' => 'PHP Info', 'url' => 'phpinfo.php');
  }
  $menuBlocks['meta'][] = array('id' => 'about', 'name' => 'About', 'url' => 'about.php');

  if(dvwaIsLoggedIn()) {
    $menuBlocks['logout'] = array();
    $menuBlocks['logout'][] = array('id' => 'logout', 'name' => 'Logout', 'url' => 'logout.php');
  }

  foreach ($menuBlocks as &$menuBlock) {
    foreach ($menuBlock as &$menuItem) {
      $menuItem['selected'] = true;
    }
  }

  foreach ($menuBlocks as &$menuBlock) {
    foreach ($menuBlock as &$menuItem) {
      $menuItem['selected'] = $menuItem['id'] == $page['page_id'];
    }
  }

  unset($menuBlock);
  unset($menuItem);

  switch(dvwaSecurityLevelGet()) {
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

  $phpIdsEnabled = dvwaPhpIdsIsEnabled();
  $userInfo = dvwaCurrentUser();

  $messages = messagesPopAllToHtml();

  // Send Headers + main HTML code
  Header('Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
  Header('Content-Type: text/html;charset=utf-8');     // TODO- proper XHTML headers...
  Header('Expires: Tue, 23 Jun 2009 12:00:00 GMT');    // Date in the past

  return [
    'menuBlocks' => $menuBlocks,
    'securityLevel' => $securityLevel,
    'phpIdsEnabled' => $phpIdsEnabled,
    'userInfo' => $userInfo,
    'messages' => $messages,
    'userLoggedIn' => dvwaIsLoggedIn(),
    'page' => $page,
    'version' => dvwaVersionGet()
  ];
}

function dvwaHelpHtmlEcho($pPage) {
  // Send Headers
  Header('Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
  Header('Content-Type: text/html;charset=utf-8');     // TODO- proper XHTML headers...
  Header('Expires: Tue, 23 Jun 2009 12:00:00 GMT');    // Date in the past

  echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/css/help.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . DVWA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

	</head>

	<body>

	<div id=\"container\">

			{$pPage['body']}

		</div>

	</body>

</html>";
}

function dvwaSourceHtmlEcho($pPage) {
  // Send Headers
  Header('Cache-Control: no-cache, must-revalidate');   // HTTP/1.1
  Header('Content-Type: text/html;charset=utf-8');     // TODO- proper XHTML headers...
  Header('Expires: Tue, 23 Jun 2009 12:00:00 GMT');    // Date in the past

  echo "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\">

	<head>

		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />

		<title>{$pPage['title']}</title>

		<link rel=\"stylesheet\" type=\"text/css\" href=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/css/source.css\" />

		<link rel=\"icon\" type=\"\image/ico\" href=\"" . DVWA_WEB_PAGE_TO_ROOT . "favicon.ico\" />

	</head>

	<body>

		<div id=\"container\">

			{$pPage['body']}

		</div>

	</body>

</html>";
}

// To be used on all external links --
function dvwaExternalLinkUrlGet($pLink,$text=null) {
  if(is_null($text)) {
    return '<a href="http://hiderefer.com/?' . $pLink . '" target="_blank">' . $pLink . '</a>';
  }
  else {
    return '<a href="http://hiderefer.com/?' . $pLink . '" target="_blank">' . $text . '</a>';
  }
}
// -- END (external links)

function dvwaButtonHelpHtmlGet($pId) {
  $security = dvwaSecurityLevelGet();
  return "<input type=\"button\" value=\"View Help\" class=\"popup_button\" onClick=\"javascript:popUp('" . DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/view_help.php?id={$pId}&security={$security}')\">";
}


function dvwaButtonSourceHtmlGet($pId) {
  $security = dvwaSecurityLevelGet();
  return "<input type=\"button\" value=\"View Source\" class=\"popup_button\" onClick=\"javascript:popUp('" . DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/view_source.php?id={$pId}&security={$security}')\">";
}


// Database Management --

if($DBMS == 'MySQL') {
  $DBMS = htmlspecialchars(strip_tags($DBMS));
  $DBMS_errorFunc = 'mysql_error()';
}
elseif($DBMS == 'PGSQL') {
  $DBMS = htmlspecialchars(strip_tags($DBMS));
  $DBMS_errorFunc = 'pg_last_error()';
}
else {
  $DBMS = "No DBMS selected.";
  $DBMS_errorFunc = '';
}

//$DBMS_connError = '
//	<div align="center">
//		<img src="' . DVWA_WEB_PAGE_TO_ROOT . 'dvwa/images/logo.png" />
//		<pre>Unable to connect to the database.<br />' . $DBMS_errorFunc . '<br /><br /></pre>
//		Click <a href="' . DVWA_WEB_PAGE_TO_ROOT . 'setup.php">here</a> to setup the database.
//	</div>';

function dvwaDatabaseConnect() {
  global $_DVWA;
  global $DBMS;
  //global $DBMS_connError;
  global $db;

  if($DBMS == 'MySQL') {
    if(!@mysql_connect($_DVWA['db_server'], $_DVWA['db_user'], $_DVWA['db_password'])
      || !@mysql_select_db($_DVWA['db_database'])) {
      //die($DBMS_connError);
      dvwaLogout();
      dvwaMessagePush('Unable to connect to the database.<br />' . $DBMS_errorFunc);
      dvwaRedirect(DVWA_WEB_PAGE_TO_ROOT . 'setup.php');
    }
    // MySQL PDO Prepared Statements (for impossible levels)
    $db = new PDO('mysql:host=' . $_DVWA['db_server'].';dbname=' . $_DVWA['db_database'].';charset=utf8', $_DVWA['db_user'], $_DVWA['db_password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  }
  elseif($DBMS == 'PGSQL') {
    //$dbconn = pg_connect("host={$_DVWA['db_server']} dbname={$_DVWA['db_database']} user={$_DVWA['db_user']} password={$_DVWA['db_password'])}"
    //or die($DBMS_connError);
    dvwaMessagePush('PostgreSQL is not yet fully supported.');
    dvwaPageReload();
  }
  else {
    die ("Unknown {$DBMS} selected.");
  }
}

// -- END (Database Management)


function dvwaRedirect($pLocation) {
  session_commit();
  header("Location: {$pLocation}");
  exit;
}

// XSS Stored guestbook function --
function dvwaGuestbook() {
  $query  = "SELECT name, comment FROM guestbook";
  $result = mysql_query($query);

  $guestbook = array();

  while($row = mysql_fetch_row($result)) {
    if(dvwaSecurityLevelGet() == 'impossible') {
      $name    = htmlspecialchars($row[0]);
      $comment = htmlspecialchars($row[1]);
    }
    else {
      $name    = $row[0];
      $comment = $row[1];
    }

    $element = [
      'name' => $name,
      'comment' => $comment
    ];

    array_push($guestbook, $element);
  }
  return $guestbook;
}
// -- END (XSS Stored guestbook)


// Token functions --
function checkToken($user_token, $session_token, $returnURL) {  # Validate the given (CSRF) token
  if($user_token !== $session_token || !isset($session_token)) {
    dvwaMessagePush('CSRF token is incorrect');
    dvwaRedirect($returnURL);
  }
}

function generateSessionToken() {  # Generate a brand new (CSRF) token
  if(isset($_SESSION['session_token'])) {
    destroySessionToken();
  }
  $_SESSION['session_token'] = md5(uniqid());
}

function destroySessionToken() {  # Destroy any session with the name 'session_token'
  unset($_SESSION['session_token']);
}

function tokenField() {  # Return a field for the (CSRF) token
  return "<input type='hidden' name='user_token' value='{$_SESSION['session_token']}' />";
}
// -- END (Token functions)


// Setup Functions --
$PHPUploadPath    = realpath(getcwd() . DIRECTORY_SEPARATOR . DVWA_WEB_PAGE_TO_ROOT . "hackable" . DIRECTORY_SEPARATOR . "uploads") . DIRECTORY_SEPARATOR;
$PHPIDSPath       = realpath(getcwd() . DIRECTORY_SEPARATOR . DVWA_WEB_PAGE_TO_ROOT . "external" . DIRECTORY_SEPARATOR . "phpids" . DIRECTORY_SEPARATOR . dvwaPhpIdsVersionGet() . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "IDS" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR . "phpids_log.txt");

$phpDisplayErrors = 'PHP function display_errors: <em>' . (ini_get('display_errors') ? 'Enabled</em> <i>(Easy Mode!)</i>' : 'Disabled</em>');                                                  // Verbose error messages (e.g. full path disclosure)
$phpSafeMode      = 'PHP function safe_mode: <span class="' . (ini_get('safe_mode') ? 'failure">Enabled' : 'success">Disabled') . '</span>';                                                   // DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
$phpMagicQuotes   = 'PHP function magic_quotes_gpc: <span class="' . (ini_get('magic_quotes_gpc') ? 'failure">Enabled' : 'success">Disabled') . '</span>';                                     // DEPRECATED as of PHP 5.3.0 and REMOVED as of PHP 5.4.0
$phpURLInclude    = 'PHP function allow_url_include: <span class="' . (ini_get('allow_url_include') ? 'success">Enabled' : 'failure">Disabled') . '</span>';                                   // RFI
$phpURLFopen      = 'PHP function allow_url_fopen: <span class="' . (ini_get('allow_url_fopen') ? 'success">Enabled' : 'failure">Disabled') . '</span>';                                       // RFI
$phpGD            = 'PHP module gd: <span class="' . ((extension_loaded('gd') && function_exists('gd_info')) ? 'success">Installed' : 'failure">Missing') . '</span>';                    // File Upload
$phpMySQL         = 'PHP module mysql: <span class="' . ((extension_loaded('mysql') && function_exists('mysql')) ? 'success">Installed' : 'failure">Missing') . '</span>';                // Core DVWA
$phpPDO           = 'PHP module pdo_mysql: <span class="' . (extension_loaded('pdo_mysql') ? 'success">Installed' : 'failure">Missing') . '</span>';                // SQLi

$DVWARecaptcha    = 'reCAPTCHA key: <span class="' . ((isset($_DVWA['recaptcha_public_key']) && $_DVWA['recaptcha_public_key'] != '') ? 'success">' . $_DVWA['recaptcha_public_key'] : 'failure">Missing') . '</span>';

$DVWAUploadsWrite = '[User: ' . get_current_user() . '] Writable folder ' . $PHPUploadPath . ': <span class="' . (is_writable($PHPUploadPath) ? 'success">Yes' : 'failure">No') . '</span>';                                     // File Upload
$DVWAPHPWrite     = '[User: ' . get_current_user() . '] Writable file ' . $PHPIDSPath . ': <span class="' . (is_writable($PHPIDSPath) ? 'success">Yes' : 'failure">No') . '</span>';                                              // PHPIDS

$DVWAOS           = 'Operating system: <em>' . (strtoupper(substr (PHP_OS, 0, 3)) === 'WIN' ? 'Windows' : '*nix') . '</em>';
$SERVER_NAME      = 'Web Server SERVER_NAME: <em>' . $_SERVER['SERVER_NAME'] . '</em>';                                                                                                          // CSRF

$MYSQL_USER       = 'MySQL username: <em>' . $_DVWA['db_user'] . '</em>';
$MYSQL_PASS       = 'MySQL password: <em>' . (($_DVWA['db_password'] != "") ? '******' : '*blank*') . '</em>';
$MYSQL_DB         = 'MySQL database: <em>' . $_DVWA['db_database'] . '</em>';
$MYSQL_SERVER     = 'MySQL host: <em>' . $_DVWA['db_server'] . '</em>';
// -- END (Setup Functions)

?>
