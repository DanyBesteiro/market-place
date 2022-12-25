<?php

declare(strict_types=1);

namespace App\People\Person\Application\SearchAll;

use App\People\Person\Domain\PersonRepository;

final class AllPersonsSearcher
{
    public function __construct(private readonly PersonRepository $personRepository)
    {

    }

    public function execute(): array
    {
        return $this->personRepository->searchAll();
    }
}