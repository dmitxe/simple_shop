<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Attribute
 *
 * @ORM\Table(name="attribute")
 * @ORM\Entity(repositoryClass="Shop\StoreBundle\Repository\AttributeRepository")
 */
class Attribute
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_value", type="smallint")
     */
    private $type_value;

    /**
     * @ORM\OneToMany(targetEntity="AttributeValues", mappedBy="Attribute")
     */
    protected $attribute_values;

    public function __construct()
    {
        $this->attribute_values = new ArrayCollection();
    }
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
     * Set name
     *
     * @param string $name
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type_value
     *
     * @param integer $typeValue
     * @return Attribute
     */
    public function setTypeValue($typeValue)
    {
        $this->type_value = $typeValue;
    
        return $this;
    }

    /**
     * Get type_value
     *
     * @return integer 
     */
    public function getTypeValue()
    {
        return $this->type_value;
    }

    /**
     * Add attribute_values
     *
     * @param \Shop\StoreBundle\Entity\AttributeValues $attributeValues
     * @return Attribute
     */
    public function addAttributeValue(\Shop\StoreBundle\Entity\AttributeValues $attributeValues)
    {
        $this->attribute_values[] = $attributeValues;
    
        return $this;
    }

    /**
     * Remove attribute_values
     *
     * @param \Shop\StoreBundle\Entity\AttributeValues $attributeValues
     */
    public function removeAttributeValue(\Shop\StoreBundle\Entity\AttributeValues $attributeValues)
    {
        $this->attribute_values->removeElement($attributeValues);
    }

    /**
     * Get attribute_values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttributeValues()
    {
        return $this->attribute_values;
    }
}
