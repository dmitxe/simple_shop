<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PropertyValuesRepository extends EntityRepository
{
    /**
     * @param integer $id_Property
     * @return EntityRepository|null
     */
    public function findAllPropertyValues($id_Property,$offset,$limit)//не работает
    {
        $q = " SELECT ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " join ShopStoreBundle:Property AS a where ta.property_id=" . $id_Property;
        $q .= " order by ta.property_id, ta.position";
       $limit=5;
        return $this->getEntityManager()->createQuery($q)
       //     ->setFirstResult($offset)
            ->setMaxResults(6)
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
    public function findUpPropertyValues($id,$property_id,$position)
    {
        $q = " SELECT  ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " where ta.id <> :id and ta.position <= :pos and ta.property_id = :property_id";
        $q .= " order by ta.property_id,ta.position desc ";
        $res = $this->getEntityManager()->createQuery($q)
            ->setMaxResults(1)
            ->setParameters( array('id'=>$id,'pos'=>$position,'property_id'=>$property_id))
            ->getResult();
        if( count($res)>0)  return $res[0];
        else return $res;
    }
    /**
     * @param integer $id
     * @param integer $position
     * @return EntityRepository|null
     */
    public function findDownPropertyValues($id,$property_id,$position)
    {
        $q = " SELECT  ta  FROM ShopStoreBundle:PropertyValues AS ta";
        $q .= " where ta.id <> :id and ta.position >= :pos and ta.property_id = :property_id";
        $q .= " order by ta.property_id,ta.position ";
        $res = $this->getEntityManager()->createQuery($q)
            ->setMaxResults(1)
            ->setParameters( array('id'=>$id,'pos'=>$position,'property_id'=>$property_id,))
            ->getResult();
        if( count($res)>0)  return $res[0];
        else return $res;
    }

    public function connectDBAL($message_error)
    {
        if ('mysql' != $this->_em->getConnection()->getDatabasePlatform()->getName())
        {
            throw new \Exception($message_error);
            return false;
        }
        return true;
    }

    public function findAllPropertyValuesDbal($id_Property,$offset,$limit)
    {
       if( $this->connectDBAL('findAllPropertyValuesDBAL') )
       {
           $q = " SELECT pv.*, p.name FROM property_values AS pv";
           $q .= " join property AS p on pv.property_id=p.id  where pv.property_id=" . $id_Property;
           $q .= " order by pv.property_id, pv.position limit " . $offset . "," . $limit;
           $res = $this->_em->getConnection()->fetchAll($q);
           return $res;
       }
       else  return array();
    }
}

