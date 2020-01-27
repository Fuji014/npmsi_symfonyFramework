<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Message should not be blank")
     * @Assert\Length(min=11, minMessage = "Your number name must be at least {{ limit }} digit long")
     * @Assert\Length(max=12, maxMessage = "Your number cannot be longer than {{ limit }} digit")
     */
    private $Cellnumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Firstname should not be blank")
     * @Assert\Length(min=1, minMessage = "Your first name must be at least {{ limit }} characters long")
     * @Assert\Length(max=255, maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     */
    private $Number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Firstname should not be blank")
     * @Assert\Length(min=2, minMessage = "Your Message must be at least {{ limit }} characters long")
     * @Assert\Length(max=255, maxMessage = "Your Message cannot be longer than {{ limit }} characters")
     */
    private $Message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCellnumber(): ?string
    {
        return $this->Cellnumber;
    }

    public function setCellnumber(string $Cellnumber): self
    {
        $this->Cellnumber = $Cellnumber;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(string $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }
}
