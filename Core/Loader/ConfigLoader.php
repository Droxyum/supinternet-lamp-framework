<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 09:42
 */

namespace Core\Loader;


use Core\Exception\NotFoundException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigLoader
 * @package Core\Loader
 */
class ConfigLoader
{
    /**
     * @param $config
     * @return array|bool
     */
    public function load($config) {
        $file = ROOT_DIR.'/App/Config/'.$config.'.yml';
        if (file_exists($file)) {
            return Yaml::parse(file_get_contents($file));
        }
        return false;
    }
}