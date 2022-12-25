<?php

declare(strict_types=1);

namespace App\Product\Producer\Application\SearchAll;

use App\Product\Producer\Domain\ProducerRepository;

final class AllProducersSearcher
{
    public function __construct(private readonly ProducerRepository $producerRepository)
    {

    }

    public function execute(): array
    {
        return $this->producerRepository->searchAll();
    }
}