<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Trait\TraitId;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Game
{
    use TraitId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $nameFr;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'datetime')]
    private DateTime $publicationYear;

    #[ORM\Column(type: 'integer')]
    private int $playersMin;

    #[ORM\Column(type: 'integer')]
    private int $playersMax;

    #[ORM\Column(type: 'integer')]
    private int $playtimeMin;

    #[ORM\Column(type: 'integer')]
    private int $playtimeMax;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNameFr(): string
    {
        return $this->nameFr;
    }

    public function setNameFr(string $nameFr): self
    {
        $this->nameFr = $nameFr;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPublicationYear(): DateTime
    {
        return $this->publicationYear;
    }

    public function setPublicationYear(DateTime $publicationYear): self
    {
        $this->publicationYear = $publicationYear;
        return $this;
    }

    public function getPlayersMin(): int
    {
        return $this->playersMin;
    }

    public function setPlayersMin(int $playersMin): self
    {
        $this->playersMin = $playersMin;
        return $this;
    }

    public function getPlayersMax(): int
    {
        return $this->playersMax;
    }

    public function setPlayersMax(int $playersMax): self
    {
        $this->playersMax = $playersMax;
        return $this;
    }

    public function getPlaytimeMin(): int
    {
        return $this->playtimeMin;
    }

    public function setPlaytimeMin(int $playtimeMin): self
    {
        $this->playtimeMin = $playtimeMin;
        return $this;
    }

    public function getPlaytimeMax(): int
    {
        return $this->playtimeMax;
    }

    public function setPlaytimeMax(int $playtimeMax): self
    {
        $this->playtimeMax = $playtimeMax;
        return $this;
    }

    //TODO: images
}