<?php

declare(strict_types=1);

namespace App\Controller\Films;

use App\Film\Application\SearchById\SearchFilmByIdQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class FilmByIdGetController extends AbstractController
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly SearchFilmByIdQuery $searchFilmByIdQuery
    ) {
    }

    public function __invoke(): JsonResponse
    {
        //dump($id);
        return new JsonResponse(
            data: $this->queryBus->ask(query: $this->searchFilmByIdQuery->create('5'))
        );
    }
}