<?php

namespace Shop\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Shop\StoreBundle\Repository\TableAttributeRepository")
 * @ORM\Table(name="table_attribute")
 */
class TableAttribute
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
     * @ORM\Column(name="nom", type="integer")
     */
    private $nom;


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
     * @return TableAttribute
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
     * Set nom
     *
     * @param integer $nom
     * @return TableAttribute
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return integer 
     */
    public function getNom()
    {
        return $this->nom;
    }



    /**
     * Set attribute_id
     *
     * @param integer $attributeId
     * @return TableAttribute
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
}