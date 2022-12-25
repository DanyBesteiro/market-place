<?php

declare(strict_types=1);

namespace App\People\ParticipationType\Application\SearchAll;

use App\People\ParticipationType\Domain\ParticipationTypeRepository;

final class AllParticipationTypesSearcher
{
    public function __construct(private readonly ParticipationTypeRepository $participationTypeRepository)
    {

    }

    public function execute(): array
    {
        return $this->participationTypeRepository->searchAll();
    }
}