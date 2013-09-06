<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PropertyValuesRepository extends EntityRepository
{
    /**
     * @param integer $id_Property
     * @return EntityRepository|null
     */
    public function findAllPropertyValues($id_Property)
    {
        $q = " SELECT ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " join ShopStoreBundle:Property AS a where ta.Property_id=" . $id_Property;
        return $this->getEntityManager()->createQuery($q)->getResult();
    }
    /**
     * @param integer $id_Property
     * @return EntityRepository|null
     */
    public function findCountPropertyValues($id_Property)
    {
        $q = " SELECT  COUNT(ta.id) as kol  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " where ta.Property_id = :id";
        return $this->getEntityManager()->createQuery($q)->setParameter('id', $id_Property)->getSingleScalarResult();
    }
}

