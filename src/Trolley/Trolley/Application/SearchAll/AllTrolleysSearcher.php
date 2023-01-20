<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\SearchAll;

use App\Trolley\Trolley\Domain\TrolleyRepository;

final class AllTrolleysSearcher
{
    public function __construct(private readonly TrolleyRepository $personRepository)
    {

    }

    public function execute(): array
    {
        return $this->personRepository->searchAll();
    }
}