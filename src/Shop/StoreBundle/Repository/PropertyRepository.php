<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PropertyRepository extends EntityRepository
{
    /**
     * @param string $PropertyValues
     * @return EntityRepository|null
     */
    public function findall_Propertys($PropertyValues)
    {
        return $this->_em->createQuery("
            SELECT a
            FROM {$PropertyValues} AS a
            ORDER BY a.id
        ");
    }
    /**
     * @return EntityRepository|null
     */
    public function findCountProperty()
    {
        $q = " SELECT  COUNT(p.id) as kol  FROM ShopStoreBundle:PropertyValues AS p";
        return $this->getEntityManager()->createQuery($q)->getSingleScalarResult();
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

    public function findAllPropertyDbal($offset,$limit)
    {
        if( $this->connectDBAL('findAllPropertyDBAL') )
        {
            $q = " SELECT p.* FROM property AS p";
            $q .= " order by p.name limit " . $offset . "," . $limit;
            $res = $this->_em->getConnection()->fetchAll($q);
            return $res;
        }
        else  return array();
    }
}

