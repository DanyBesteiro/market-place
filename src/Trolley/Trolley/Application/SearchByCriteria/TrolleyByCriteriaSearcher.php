<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\SearchByCriteria;

use App\Trolley\Trolley\Domain\TrolleyRepository;

final class TrolleyByCriteriaSearcher
{
    public function __construct(public readonly TrolleyRepository $trolleyRepository)
    {

    }

    public function execute(array $criteria): ?array
    {
        return $this->trolleyRepository->searchByCriteria($criteria);
    }
}