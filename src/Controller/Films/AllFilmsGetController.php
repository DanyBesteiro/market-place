<?php

declare(strict_types=1);

namespace App\Controller\Films;

use App\Film\Application\SearchAll\SearchAllFilmsQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AllFilmsGetController extends AbstractController
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly SearchAllFilmsQuery $allFilmsQuery
    ) {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse( //['amigo']
            data: $this->queryBus->ask(query: $this->allFilmsQuery::create())
        );
    }
}