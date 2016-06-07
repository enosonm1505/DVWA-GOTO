<?php

$templateVars = array_merge($templateVars, [
    'allowUrlInclude' => ini_get('allow_url_include'),
    'allowUrlFopen' => ini_get('allow_url_fopen')
]);

echo renderPage('vulnerabilities/fi/pages/include', $templateVars);

?>
