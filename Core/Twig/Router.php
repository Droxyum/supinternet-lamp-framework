<?php

namespace Core\Twig;


use Core\Loader\ConfigLoader;


class Router extends \Twig_Extension
{
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

    public function getName()
    {
        return 'Router';
    }

    public function getFunctions()
    {
        return array(
            'path' => new \Twig_Function_Method($this, 'path'),
        );
    }

}