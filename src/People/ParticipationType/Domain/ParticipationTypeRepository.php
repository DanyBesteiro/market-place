<?php

declare(strict_types=1);

namespace App\People\ParticipationType\Domain;

interface ParticipationTypeRepository
{
    public function save(ParticipationType $participationType): void;

    public function search(ParticipationTypeId $id): array;

    public function searchAll(): array;
}
