<?php

namespace Shop\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopSiteBundle:Page:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('ShopSiteBundle:Page:about.html.twig');
    }

    public function contactsAction()
    {
        return $this->render('ShopSiteBundle:Page:contacts.html.twig');
    }
}
