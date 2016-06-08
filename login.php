<?php

define('DVWA_WEB_PAGE_TO_ROOT', '');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array('phpids'));

dvwaDatabaseConnect();

if (isset($_POST['Login'])) {
	// Anti-CSRF
	checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'login.php');

	$user = $_POST['username'];
	$user = stripslashes($user);
	$user = mysql_real_escape_string($user);

	$pass = $_POST['password'];
	$pass = stripslashes($pass);
	$pass = mysql_real_escape_string($pass);
	$pass = md5($pass);

	$query = ("SELECT table_schema, table_name, create_time
				FROM information_schema.tables
				WHERE table_schema='{$_DVWA['db_database']}' AND table_name='users'
				LIMIT 1");
	$result = @mysql_query($query);
	if (mysql_num_rows($result) != 1) {
		dvwaMessagePush("First time using DVWA.<br />Need to run 'setup.php'.");
		dvwaRedirect(DVWA_WEB_PAGE_TO_ROOT . 'setup.php');
	}

	$query  = "SELECT * FROM `users` WHERE user='$user' AND password='$pass';";
	$result = @mysql_query($query) or die('<pre>' . mysql_error() . '.<br />Try <a href="setup.php">installing again</a>.</pre>');

  //TODO: REMOVE THIS BEFORE PRODUCTION!
	if (($result && mysql_num_rows($result) == 1) || true) {    // Login Successful...
		dvwaMessagePush("You have logged in as '{$user}'");
		dvwaLogin($user);
		dvwaRedirect(DVWA_WEB_PAGE_TO_ROOT . 'index.php');
	}

	// Login failed
	dvwaMessagePush('Login failed');
	dvwaRedirect('login.php');
}

$messagesHtml = messagesPopAllToHtml();

Header('Cache-Control: no-cache, must-revalidate');    // HTTP/1.1
Header('Content-Type: text/html;charset=utf-8');      // TODO- proper XHTML headers...
Header('Expires: Tue, 23 Jun 2009 12:00:00 GMT');     // Date in the past

// Anti-CSRF
generateSessionToken();

$page = [
  'title' => 'Login :: Damn Vulnerable Web Application (DVWA) v' . dvwaVersionGet()
];

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, [
  'title' => $page['title'],
  'messages' => $messagesHtml,
  'dvwaVersion' => dvwaVersionGet(),
  'tokenField' => tokenField()
]);

echo renderPage('login', $templateVars);

?>
