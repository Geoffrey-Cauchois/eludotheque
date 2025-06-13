<?php

namespace App\DataFixtures\Data;

use App\Entity\Game;
use Faker\Factory;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Generator;

class GameFixtures
{
    private EntityManagerInterface $entityManager;
    private Generator $faker;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->faker = Factory::create();
        $this->entityManager = $entityManager;
    }

    public function load(): void
    {
        for ($gameIndex = 0; $gameIndex < 10; $gameIndex++) {
            $game = new Game();
            $game->setName($this->faker->word);
            $game->setNameFr($game->getName());
            $game->setDescription($this->faker->text(500));
            $game->setPublicationYear(new \DateTime($this->faker->date()));
            $game->setPlayersMin($this->faker->numberBetween(1, 4));
            $game->setPlayersMax($game->getPlayersMin() + $this->faker->numberBetween(2, 5));
            $game->setPlaytimeMin($this->faker->numberBetween(10, 120));
            $game->setPlaytimeMax($game->getPlaytimeMin() + $this->faker->numberBetween(10, 60));

            $this->entityManager->persist($game);
        }

        $this->entityManager->flush();
    }
}