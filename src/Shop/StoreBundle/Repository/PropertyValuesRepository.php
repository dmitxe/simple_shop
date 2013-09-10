<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PropertyValuesRepository extends EntityRepository
{
    /**
     * @param integer $id_Property
     * @return EntityRepository|null
     */
    public function findAllPropertyValues($id_Property,$offset,$limit)
    {
        $q = " SELECT ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " join ShopStoreBundle:Property AS a where ta.property_id=" . $id_Property;
        $q .= " order by ta.property_id, ta.position";
        return $this->getEntityManager()->createQuery($q)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getResult();
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
    /**
     * @param integer $id
     * @param integer $position
     * @return EntityRepository|null
     */
    public function findUpPropertyValues($id,$position)
    {
        $q = " SELECT  ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " where ta.id <> :id and ta.position <= :pos";
        $q .= " order by ta.property_id,ta.position desc ";
        $res = $this->getEntityManager()->createQuery($q)
            ->setMaxResults(1)
            ->setParameters( array('id'=>$id,'pos'=>$position,))
            ->getResult();
        if( count($res)>0)  return $res[0];
        else return $res;
    }
    /**
     * @param integer $id
     * @param integer $position
     * @return EntityRepository|null
     */
    public function findDownPropertyValues($id,$position)
    {
        $q = " SELECT  ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " where ta.id <> :id and ta.position >= :pos";
        $q .= " order by ta.property_id,ta.position ";
        $res = $this->getEntityManager()->createQuery($q)
            ->setMaxResults(1)
            ->setParameters( array('id'=>$id,'pos'=>$position,))
            ->getResult();
        if( count($res)>0)  return $res[0];
        else return $res;
    }
}

