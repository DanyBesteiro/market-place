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

    public function search(FilmId $id): ?Film
    {
        return $this->repository(Film::class)
            ->createQueryBuilder('film')
            ->where('id = :id')
            ->setParameter('id', $id->value())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function searchAll(): array
    {
        return $this->repository(Film::class)
            ->createQueryBuilder('film')
            ->getQuery()
            ->getArrayResult();
    }
}