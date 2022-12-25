<?php

declare(strict_types=1);

namespace App\People\Person\Application\Create;

use App\People\Person\Domain\Person;
use App\People\Person\Domain\PersonBirthDate;
use App\People\Person\Domain\PersonDeathDate;
use App\People\Person\Domain\PersonId;
use App\People\Person\Domain\PersonName;
use App\People\Person\Domain\PersonRepository;
use App\Product\Film\Domain\Film;
use App\Product\Film\Domain\FilmDate;
use App\Product\Film\Domain\FilmDuration;
use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmPlace;
use App\Product\Film\Domain\FilmProducer;
use App\Product\Film\Domain\FilmRepository;
use App\Product\Film\Domain\FilmTitle;
use App\Product\Place\Domain\Place;
use App\Product\Place\Domain\PlaceId;
use App\Product\Place\Domain\PlaceName;
use App\Product\Place\Domain\PlaceRepository;

final class PersonCreator
{
    public function __construct(private readonly PersonRepository $personRepository)
    {

    }

    public function execute(
        PersonId $id,
        PersonBirthDate $birthDate,
        PersonDeathDate $deathDate,
        PersonName $name,
    ): void {
        $this->personRepository->save(
            Person::create(
                $id,
                $birthDate,
                $deathDate,
                $name
            )
        );
    }
}