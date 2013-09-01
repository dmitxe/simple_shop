<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attribute
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Shop\StoreBundle\Entity\AttributeRepository")
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
}