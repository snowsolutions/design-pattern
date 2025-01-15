<?php
namespace SymfonyApp\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "SymfonyApp\\Repository\\UserRepository")]
#[ORM\Table(name: "users")]
#[ORM\Index(name: "user_id_index", columns: ["id"])]
class User
{
    #[ORM\Id]
    #[ORM\Column(name: "id", type: "integer", nullable: false, options: ["unsigned" => true])]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private readonly int $id;

    #[ORM\Column(name: "name", type: "string", length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(name: "phone", type: "string", length: 255, nullable: false)]
    private string $phone;

    #[ORM\Column(name: "email", type: "string", length: 255, nullable: false)]
    private string $email;

    #[ORM\Column(name: "password", type: "string", length: 255, nullable: false)]
    private string $password;

    #[ORM\Column(name: "source", type: "string", length: 255, nullable: false)]
    private string $source;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
