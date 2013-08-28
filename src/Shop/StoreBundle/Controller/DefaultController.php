<?php

namespace Shop\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ShopStoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
