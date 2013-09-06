<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AttributeValuesRepository extends EntityRepository
{
    /**
     * @param integer $id_attribute
     * @return EntityRepository|null
     */
    public function findAllAttributeValues($id_attribute)
    {
        $q = " SELECT ta  FROM ShopStoreBundle:AttributeValues AS ta";
        $q .= " join ShopStoreBundle:Attribute AS a where ta.attribute_id=" . $id_attribute;
        return $this->getEntityManager()->createQuery($q)->getResult();
    }
    /**
     * @param integer $id_attribute
     * @return EntityRepository|null
     */
    public function findCountAttributeValues($id_attribute)
    {
        $q = " SELECT  COUNT(ta.id) as kol  FROM ShopStoreBundle:AttributeValues AS ta";
        $q .= " where ta.attribute_id = :id";
        return $this->getEntityManager()->createQuery($q)->setParameter('id', $id_attribute)->getSingleScalarResult();
    }
}

