<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_attribute")
 */
class ProductAttribute
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_product", type="integer")
     */
    private $id_product;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_attribute", type="integer")
     */
    private $id_attribute;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=256)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="search_value", type="integer")
     */
    private $search_value;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id_product
     *
     * @param integer $idProduct
     * @return ProductAttribute
     */
    public function setIdProduct($idProduct)
    {
        $this->id_product = $idProduct;
    
        return $this;
    }

    /**
     * Get id_product
     *
     * @return integer 
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * Set id_attribute
     *
     * @param integer $idAttribute
     * @return ProductAttribute
     */
    public function setIdAttribute($idAttribute)
    {
        $this->id_attribute = $idAttribute;
    
        return $this;
    }

    /**
     * Get id_attribute
     *
     * @return integer 
     */
    public function getIdAttribute()
    {
        return $this->id_attribute;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return ProductAttribute
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set search_value
     *
     * @param integer $searchValue
     * @return ProductAttribute
     */
    public function setSearchValue($searchValue)
    {
        $this->search_value = $searchValue;
    
        return $this;
    }

    /**
     * Get search_value
     *
     * @return integer 
     */
    public function getSearchValue()
    {
        return $this->search_value;
    }
}