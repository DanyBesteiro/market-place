<?php

namespace App\Controller;

use App\UseCases\Search\Films\SearchFilmsByName;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SearchFilmController extends AbstractController
{
    #[Route('/search_film/{filmName}', name: 'app_search')]
    public function index(
        SearchFilmsByName $filmsSearcher,
        string $filmName
    ): JsonResponse {
        return new JsonResponse(
          data: $filmsSearcher->execute($filmName),
          status: 200
        );
    }
}
