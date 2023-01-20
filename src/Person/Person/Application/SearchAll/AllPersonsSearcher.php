<?php

declare(strict_types=1);

namespace App\Person\Person\Application\SearchAll;

use App\Person\Person\Domain\PersonRepository;

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