<?php

namespace Acme\RecipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table(name="ingredient")
 * @ORM\Entity
 */
class Ingredient {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="dimension", type="string", length=20, nullable=false)
     */
    private $dimension;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Ingredient
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set dimension
     *
     * @param string $dimension
     * @return Ingredient
     */
    public function setDimension($dimension) {
        $this->dimension = $dimension;

        return $this;
    }

    /**
     * Get dimension
     *
     * @return string 
     */
    public function getDimension() {
        return $this->dimension;
    }

    public function __toString() {
        return (string) $this->getName();
    }

}
