<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 10:32
 */

namespace App\Controller;


use Core\Collection\StorageCollection;
use Core\Controller\Controller;
use Core\Http\Response\Response;

class DefaultController extends Controller
{
    public function index(StorageCollection $params) {
        $Products = $this->Orm->getEntityManager()->getRepository('App\\Entity\\Product')->findAll();

        return new Response('Default/index.html.twig', [ 'Products' => $Products ]);
    }
}