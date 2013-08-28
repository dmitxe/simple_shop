<?php

namespace Shop\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ShopSite/Admin/index.html.twig', [

        ]);
    }
}
