<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Infrastructure\Persistence;

use App\People\ParticipationType\Domain\ParticipationType;
use App\People\ParticipationType\Domain\ParticipationTypeId;
use App\People\ParticipationType\Domain\ParticipationTypeRepository;
use App\People\PeopleInFilm\Domain\PeopleInFilm;
use App\People\PeopleInFilm\Domain\PeopleInFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrinePeopleInFilmRepository extends DoctrineRepository implements PeopleInFilmRepository
{
    public function save(PeopleInFilm $peopleInFilm): void
    {
        $this->persist($peopleInFilm);
    }

    public function search(PeopleInFilmId $id): array
    {
        $result = $this->defaultQuery()
            ->where('peopleInFilm.id.value=:id')
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
        return $this->repository(  PeopleInFilm::class)
            ->createQueryBuilder('peopleInFilm')
            ->select(
                'peopleInFilm.id.value as id',
                'peopleInFilm.filmId.value as filmId',
                'peopleInFilm.personId.value as personId',
                'peopleInFilm.participationTypeId.value as participationTypeId',
            );
    }
}