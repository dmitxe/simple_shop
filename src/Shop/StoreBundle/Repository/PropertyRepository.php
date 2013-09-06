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
}
