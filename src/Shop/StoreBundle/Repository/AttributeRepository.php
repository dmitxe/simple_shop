<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AttributeRepository extends EntityRepository
{
    /**
     * @param string $attributeValues
     * @return EntityRepository|null
     */
    public function findall_attributes($attributeValues)
    {
        return $this->_em->createQuery("
            SELECT a
            FROM {$attributeValues} AS a
            ORDER BY a.id
        ");
    }



}
