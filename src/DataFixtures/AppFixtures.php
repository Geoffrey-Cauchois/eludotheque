<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Data\UserFixtures;
use App\DataFixtures\Data\GameFixtures;

class AppFixtures extends Fixture
{
    private UserFixtures $userFixtures;
    private GameFixtures $gameFixtures;

    public function __construct (UserFixtures $userFixtures, GameFixtures $gameFixtures) 
    {
        $this->userFixtures = $userFixtures;
        $this->gameFixtures = $gameFixtures;
    }

    public function load(ObjectManager $manager): void
    {
        $this->userFixtures->load();
        $this->gameFixtures->load();
    }
}
