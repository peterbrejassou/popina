<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

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
    public function __construct($id, $slug, $nom, $restaurants)
    {
        $this->id = $id;
        $this->slug = $slug;
        $this->nom = $nom;
        $this->restaurants = $restaurants;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
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
