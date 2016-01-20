<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 11:48
 */

namespace Core\Orm;


use Core\Collection\StorageCollection;
use Core\Loader\ConfigLoader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Orm
{
    private static $em;

    public function __construct()
    {
        if (empty(self::$em)) {
            $ConfigLoader = new ConfigLoader();
            $Config = new StorageCollection($ConfigLoader->load('parameters'));
            $Config = $Config->get('orm');

            $EntityPath = array(ROOT_DIR.'/App/Entity');
            $isDevMode = ($Config->get('devmode')) ? $Config->get('devmode') : false;

            $dbParams = array(
                'driver'   => $Config->get('driver'),
                'user'     => $Config->get('username'),
                'password' => $Config->get('password'),
                'dbname'   => $Config->get('database'),
            );

            $config = Setup::createAnnotationMetadataConfiguration($EntityPath, $isDevMode);
            self::$em = EntityManager::create($dbParams, $config);
        }
    }

    public function getEntityManager() {
        return self::$em;
    }
}