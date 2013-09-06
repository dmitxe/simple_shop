<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Shop\StoreBundle\Entity\Property;
use Shop\StoreBundle\Repository\PropertyValuesRepository;

/**
 * @ORM\Entity(repositoryClass="Shop\StoreBundle\Repository\PropertyValuesRepository")
 * @ORM\Table(name="Property_values")
 */
class PropertyValues
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
     * @ORM\Column(name="property_id", type="integer")
     */
    private $property_id;

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
     * @ORM\ManyToOne(targetEntity="Shop\StoreBundle\Entity\Property", inversedBy="Property_values")
     * @ORM\JoinColumn(name="property_id", referencedColumnName="id")
     */
    protected $Property;
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
     * @return PropertyValues
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
     * Set property_id
     *
     * @param integer $PropertyId
     * @return PropertyValues
     */
    public function setPropertyId($PropertyId)
    {
        $this->property_id = $PropertyId;
    
        return $this;
    }

    /**
     * Get property_id
     *
     * @return integer 
     */
    public function getPropertyId()
    {
        return $this->property_id;
    }

 

    /**
     * Set Property
     *
     * @param Property $Property
     * @return PropertyValues
     */
    public function setProperty(Property $Property = null)
    {
        $this->Property = $Property;
    
        return $this;
    }

    /**
     * Get Property
     *
     * @return Property
     */
    public function getProperty()
    {
        return $this->Property;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return PropertyValues
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
