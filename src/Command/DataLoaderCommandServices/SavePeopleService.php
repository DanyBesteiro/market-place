<?php

declare(strict_types=1);

namespace App\Command\DataLoaderCommandServices;

use App\People\Person\Application\Create\CreatePersonCommand;
use App\People\Person\Application\SearchByCriteria\SearchPersonByCriteriaQuery;
use App\People\Person\Domain\PersonBirthDate;
use App\People\Person\Domain\PersonDeathDate;
use App\People\Person\Domain\PersonId;
use App\People\Person\Domain\PersonName;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;

final class SavePeopleService
{
    public function __construct(private readonly CommandBus $commandBus, private readonly QueryBus $queryBus)
    {

    }

    public function savePeople(array $vars): array
    {
        $out=[];
        foreach ($vars['actors'] as $actor){
            $out['actors'][] = $this->insertPerson($actor);
        }

        foreach ($vars['directors'] as $director){
            $out['directors'][] = $this->insertPerson($director);
        }

        foreach ($vars['writers'] as $writer){
            $out['writers'][] = $this->insertPerson($writer);
        }

        return $out;
    }

    private function insertPerson(string $personName): string
    {
        $result = $this->queryBus->ask(SearchPersonByCriteriaQuery::create('name', $personName));

        if (!is_null($result)){
            return $result['id'];
        }

        $personId = Uuid::random()->value();

        $this->commandBus->dispatch(
            CreatePersonCommand::create(
                new PersonId($personId),
                new PersonBirthDate(null),
                new PersonDeathDate(null),
                new PersonName($personName)
            )
        );

        return $personId;
    }
}