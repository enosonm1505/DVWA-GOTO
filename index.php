<?php

$dir = dirname(__FILE__);
$templates = require $dir.'/templates/templates.php';

define('DVWA_WEB_PAGE_TO_ROOT', '');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array('authenticated', 'phpids'));

$page = dvwaPageNewGrab();
$page['title']   = 'Welcome' . $page['title_separator'].$page['title'];
$page['page_id'] = 'home';

$templateVars = getPageVariables($page);
$templateVars = array_merge($templateVars, $templates->getTemplateVariables());
$templateVars = array_merge($templateVars, [
    'title' => $page['title']
]);

echo $templates->render('index', $templateVars);

?>
