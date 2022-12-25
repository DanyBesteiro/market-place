<?php

declare(strict_types=1);

namespace App\Product\Place\Infrastructure\Persistence;

use App\Product\Place\Domain\Place;
use App\Product\Place\Domain\PlaceId;
use App\Product\Place\Domain\PlaceRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrinePlaceRepository extends DoctrineRepository implements PlaceRepository
{
    public function save(Place $place): void
    {
        $this->persist($place);
    }

    public function search(PlaceId $id): array
    {
        $result = $this->defaultQuery()
            ->where('place.id.value=:id')
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

    public function searchByCriteria(string $criteriaName, string $criteriaValue): ?array
    {
        $formattedCriteriaValue = str_replace('\'',"''",$criteriaValue);

        $result = $this->defaultQuery()
            ->where('place.'.$criteriaName.'.value =\'' .$formattedCriteriaValue.'\'')
            ->getQuery()
            ->getArrayResult();

        return $result[0] ?? null;
    }

    private function defaultQuery(): QueryBuilder
    {
        return $this->repository(  Place::class)
            ->createQueryBuilder('place')
            ->select(
                'place.id.value as id',
                'place.name.value as name',
            );
    }
}