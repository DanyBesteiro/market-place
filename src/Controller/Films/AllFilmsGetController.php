<?php

declare(strict_types=1);

namespace App\Controller\Films;

use App\Product\Film\Application\SearchAll\SearchAllFilmsQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AllFilmsGetController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            data: $this->queryBus->ask(query:  new SearchAllFilmsQuery())
        );
    }
}