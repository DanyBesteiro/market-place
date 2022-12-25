<?php

declare(strict_types=1);

namespace App\Product\Producer\Application\SearchByCriteria;

use App\Product\Producer\Domain\ProducerRepository;

final class ProducerByCriteriaSearcher
{
    public function __construct(private readonly ProducerRepository $producerRepository)
    {

    }

    public function execute(string $criteriaName, string $criteriaValue): ?array
    {
        return $this->producerRepository->searchByCriteria($criteriaName, $criteriaValue);
    }
}