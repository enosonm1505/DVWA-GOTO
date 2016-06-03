<?php

$dir = dirname(__FILE__);
require $dir.'/../vendor/autoload.php';

class TemplateController {
    private $templates;

    public function __construct($templates) {
        $this->theme = 'default';
        $this->templates = new League\Plates\Engine($templates, 'php');

        $this->templates->registerFunction('externalLink', function ($url, $text = null) {
            if (is_null($text)) {
                return '<a href="http://hiderefer.com/?' . $url . '" target="_blank">' . $url . '</a>';
            }
            else {
                return '<a href="http://hiderefer.com/?' . $url . '" target="_blank">' . $text . '</a>';
            }
        });
    }
    
    // Render a template directly
    public function render($index, $variables) {
        return $this->templates->render($this->theme.'/templates/'.$index, $variables);
    }

    public function getTemplateVariables($path = '') {
        return [
            'root' => $path,
            'templateRoot' => $path . 'skins/'.$this->theme.'/',
            'themeName' => $this->theme
        ];
    }
}

return new TemplateController($dir.'/../skins');