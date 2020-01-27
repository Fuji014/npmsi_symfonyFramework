<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactusRepository")
 */
class Contactus
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
     * @Assert\Length(min=2, minMessage = "Your  Name must be at least {{ limit }} digit long")
     * @Assert\Length(max=255, maxMessage = "Your Number cannot be longer than {{ limit }} digit")
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Subject should not be blank")
     * @Assert\Length(min=2, minMessage = "Your Subject name must be at least {{ limit }} digit long")
     * @Assert\Length(max=255, maxMessage = "Your Subject cannot be longer than {{ limit }} digit")
     */
    private $Subject;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Content should not be blank")
     * @Assert\Length(min=2, minMessage = "Your Content name must be at least {{ limit }} digit long")
     * @Assert\Length(max=1000, maxMessage = "Your Content cannot be longer than {{ limit }} digit")
     */
    private $Content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;
    /**
     * @ORM\Column(type="string")
     */
    private $Status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

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
