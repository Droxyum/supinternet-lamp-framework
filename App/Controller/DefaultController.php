<?php
/**
 * Created by PhpStorm.
 * User: droxy
 * Date: 20/01/2016
 * Time: 10:32
 */

namespace App\Controller;


use App\Entity\Product;
use Core\Collection\StorageCollection;
use Core\Controller\Controller;
use Core\Http\Response\Response;

class DefaultController extends Controller
{
    public function index() {
        $Products = $this->Orm->getEntityManager()->getRepository('App\\Entity\\Product')->findAll();
        return new Response('Default/index.html.twig', [ 'Products' => $Products ]);
    }

    public function create() {
        $Request = $this->container->get('Core\\Http\\Request\\Request');

        if ($Request->getMethod() == 'POST') {
            $form = $Request->getPost()->get('form');
            if ($form->get('title') && $form->get('content')) {
                $em = $this->container->get('Core\\Orm\\Orm')->getEntityManager();
                $Product = new Product();
                $Product->setName($form->get('title'));
                $Product->setContent($form->get('content'));
                $em->persist($Product);
                $em->flush();
                $flash = "Added";
            } else {
                $flash = "Empty";
            }
        }

        return new Response('Default/create.html.twig', ['flash' => (!empty($flash)) ? $flash : '']);
    }

    public function post(StorageCollection $params) {
        $Product = $this->Orm->getEntityManager()->getRepository('App\\Entity\\Product')->find($params->get('id'));
        return new Response('Default/post.html.twig', [ 'Product' => $Product ]);
    }
}