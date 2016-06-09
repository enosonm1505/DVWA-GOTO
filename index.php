<?php

define('DVWA_WEB_PAGE_TO_ROOT', '');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

//dvwaPageStartup(array('authenticated', 'phpids'));

$page = dvwaPageNewGrab();
$page['title']   = 'Welcome' . $page['title_separator'].$page['title'];
$page['page_id'] = 'home';

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, [
    'title' => $page['title']
]);

echo renderPage('index', $templateVars);
