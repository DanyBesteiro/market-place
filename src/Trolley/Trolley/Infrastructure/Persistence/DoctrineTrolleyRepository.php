<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Infrastructure\Persistence;

use App\Trolley\Trolley\Domain\Trolley;
use App\Trolley\Trolley\Domain\TrolleyId;
use App\Trolley\Trolley\Domain\TrolleyRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrineTrolleyRepository extends DoctrineRepository implements TrolleyRepository
{

    public function save(Trolley $trolley): void
    {
        $this->persist($trolley);
    }

    public function find(TrolleyId $id): Trolley
    {
        return $this->repository(Trolley::class)->findOneBy(['id.value' => $id->value()]);
    }

    public function search(TrolleyId $id): array
    {
        $result = $this->defaultQuery()
            ->where('trolley.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchByCriteria(array $criteria): ?array
    {
        $result = $this->defaultQuery();

        foreach ($criteria as $field => $value){
            $result->andWhere('trolley.'.$field.'.value =\'' .$value.'\'');
        }

        $final = $result->getQuery()->getArrayResult();

        return empty($final) ? null : $final;
    }

    public function searchAll(): array
    {
        return $this->defaultQuery()
            ->getQuery()
            ->getArrayResult();
    }

    private function defaultQuery(): QueryBuilder
    {
        return $this->repository( Trolley::class)
            ->createQueryBuilder('trolley')
            ->select(
                'trolley.id.value as id',
                'trolley.personId.value as personId',
                'trolley.state.value as state'
            );
    }
}