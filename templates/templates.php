<?php

$dir = dirname(__FILE__);
require $dir.'/../vendor/autoload.php';

class TemplateController {
    private $templates;

    public function __construct($templates) {
        $this->theme = 'default';
        $this->templates = new League\Plates\Engine($templates, 'php');
    }
    
    // Render a template directly
    public function render($index, $variables) {
        return $this->templates->render($this->theme.'/templates/'.$index, $variables);
    }

    public function getTemplateVariables() {
        return [
            'root' => '',
            'templateRoot' => 'skins/'.$this->theme.'/',
            'themeName' => $this->theme
        ];
    }
}

return new TemplateController($dir.'/../skins');