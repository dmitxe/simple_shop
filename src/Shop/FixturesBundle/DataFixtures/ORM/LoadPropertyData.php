<?php

namespace Shop\FixturesBundle\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Shop\StoreBundle\Entity\Property;

class LoadPropertyData extends ContainerAware implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder(new Property());

        $property = new Property;
        $property->setName('цвет')->setTypeValue('2');
        $manager->persist($property);

        $property = new Property;
        $property->setName('Вес')->setTypeValue('1');
        $manager->persist($property);

        $property = new Property;
        $property->setName('размер обуви')->setTypeValue('0');
        $manager->persist($property);

        $property = new Property;
        $property->setName('размер брюк')->setTypeValue('0');
        $manager->persist($property);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
