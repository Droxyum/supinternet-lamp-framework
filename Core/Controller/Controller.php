<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 10:23
 */

namespace Core\Controller;


use Core\DIC\DIC;
use Core\Http\Request\Request;
use Core\Loader\ConfigLoader;
use Core\Orm\Orm;

/**
 * Class Controller
 * @package Core\Controller
 */
class Controller
{
    /**
     * @var Request
     */
    protected $Request;
    /**
     * @var Orm
     */
    protected $Orm;
    /**
     * @var DIC
     */
    protected $container;

    /**
     * Controller constructor.
     * @param Request $Request
     */
    public function __construct(Request $Request) {
        $this->Request = $Request;
        $this->Orm = new Orm();
        $this->container = new DIC();
        $this->fillContainer();
    }

    private function fillContainer() {
        $this->container->setInstance($this->Request);
        $this->container->setInstance($this->Orm);
    }

    /**
     * @param $routeName
     * @param array $params
     * @return string
     */
    public function generateUrl($routeName, $params = []) {
        $Loader = new ConfigLoader();
        $Routing = $Loader->load('routing');
        $Routing = $Routing[$routeName];
        $pattern = $Routing['path'];
        foreach ($params as $k => $v) {
            $pattern = str_replace(':'.$k, $v, $pattern);
        }
        return BASE_URL.$pattern;
    }
}