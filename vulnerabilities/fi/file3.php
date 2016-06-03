<?php

$forwardedFor = array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '**Missing Header**';

$templateVars = array_merge($templateVars, [
	'currentUser' => dvwaCurrentUser(),
	'forwardedFor' => $forwardedFor,
	'userAgent' => $_SERVER['HTTP_USER_AGENT'],
	'referer' => $_SERVER['HTTP_REFERER'],
	'host' => $_SERVER['HTTP_HOST']
]);

echo $templates->render('vulnerabilities/fi/pages/file3', $templateVars);

?>
