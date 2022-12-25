<?php

declare(strict_types=1);

namespace App\People\Person\Infrastructure\Persistence;

use App\Product\Film\Domain\Film;
use App\Product\Film\Domain\FilmId;
use App\People\Person\Domain\Person;
use App\People\Person\Domain\PersonId;
use App\People\Person\Domain\PersonRepository;
use App\Product\Producer\Domain\Producer;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use \App\Product\Film\Domain\FilmRepository;
use Doctrine\ORM\QueryBuilder;

final class DoctrinePersonRepository extends DoctrineRepository implements PersonRepository
{
    public function save(Person $person): void
    {
        $this->persist($person);
    }

    public function search(PersonId $id): array
    {
        $result = $this->defaultQuery()
            ->where('person.id.value=:id')
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
        return $this->repository( Person::class)
            ->createQueryBuilder('person')
            ->select(
                'person.id.value as id',
                'person.birthDate.value as birthDate',
                'person.deathDate.value as deathDate',
                'person.name.value as name',
            );
    }
}