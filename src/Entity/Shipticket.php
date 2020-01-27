<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipticketRepository")
 */
class Shipticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shiptype", inversedBy="shiptickets")
     */
    private $Shiptype;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Fullfare;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Studentfare;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Seniorfare;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pwdfare;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShiptype(): ?Shiptype
    {
        return $this->Shiptype;
    }

    public function setShiptype(?Shiptype $Shiptype): self
    {
        $this->Shiptype = $Shiptype;

        return $this;
    }

    public function getFullfare(): ?string
    {
        return $this->Fullfare;
    }

    public function setFullfare(string $Fullfare): self
    {
        $this->Fullfare = $Fullfare;

        return $this;
    }

    public function getStudentfare(): ?string
    {
        return $this->Studentfare;
    }

    public function setStudentfare(string $Studentfare): self
    {
        $this->Studentfare = $Studentfare;

        return $this;
    }

    public function getSeniorfare(): ?string
    {
        return $this->Seniorfare;
    }

    public function setSeniorfare(string $Seniorfare): self
    {
        $this->Seniorfare = $Seniorfare;

        return $this;
    }

    public function getPwdfare(): ?string
    {
        return $this->Pwdfare;
    }

    public function setPwdfare(string $Pwdfare): self
    {
        $this->Pwdfare = $Pwdfare;

        return $this;
    }
}
