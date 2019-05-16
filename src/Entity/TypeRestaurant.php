<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRestaurantRepository")
 */
class TypeRestaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Restaurant", mappedBy="type", cascade={"persist", "remove"})
     */
    private $restaurants;

    /**
     * TypeRestaurant constructor.
     * @param $id
     * @param $nom
     * @param $slug
     * @param $restaurants
     */
    public function __construct($id, $nom, $slug, $restaurants)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->slug = $slug;
        $this->restaurants = $restaurants;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function getRestaurants()
    {
        return $this->restaurants;
    }

    public function setRestaurants($restaurants): void
    {
        $this->restaurants = $restaurants;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
