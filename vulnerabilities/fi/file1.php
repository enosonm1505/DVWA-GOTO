<?php

$templateVars = array_merge($templateVars, [
    'currentUser' => dvwaCurrentUser(),
    'remoteAddr' => $_SERVER['REMOTE_ADDR']
]);

echo renderPage('vulnerabilities/fi/pages/file1', $templateVars);

?>