<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestaurantRepository")
 */
class Restaurant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $ville;

     /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $site_web;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $horaires;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $type;

    /**
     * @ORM\Column(type="string")
     */
    private $photo;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entree", mappedBy="restaurant", cascade={"persist", "remove"})
     */
    private $entrees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plat", mappedBy="restaurant", cascade={"persist", "remove"})
     */
    private $plats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dessert", mappedBy="restaurant", cascade={"persist", "remove"})
     */
    private $desserts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Boisson", mappedBy="restaurant", cascade={"persist", "remove"})
     */
    private $boissons;

    public function __construct()
    {
        $this->entrees = new ArrayCollection();
        $this->plats = new ArrayCollection();
        $this->desserts = new ArrayCollection();
        $this->boissons = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(string $site_web): self
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): self
    {
        $this->horaires = $horaires;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }


    /**
     * @return Collection|Entrees[]
     */
    public function getEntrees(): Collection
    {
        return $this->entrees;
    }

    public function addEntree(Entree $entrees): self
    {
        if (!$this->entrees->contains($entrees)) {
            $this->entrees[] = $entrees;
            $entrees->setRestaurant($this);
        }

        return $this;
    }

    public function removeEntree(Entree $entrees): self
    {
        if ($this->entrees->contains($entrees)) {
            $this->entrees->removeElement($entrees);
            // set the owning side to null (unless already changed)
            if ($entrees->getRestaurant() === $this) {
                $entrees->setRestaurant(null);
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

    public function addPlat(Entree $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats[] = $plat;
            $plat->setRestaurant($this);
        }

        return $this;
    }

    public function removePlat(Entree $plat): self
    {
        if ($this->plats->contains($plat)) {
            $this->plats->removeElement($plat);
            // set the owning side to null (unless already changed)
            if ($plat->getRestaurant() === $this) {
                $plat->setRestaurant(null);
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

    public function addDessert(Entree $dessert): self
    {
        if (!$this->desserts->contains($dessert)) {
            $this->desserts[] = $dessert;
            $dessert->setRestaurant($this);
        }

        return $this;
    }

    public function removeDessert(Entree $dessert): self
    {
        if ($this->desserts->contains($dessert)) {
            $this->desserts->removeElement($dessert);
            // set the owning side to null (unless already changed)
            if ($dessert->getRestaurant() === $this) {
                $dessert->setRestaurant(null);
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

    public function addBoisson(Entree $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
            $boisson->setRestaurant($this);
        }

        return $this;
    }

    public function removeBoisson(Entree $boisson): self
    {
        if ($this->boissons->contains($boisson)) {
            $this->boissons->removeElement($boisson);
            // set the owning side to null (unless already changed)
            if ($boisson->getRestaurant() === $this) {
                $boisson->setRestaurant(null);
            }
        }

        return $this;
    }
}
