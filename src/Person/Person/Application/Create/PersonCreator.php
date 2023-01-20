<?php

declare(strict_types=1);

namespace App\Person\Person\Application\Create;

use App\Person\Person\Domain\Person;
use App\Person\Person\Domain\PersonCif;
use App\Person\Person\Domain\PersonId;
use App\Person\Person\Domain\PersonName;
use App\Person\Person\Domain\PersonRepository;
use App\Person\Person\Domain\PersonTypeId;

final class PersonCreator
{
    public function __construct(private readonly PersonRepository $personRepository)
    {

    }

    public function execute(
        PersonId $id,
        PersonCif $cif,
        PersonName $name,
        PersonTypeId $typeId,
    ): void {
        $this->personRepository->save(
            Person::create(
                $id,
                $cif,
                $name,
                $typeId
            )
        );
    }
}