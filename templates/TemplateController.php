<?php

namespace DVWA\Templates;


use \League\Plates as Plates;

/**
 * Class TemplateController
 * @package DVWA\Templates
 */
class TemplateController
{
    private $templates;

    public function __construct()
    {
        // TODO: Put this in a config.json file
        $this->theme = 'default';
        $this->fallBackTheme = 'default';

        $this->templates = new Plates\Engine(ROOT_DIRECTORY . 'skins/' . $this->theme . '/templates', 'php');
        $this->templates->addFolder('default', ROOT_DIRECTORY . 'skins/' . $this->fallBackTheme . '/templates', true);
        $this->templates->registerFunction('externalLink', 'DVWA\Templates\TemplateController::createExternalLink');

        $configPath = ROOT_DIRECTORY . 'skins/' . $this->theme . '/config/config.json';
        $this->config = new Config($configPath);
    }

    // Render a template directly
    public function render($template, $variables)
    {
        if ($this->templates->exists($template)) {
            return $this->templates->render($template, $variables);
        } else {
            return $this->templates->render('default::' . $template, $variables);
        }
    }

    public function getTemplateVariables()
    {
        return [
            'root' => '/',
            'templateRoot' => '/skins/' . $this->theme . '/',
            'themeName' => $this->theme,
            'defaultTheme' => $this->fallBackTheme
        ];
    }

    public static function createExternalLink($url, $text = null)
    {
        if (is_null($text)) {
            return '<a href="http://hiderefer.com/?' . $url . '" target="_blank">' . $url . '</a>';
        } else {
            return '<a href="http://hiderefer.com/?' . $url . '" target="_blank">' . $text . '</a>';
        }
    }
}