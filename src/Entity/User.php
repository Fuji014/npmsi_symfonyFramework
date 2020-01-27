<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"Email"}, message="Username or Email is already taken")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="username should not be blank")
     * @Assert\Length(min=5, minMessage = "Your first Username must be at least {{ limit }} characters long")
     * @Assert\Length(max=15, maxMessage = "Your first Username cannot be longer than {{ limit }} characters")
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email();
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage = "Your first Password must be at least {{ limit }}  long")
     * @Assert\Length(max=255, maxMessage = "Your first Password cannot be longer than {{ limit }} ")
     */
    private $Password;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Token;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }
    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }    
    
    
    
    
    public function getRoles(){
        return [
            'ROLE_USER'
        ];
    }
    public function getSalt(){}
    public function eraseCredentials(){}

    public function getToken(): ?string
    {
        return $this->Token;
    }

    public function setToken(string $Token): self
    {
        $this->Token = $Token;

        return $this;
    }

}
