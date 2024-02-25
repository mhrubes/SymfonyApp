<?php

namespace App\Entity;

use App\Repository\UserdataRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserdataRepository::class)]
class Userdata
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Assert\Length(min:3)]
    #[Assert\NotBlank(message: "not empty")]
    private ?string $firstname = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Assert\Length(min:3)]
    #[Assert\NotBlank(message: "not empty")]
    private ?string $lastname = null;

    #[ORM\Column(length: 45, nullable: true)]
    #[Assert\Length(min:3)]
    #[Assert\NotBlank(message: "not empty")]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }
}
