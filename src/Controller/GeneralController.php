<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\BoardGameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('', name: 'general_')]
class GeneralController extends AbstractController
{
    #[Route('', name: 'home')]
    public function home(BoardGameService $boardGameService): Response
    {
        return $this->render('general/home.html.twig');
    }

    #[Route('/load', name: 'load_games')]
    public function loadGames(BoardGameService $boardGameService): Response
    {
        $boardGameService->loadBoardGames();
        return $this->redirectToRoute('general_home');
    }
}