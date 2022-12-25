<?php

declare(strict_types=1);

namespace App\Product\Film\Application\SearchByCriteria;

use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmRepository;

final class FilmByCriteriaSearcher
{
    public function __construct(public readonly FilmRepository $filmRepository)
    {

    }

    public function execute(string $criteria,string $value): array
    {
        return $this->filmRepository->searchByCriteria($criteria,$value);
    }
}