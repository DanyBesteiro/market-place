<?php

declare(strict_types=1);

namespace App\Product\Film\Infrastructure\Persistence;

use App\Product\Film\Domain\Film;
use App\Product\Film\Domain\FilmId;
use App\Product\Producer\Domain\Producer;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use \App\Product\Film\Domain\FilmRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrineFilmRepository extends DoctrineRepository implements FilmRepository
{
    public function save(Film $film): void
    {
        $this->persist($film);
    }

    public function search(FilmId $id): array
    {
        $result = $this->defaultQuery()
            ->where('film.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchByCriteria(string $criteria, string $value): array
    {
        $result = $this->defaultQuery();

        /*if ('place' === $criteria){
            $this->insertPlaceJoin($result, $value);
        }*/

        if ('producer' === $criteria){
            $this->insertProducerJoin($result, $value);
        }

        return $result->getQuery()->getArrayResult();
    }

    /*private function insertPlaceJoin(QueryBuilder $result, string $value): void
    {
        $result->addSelect(
            'producerQuery.id.value as producerId',
            'producerQuery.name.value as producerName'
        )
            ->join(  Place::class,'producerQuery', 'WITH', 'film.producer.value = producerQuery.id.value')
            ->where('producerQuery.id.value =:value')
            ->orWhere('producerQuery.name.value =:value')
            ->setParameter('value',$value);
    }*/

    private function insertProducerJoin(QueryBuilder $result, string $value): void
    {
        $result->addSelect(
            'producerQuery.id.value as producerId',
            'producerQuery.name.value as producerName'
        )
            ->join(Producer::class,'producerQuery', 'WITH', 'film.producer.value = producerQuery.id.value')
            ->where('producerQuery.id.value =:value')
            ->orWhere('producerQuery.name.value LIKE :likeValue')
            ->setParameter('value',$value)
            ->setParameter('likeValue','%'.$value.'%');
    }

    public function searchAll(): array
    {
        return $this->defaultQuery()
            ->getQuery()
            ->getArrayResult();
    }

    private function defaultQuery(): QueryBuilder
    {
        return $this->repository(Film::class)
            ->createQueryBuilder('film')
            ->select(
                'film.id.value as id',
                'film.date.value as date',
                'film.duration.value as duration',
                'film.place.value as place',
                'film.producer.value as producer',
                'film.title.value as title',
            );
    }
}