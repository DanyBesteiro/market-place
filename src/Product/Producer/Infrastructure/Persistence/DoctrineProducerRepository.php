<?php

namespace App\Product\Producer\Infrastructure\Persistence;

use App\Product\Producer\Domain\Producer;
use App\Product\Producer\Domain\ProducerId;
use App\Product\Producer\Domain\PersonRepository;
use App\Product\Producer\Domain\ProducerRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrineProducerRepository extends DoctrineRepository implements ProducerRepository
{
    public function save(Producer $producer): void
    {
        $this->persist($producer);
    }

    public function search(ProducerId $id): array
    {
        $result = $this->defaultQuery()
            ->where('producer.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchByCriteria(string $criteriaName, string $criteriaValue): ?array
    {
        $formattedCriteriaValue = str_replace('\'',"''",$criteriaValue);

        $result = $this->defaultQuery()
            ->where('producer.'.$criteriaName.'.value =\'' .$formattedCriteriaValue.'\'')
            ->getQuery()
            ->getArrayResult();

        return $result[0] ?? null;
    }

    public function searchAll(): array
    {
        return $this->defaultQuery()
            ->getQuery()
            ->getArrayResult();
    }

    private function defaultQuery(): QueryBuilder
    {
        return $this->repository(Producer::class)
            ->createQueryBuilder('producer')
            ->select(
                'producer.id.value as id',
                'producer.name.value as name'
            );
    }
}