<?php

namespace Shop\AttrebutesBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AttributeRepository extends EntityRepository
{
    /**
     * @param string $tableAttribute
     * @return EntityRepository|null
     */
    public function findall_attributes($tableAttribute)
    {
        return $this->_em->createQuery("
            SELECT a
            FROM {$tableAttribute} AS a
            ORDER BY a.id
        ");
    }



}
