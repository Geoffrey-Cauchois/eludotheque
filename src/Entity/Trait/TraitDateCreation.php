<?php

declare(strict_types=1);

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

trait TraitDateCreation
{
    #[ORM\Column(type: 'datetime')]
    private DateTime $dateCreation;

    /**
     * Get the value of id
     */
    public function getDateCreation(): DateTime
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of id
     */
    public function setDateCreation(DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }
}