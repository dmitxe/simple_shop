<?php

namespace Shop\FixturesBundle\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Shop\StoreBundle\Entity\PropertyValues;
use Shop\StoreBundle\Entity\Property;

class LoadPropertyValuesData extends ContainerAware implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $encoder = $this->container->get('security.encoder_factory')->getEncoder(new PropertyValues());

        $em = $this->container->get('doctrine.orm.default_entity_manager');
        $propertys = $em->getRepository('ShopStoreBundle:Property')->findAll([], ['id' => 'ASC']);
        foreach($propertys as $property)
        {
            switch ($property->name) :
                case 'цвет':
                {
                    $propertyValues = new PropertyValues();
                    $propertyValues->setPropertyId($property->id)
                        ->setValue('красный')
                        ->setPosition(1);
                    $manager->persist($propertyValues);

                    $propertyValues = new PropertyValues();
                    $propertyValues->setPropertyId($property->id)
                        ->setValue('желтый')
                        ->setPosition(2);
                    $manager->persist($propertyValues);

                    $propertyValues = new PropertyValues();
                    $propertyValues->setPropertyId($property->id)
                        ->setValue('синий')
                        ->setPosition(3);
                    $manager->persist($propertyValues);

                    break;
                };
                case 'Вес':
                {
                    $propertyValues = new PropertyValues();
                    $propertyValues->setPropertyId($property->id)
                        ->setValue(1)
                        ->setPosition(1);
                    $manager->persist($propertyValues);

                    $propertyValues = new PropertyValues();
                    $propertyValues->setPropertyId($property->id)
                        ->setValue(2)
                        ->setPosition(2);
                    $manager->persist($propertyValues);

                    $propertyValues = new PropertyValues();
                    $propertyValues->setPropertyId($property->id)
                        ->setValue(3)
                        ->setPosition(3);
                    $manager->persist($propertyValues);

                    break;
                 };
                 default :
                  {
                     $propertyValues = new PropertyValues();
                     $propertyValues->setPropertyId($property->id)
                         ->setValue(1)
                         ->setPosition(1);
                     $manager->persist($propertyValues);
                   }
            endswitch;
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }
}
