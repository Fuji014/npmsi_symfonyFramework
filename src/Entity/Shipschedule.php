<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShipscheduleRepository")
 */
class Shipschedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shiptype", inversedBy="Shipschedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Shiptype;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Leavingtime;

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

    public function getLeavingtime(): ?string
    {
        return $this->Leavingtime;
    }

    public function setLeavingtime(string $Leavingtime): self
    {
        $this->Leavingtime = $Leavingtime;

        return $this;
    }
}
