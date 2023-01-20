<?php

declare(strict_types=1);

namespace App\Person\Person\Infrastructure\Persistence;

use App\Person\Person\Domain\Person;
use App\Person\Person\Domain\PersonId;
use App\Person\Person\Domain\PersonRepository;
use App\Shared\Infrastructure\Persistence\Doctrine\DoctrineRepository;
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

    public function searchByCriteria(string $criteriaName, string $criteriaValue): ?array
    {
        $formattedCriteriaValue = str_replace('\'',"''",$criteriaValue);

        $result = $this->defaultQuery()
            ->where('person.'.$criteriaName.'.value =\'' .$formattedCriteriaValue.'\'')
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
        return $this->repository( Person::class)
            ->createQueryBuilder('person')
            ->select(
                'person.id.value as id',
                'person.cif.value as cif',
                'person.name.value as name',
                'person.personTypeId.value as personTypeId',
            );
    }
}