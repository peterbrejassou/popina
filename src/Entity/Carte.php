<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 */
class Carte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entree", mappedBy="carte", cascade={"persist", "remove"})
     */
    private $entrees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plat", mappedBy="carte", cascade={"persist", "remove"})
     */
    private $plats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dessert", mappedBy="carte", cascade={"persist", "remove"})
     */
    private $desserts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Boisson", mappedBy="carte", cascade={"persist", "remove"})
     */
    private $boissons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Menu", mappedBy="carte", cascade={"persist", "remove"})
     */
    private $menus;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Restaurant", inversedBy="carte")
     */
    private $restaurant;

    public function __construct()
    {
        $this->entrees = new ArrayCollection();
        $this->plats = new ArrayCollection();
        $this->desserts = new ArrayCollection();
        $this->boissons = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Entrees[]
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(entrees $entrees): self
    {
        if (!$this->entrees->contains($entrees)) {
            $this->entrees[] = $entrees;
            $entrees->setEntree($this);
        }

        return $this;
    }

    public function removeEntree(entrees $entrees): self
    {
        if ($this->entrees->contains($entrees)) {
            $this->entrees->removeElement($entrees);
            // set the owning side to null (unless already changed)
            if ($entrees->getCarte() === $this) {
                $entrees->setCarte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(plat $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats[] = $plat;
            $plat->setCarte($this);
        }

        return $this;
    }

    public function removePlat(plat $plat): self
    {
        if ($this->plats->contains($plat)) {
            $this->plats->removeElement($plat);
            // set the owning side to null (unless already changed)
            if ($plat->getCarte() === $this) {
                $plat->setCarte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dessert[]
     */
    public function getDesserts(): Collection
    {
        return $this->desserts;
    }

    public function addDessert(dessert $dessert): self
    {
        if (!$this->desserts->contains($dessert)) {
            $this->desserts[] = $dessert;
            $dessert->setCarte($this);
        }

        return $this;
    }

    public function removeDessert(dessert $dessert): self
    {
        if ($this->desserts->contains($dessert)) {
            $this->desserts->removeElement($dessert);
            // set the owning side to null (unless already changed)
            if ($dessert->getCarte() === $this) {
                $dessert->setCarte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Boisson[]
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
            $boisson->setCarte($this);
        }

        return $this;
    }

    public function removeBoisson(boisson $boisson): self
    {
        if ($this->boissons->contains($boisson)) {
            $this->boissons->removeElement($boisson);
            // set the owning side to null (unless already changed)
            if ($boisson->getCarte() === $this) {
                $boisson->setCarte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setCarte($this);
        }

        return $this;
    }

    public function removeMenu(menu $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getCarte() === $this) {
                $menu->setCarte(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $restaurant
     */
    public function setRestaurant($restaurant): void
    {
        $this->restaurant = $restaurant;
    }
}
