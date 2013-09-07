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
        $q .= " join ShopStoreBundle:Property AS a where ta.property_id=" . $id_Property;
        $q .= " order by ta.property_id, ta.position";
        return $this->getEntityManager()->createQuery($q)->getResult();
    }
    /**
     * @param integer $id_Property
     * @return EntityRepository|null
     */
    public function findCountPropertyValues($id_Property)
    {
        $q = " SELECT  COUNT(ta.id) as kol  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " where ta.property_id = :id";
        return $this->getEntityManager()->createQuery($q)->setParameter('id', $id_Property)->getSingleScalarResult();
    }
}

