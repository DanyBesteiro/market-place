<?php

namespace App\Film\Infrastructure\Persistence;

use App\Film\Domain\Film;
use App\Film\Domain\FilmId;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use \App\Film\Domain\FilmRepository;

final class DoctrineFilmRepository extends DoctrineRepository implements FilmRepository
{
    public function save(Film $film): void
    {
        $this->persist($film);
    }

    public function search(FilmId $id): array
    {
        $result = $this->repository(Film::class)
            ->createQueryBuilder('film')
            ->where('film.id.value=:id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getArrayResult();

        return $result[0];
    }

    public function searchAll(): array
    {
        return $this->repository(Film::class)
            ->createQueryBuilder('film')
            ->getQuery()
            ->getArrayResult();
    }
}