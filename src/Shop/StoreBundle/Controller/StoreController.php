<?php

namespace Shop\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopStoreBundle:Store:index.html.twig');
    }

}
