<?php

namespace Shop\StoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TableAttributeRepository extends EntityRepository
{
    /**
     * @param integer $id_attribute
     * @return EntityRepository|null
     */
    public function findAll_attribute_values($id_attribute)
    { $q=" SELECT ta  FROM ShopStoreBundle:TableAttribute AS ta";
      $q.=" join ShopStoreBundle:Attribute AS a where ta.attribute_id=".$id_attribute;
      return $this->getEntityManager()->createQuery($q)->getResult();
    }



}
