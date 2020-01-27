<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShiptypeRepository")
 */
class Shiptype
{
    public function __toString()
    {
        return $this->Shipname;
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Shipname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Shipcontent;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Shipimage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shipschedule", mappedBy="shiptype")
     */
    private $shipschedules;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Shipticket", mappedBy="Shiptype")
     */
    private $shiptickets;

    public function __construct()
    {
        $this->shipschedules = new ArrayCollection();
        $this->shiptickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShipname(): ?string
    {
        return $this->Shipname;
    }

    public function setShipname(string $Shipname): self
    {
        $this->Shipname = $Shipname;

        return $this;
    }
    public function getShipimage(): ?string
    {
        return $this->Shipimage;
    }

    public function setShipimage(string $Shipimage): self
    {
        $this->Shipimage = $Shipimage;

        return $this;
    }

    public function getShipcontent(): ?string
    {
        return $this->Shipcontent;
    }

    public function setShipcontent(string $Shipcontent): self
    {
        $this->Shipcontent = $Shipcontent;

        return $this;
    }

    /**
     * @return Collection|Shipschedule[]
     */
    public function getShipschedules(): Collection
    {
        return $this->shipschedules;
    }

    public function addShipschedule(Shipschedule $shipschedule): self
    {
        if (!$this->shipschedules->contains($shipschedule)) {
            $this->shipschedules[] = $shipschedule;
            $shipschedule->setShiptype($this);
        }

        return $this;
    }

    public function removeShipschedule(Shipschedule $shipschedule): self
    {
        if ($this->shipschedules->contains($shipschedule)) {
            $this->shipschedules->removeElement($shipschedule);
            // set the owning side to null (unless already changed)
            if ($shipschedule->getShiptype() === $this) {
                $shipschedule->setShiptype(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Shipticket[]
     */
    public function getShiptickets(): Collection
    {
        return $this->shiptickets;
    }

    public function addShipticket(Shipticket $shipticket): self
    {
        if (!$this->shiptickets->contains($shipticket)) {
            $this->shiptickets[] = $shipticket;
            $shipticket->setShiptype($this);
        }

        return $this;
    }

    public function removeShipticket(Shipticket $shipticket): self
    {
        if ($this->shiptickets->contains($shipticket)) {
            $this->shiptickets->removeElement($shipticket);
            // set the owning side to null (unless already changed)
            if ($shipticket->getShiptype() === $this) {
                $shipticket->setShiptype(null);
            }
        }

        return $this;
    }
}
