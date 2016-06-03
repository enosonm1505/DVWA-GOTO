<?php

$templateVars = array_merge($templateVars, [
    'currentUser' => dvwaCurrentUser(),
    'remoteAddr' => $_SERVER['REMOTE_ADDR']
]);

echo $templates->render('vulnerabilities/fi/pages/file1', $templateVars);

?>