<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Game;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BoardGameService
{
    private HttpClientInterface $boardGameGeekClient;

    private EntityManagerInterface $entityManager;

    public function __construct(HttpClientInterface $boardGameGeekClient, EntityManagerInterface $entityManager)
    {
        $this->boardGameGeekClient = $boardGameGeekClient;
        $this->entityManager = $entityManager;
    }

    public function loadBoardGames(): void
    {
        $response = $this->boardGameGeekClient->request('GET', 'thing?id=1234');

        $responseXml = simplexml_load_string($response->getContent());

        $responseJson = json_encode($responseXml, JSON_THROW_ON_ERROR);
        $responseArray = json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
        
        $gameData = $responseArray['item'];

        $game = new Game();
        $game->setName($gameData['name'][0]['@attributes']['value']);
        $game->setNameFr($gameData['name'][8]['@attributes']['value']);
        $game->setDescription($gameData['description']);
        $game->setPublicationYear(DateTime::createFromFormat('Y', $gameData['yearpublished']['@attributes']['value']));
        $game->setPlayersMin((int)$gameData['minplayers']['@attributes']['value']);
        $game->setPlayersMax((int)$gameData['maxplayers']['@attributes']['value']);
        $game->setPlaytimeMin((int)$gameData['minplaytime']['@attributes']['value']);
        $game->setPlaytimeMax((int)$gameData['maxplaytime']['@attributes']['value']);

        $this->entityManager->persist($game);
        $this->entityManager->flush();
    }
}