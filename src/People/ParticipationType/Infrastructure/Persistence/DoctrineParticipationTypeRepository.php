<?php

declare(strict_types=1);

namespace App\People\ParticipationType\Infrastructure\Persistence;

use App\People\ParticipationType\Domain\ParticipationType;
use App\People\ParticipationType\Domain\ParticipationTypeId;
use App\People\ParticipationType\Domain\ParticipationTypeRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrineParticipationTypeRepository extends DoctrineRepository implements ParticipationTypeRepository
{
    public function save(ParticipationType $participationType): void
    {
        $this->persist($participationType);
    }

    public function search(ParticipationTypeId $id): array
    {
        $result = $this->defaultQuery()
            ->where('participationType.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchAll(): array
    {
        return $this->defaultQuery()
            ->getQuery()
            ->getArrayResult();
    }

    private function defaultQuery(): QueryBuilder
    {
        return $this->repository(  ParticipationType::class)
            ->createQueryBuilder('participation_type')
            ->select(
                'participation_type.id.value as id',
                'participation_type.name.value as name',
            );
    }
}