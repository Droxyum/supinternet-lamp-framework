<?php

namespace Core\Twig;


use Core\Loader\ConfigLoader;


/**
 * Class Router
 * @package Core\Twig
 */
class Router extends \Twig_Extension
{
    /**
     * @param $routeName
     * @param array $params
     * @return string
     */
    public function path($routeName, $params = []) {
        $Loader = new ConfigLoader();
        $Routing = $Loader->load('routing');
        $Routing = $Routing[$routeName];
        $pattern = $Routing['path'];
        foreach ($params as $k => $v) {
            $pattern = str_replace(':'.$k, $v, $pattern);
        }
        return BASE_URL.$pattern;
    }

    /**
     * @param $path
     * @return string
     */
    public function asset($path) {
        if ($path[0] == '/') {
            return BASE_URL.$path;
        }
        return BASE_URL.'/'.$path;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Router';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'path' => new \Twig_Function_Method($this, 'path'),
            'asset' => new \Twig_Function_Method($this, 'asset'),
        );
    }

}