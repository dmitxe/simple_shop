<?php

namespace Shop\StoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class AdminMenu extends ContainerAware
{
    /**
     * @param FactoryInterface $factory
     * @param array $options
     * @return \Knp\Menu\ItemInterface
     */
    public function main(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('site_admin_main');

        $menu->setChildrenAttribute('class', isset($options['class']) ? $options['class'] : 'nav nav-tabs');

        $menu->addChild('Общие',     ['route' => 'shop_store_admin']);
//        $menu->addChild('Свойства',  ['route' => $this->container->get('router')->
//            generate('shop_store_property', array('page' => 1))]);
        $menu->addChild('Свойства',  ['route' => 'shop_store_property', 'routeParameters' => ['page' => 1]]);

        return $menu;
    }
}
