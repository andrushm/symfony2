<?php

namespace Acme\RecipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Composite
 *
 * @ORM\Table(name="composite")
 * @ORM\Entity
 */
class Composite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Acme\RecipeBundle\Entity\Recipe")
     * 
     */
    private $recipe;

    /**
     * @ORM\OneToOne(targetEntity="Acme\RecipeBundle\Entity\Ingredient")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     * 
     */
    private $ingredient;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="decimal", precision=11, scale=3, nullable=true)
     */
    private $quantity;



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
     * Set quantity
     *
     * @param string $quantity
     * @return Composite
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    
  /*  public function __toString() {
        return 'my';
    }*/

    /**
     * Get recipe
     *
     * @return \Acme\RecipeBundle\Entity\Recipe 
     */
    public function getRecipe()
    {
        return $this->recipe;
    }
   
   

    /**
     * Set ingredient
     *
     * @param \Acme\RecipeBundle\Entity\Ingredient $ingredient
     * @return Composite
     */
    public function setIngredient(\Acme\RecipeBundle\Entity\Ingredient $ingredient = null)
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get ingredient
     *
     * @return \Acme\RecipeBundle\Entity\Ingredient 
     */
    public function getIngredient()
    {
        return $this->ingredient;
    }
    
   

    /**
     * Set recipe
     *
     * @param \Acme\RecipeBundle\Entity\Recipe $recipe
     * @return Composite
     */
    public function setRecipe(\Acme\RecipeBundle\Entity\Recipe $recipe = null)
    {
        $this->recipe = $recipe;

        return $this;
    }
    
    public function __toString() {
         return $this->getIngredient()->getName();
    }
}
