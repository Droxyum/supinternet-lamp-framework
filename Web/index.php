<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 13/01/2016
 * Time: 11:39
 */

require_once '../vendor/autoload.php';

define('ROOT_URL', str_replace('/index.php', '' , $_SERVER['SCRIPT_NAME']));
define('BASE_URL', str_replace('/Web', '' , ROOT_URL));
define('ROOT_DIR', str_replace('/Web/index.php', '' , $_SERVER['SCRIPT_FILENAME']));

$Kernel = new \Core\Kernel();