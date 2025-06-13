<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Trait\TraitId;
use App\Entity\Trait\TraitDateCreation;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TraitId;
    use TraitDateCreation;

    const ROLE_USER = 'ROLE_USER';

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    public string $username;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    public string $email;

    #[ORM\Column(type: 'string', length: 255)]
    public string $password;

    #[ORM\Column(type: 'json')]
    public array $roles;

    #[ORM\ManyToMany(targetEntity: Game::class)]
    public Collection $games;

    #[ORM\ManyToMany(targetEntity: Game::class)]
    #[ORM\JoinTable(name: 'user_wishlist')]
    public Collection $wishlist;

    public function __construct()
    {
        $this->roles = [self::ROLE_USER];
        $this->games = new ArrayCollection();
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getGames(): Collection
    {
        return $this->games;
    }

    public function setGames(Collection $games): self
    {
        $this->games = $games;
        return $this;
    }

    public function getWishlist(): Collection
    {
        return $this->wishlist;
    }

    public function setWishlist(Collection $wishlist): self
    {
        $this->wishlist = $wishlist;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function eraseCredentials(): void
    {
        $this->password = '';
    }

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->setDateCreation(new DateTime());
    }
}