<?php

namespace Acme\RecipeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recipes
 *
 * @ORM\Table(name="recipe", indexes={@ORM\Index(name="user", columns={"user_id"}), @ORM\Index(name="composite", columns={"composite_id"})})
 * @ORM\Entity
 */
class Recipe
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \Acme\RecipeBundle\Entity\Composite
     *
     * @ORM\OneToMany(targetEntity="Acme\RecipeBundle\Entity\Composite", mappedBy="recipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="composite", referencedColumnName="id")
     * })
     */
    private $composite;

    /**
     * @var \Acme\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Acme\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * @return Recipes
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
     * Set created
     *
     * @param \DateTime $created
     * @return Recipes
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Recipes
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set composite
     *
     * @param \Acme\RecipeBundle\Entity\Composite $composite
     * @return Recipes
     */
    public function setComposite(\Acme\RecipeBundle\Entity\Composite $composite = null)
    {
        $this->composite = $composite;

        return $this;
    }

    /**
     * Get composite
     *
     * @return \Acme\RecipeBundle\Entity\Composite 
     */
    public function getComposite()
    {
        return $this->composite;
    }

    /**
     * Set user
     *
     * @param \Acme\UserBundle\Entity\User $user
     * @return Recipes
     */
    public function setUser(\Acme\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->composite = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add composite
     *
     * @param \Acme\RecipeBundle\Entity\Composite $composite
     * @return Recipe
     */
    public function addComposite(\Acme\RecipeBundle\Entity\Composite $composite)
    {
        $this->composite[] = $composite;

        return $this;
    }

    /**
     * Remove composite
     *
     * @param \Acme\RecipeBundle\Entity\Composite $composite
     */
    public function removeComposite(\Acme\RecipeBundle\Entity\Composite $composite)
    {
        $this->composite->removeElement($composite);
    }
}