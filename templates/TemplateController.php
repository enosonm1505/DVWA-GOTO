<?php
namespace DVWA\Templates;
use \League\Plates as Plates;

global $dir;
$dir = dirname(__FILE__) . '/';

require $dir.'../vendor/autoload.php';
require_once $dir.'Config.php';

class TemplateController {
    private $templates;

    public function __construct() {
        global $dir;
        
        // TODO: Put this in a config.json file
        $this->theme = 'space';
        $this->fallBackTheme = 'default';

        $this->templates = new Plates\Engine($dir . '../skins/' . $this->theme . '/templates', 'php');

        if ($this->theme !== $this->fallBackTheme) {
            $this->templates->addFolder('default', $dir . '../skins/' . $this->fallBackTheme . '/templates', true);
        }


        $this->templates->registerFunction('externalLink', function ($url, $text = null) {
            if (is_null($text)) {
                return '<a href="http://hiderefer.com/?' . $url . '" target="_blank">' . $url . '</a>';
            }
            else {
                return '<a href="http://hiderefer.com/?' . $url . '" target="_blank">' . $text . '</a>';
            }
        });

        $configPath = $dir . '../skins/' . $this->theme . '/config/config.json';
        $this->config = new Config($configPath);
    }
    
    // Render a template directly
    public function render($index, $variables) {
        if ($this->templates->exists($index)) {
            return $this->templates->render($index, $variables);
        } else {
            return $this->templates->render('default::' . $index, $variables);
        }
    }

    public function getTemplateVariables($path = '') {
        return [
            'root' => $path,
            'templateRoot' => $path . 'skins/'.$this->theme.'/',
            'themeName' => $this->theme,
            'defaultTheme' => $this->fallBackTheme
        ];
    }
}