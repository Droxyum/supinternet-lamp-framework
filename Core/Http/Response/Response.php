<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 11:08
 */

namespace Core\Http\Response;


use Core\Exception\NotFoundException;

class Response
{
    public function __construct($view, $params = [])
    {
        $loader = new \Twig_Loader_Filesystem(ROOT_DIR.'/App/Ressources/views/');
        $viewFile = ROOT_DIR.'/App/Ressources/views/'.$view;
        if (file_exists($viewFile)) {
            $twig = new \Twig_Environment($loader, array(
                'debug' => true,
            ));
            $twig->addExtension(new \Twig_Extension_Debug());

            echo $twig->render($view, array_merge($params, [
                'ROOT_URL' => ROOT_URL,
                'BASE_URL' => BASE_URL,
                'ROOT_DIR' => ROOT_DIR
            ]));
        } else {
            throw new NotFoundException('Template '.$view.' not found');
        }
    }
}