<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\StoreBundle\Repository\AttributeValuesRepository")
 * @ORM\Table(name="attribute_values")
 */
class AttributeValues
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
     * @ORM\Column(name="attribute_id", type="integer")
     */
    private $attribute_id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=128)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Attribute", inversedBy="attribute_values")
     * @ORM\JoinColumn(name="attribute_id", referencedColumnName="id")
     */
    protected $attribute;
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
     * Set value
     *
     * @param string $value
     * @return AttributeValues
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
     * Set attribute_id
     *
     * @param integer $attributeId
     * @return AttributeValues
     */
    public function setAttributeId($attributeId)
    {
        $this->attribute_id = $attributeId;
    
        return $this;
    }

    /**
     * Get attribute_id
     *
     * @return integer 
     */
    public function getAttributeId()
    {
        return $this->attribute_id;
    }

 

    /**
     * Set attribute
     *
     * @param \Shop\StoreBundle\Entity\Attribute $attribute
     * @return AttributeValues
     */
    public function setAttribute(\Shop\StoreBundle\Entity\Attribute $attribute = null)
    {
        $this->attribute = $attribute;
    
        return $this;
    }

    /**
     * Get attribute
     *
     * @return \Shop\StoreBundle\Entity\Attribute 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return AttributeValues
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }
}
