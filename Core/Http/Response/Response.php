<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 11:08
 */

namespace Core\Http\Response;


use Core\Exception\NotFoundException;
use Core\Twig\Router;

/**
 * Class Response
 * @package Core\Http\Response
 */
class Response
{
    /**
     * Response constructor.
     * @param $view
     * @param array $params
     * @throws NotFoundException
     */
    public function __construct($view, $params = [])
    {
        $loader = new \Twig_Loader_Filesystem(ROOT_DIR.'/App/Ressources/views/');
        $viewFile = ROOT_DIR.'/App/Ressources/views/'.$view;
        if (file_exists($viewFile)) {
            $twig = new \Twig_Environment($loader);
            $twig->addExtension(new \Twig_Extension_Debug());
            $twig->addExtension(new Router());

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