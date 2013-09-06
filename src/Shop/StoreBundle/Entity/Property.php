<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Property
 *
 * @ORM\Table(name="Property")
 * @ORM\Entity(repositoryClass="Shop\StoreBundle\Repository\PropertyRepository")
 */
class Property
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
     * @ORM\OneToMany(targetEntity="PropertyValues", mappedBy="Property")
     */
    protected $Property_values;

    public function __construct()
    {
        $this->Property_values = new ArrayCollection();
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
     * @return Property
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
     * @return Property
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
     * Add Property_values
     *
     * @param \Shop\StoreBundle\Entity\PropertyValues $PropertyValues
     * @return Property
     */
    public function addPropertyValue(\Shop\StoreBundle\Entity\PropertyValues $PropertyValues)
    {
        $this->Property_values[] = $PropertyValues;
    
        return $this;
    }

    /**
     * Remove Property_values
     *
     * @param \Shop\StoreBundle\Entity\PropertyValues $PropertyValues
     */
    public function removePropertyValue(\Shop\StoreBundle\Entity\PropertyValues $PropertyValues)
    {
        $this->Property_values->removeElement($PropertyValues);
    }

    /**
     * Get Property_values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPropertyValues()
    {
        return $this->Property_values;
    }
}
