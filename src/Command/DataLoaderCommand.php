<?php

declare(strict_types=1);

namespace App\Command;

use App\Product\Producer\Application\Create\CreateProducerCommand;
use App\Product\Producer\Application\SearchByCriteria\SearchProducerByCriteriaQuery;
use App\Product\Producer\Domain\ProducerId;
use App\Product\Producer\Domain\ProducerName;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'byl:data-loader')]
final class DataLoaderCommand extends Command
{
    private int $row;
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus
    ) {
        parent::__construct(null);

        $this->row = 0;
    }

    protected function configure()
    {
        $this
            ->setName(name: 'films:data-loader')
            ->setDescription(description: 'Load data from csv file');
    }

    protected function execute (InputInterface $input, OutputInterface $output): int
    {
        $fileUrl = getcwd().'/public/files/IMDbmovies.csv';

        if (file_exists($fileUrl))
        {
            $this->processFile(fileUrl: $fileUrl, output: $output);
        }

        return OutputInterface::OUTPUT_NORMAL;
    }

    private function processFile(string $fileUrl, OutputInterface $output): void
    {
        if (($manager = fopen(filename: $fileUrl, mode: "r")) !== FALSE) {
            while (($data = fgetcsv($manager, length: 1000, separator: ",")) !== FALSE) {
                if ($this->row!== 0) {
                    $vars = $this->getVariables(data: $data);
                    $output->writeln('Managing ' . $this->row . ': ' . $vars['title']) . ' data.';
                    $this->performInserts($vars);
                }
                $this->row++;
            }

            fclose($manager);
        }
    }

    private function performInserts(array $vars): void
    {
        $producerId = $this->producerId($vars['producer']);

        //$this->insertPlace(name: $vars['place']);

//        $this->insertPeople(
//            actors: $vars['actors'],
//            directors: $vars['directors'],
//            writers: $vars['writers'],
//        );

//        $this->insertFilm(
//            date: $vars['date'],
//            duration: $vars['duration'],
//            placeName: $vars['place'],
//            producerName: $vars['producer'],
//            title: $vars['title']
//        );

//        $this->insertPeopleInFilms(
//            actors: $vars['actors'],
//            directors: $vars['directors'],
//            writers: $vars['writers'],
//            title: $vars['title']
//        );
    }

    private function insertFilm(
        bool|\DateTime $date,
        int $duration,
        string $placeName,
        string $producerName,
        string $title
    ): void {

        /*$producer   = $this->producerRepository->findOneBy(['name' => $producerName]);
        $place      = $this->placeRepository->findOneBy(['name' => $placeName]);
        //$film       = $this->filmRepository->findOneBy(['title' => $title]);

        //if (false !== $date and is_null($film) and !is_null($producer) and !is_null($place)) {

            $this->filmCreator->execute(
                date: $date,
                duration: $duration,
                place: $place->getId(),
                producer: $producer->getId(),
                title: $title,
            );
        //}*/
    }

    private function insertPeople(
        array $actors,
        array $directors,
        array $writers,
    ): void {
        /*$this->insertEachPerson($actors);
        $this->insertEachPerson($directors);
        $this->insertEachPerson($writers);*/
    }

    private function insertEachPerson(array $people): void
    {
        /*foreach ($people as $person){
            $result =  $this->personRepository->findBy(['name' => $person]);

            if (count($result) === 0){
                $this->personCreator->execute($person);
            }
        }*/
    }

    private function insertPlace(string $name): void
    {
        /*$result = $this->placeRepository->findBy(['name' => $name]);

        if (count($result) === 0){
            $this->placesCreator->execute(name: $name);
        }*/
    }

    private function insertPeopleInFilms(
        array $actors,
        array $directors,
        array $writers,
        string $title,
    ): void {
        /*$film   = null; //$this->filmRepository->findOneBy(['title' => $title]);

        if (!is_null($film)) {
            foreach ($directors as $director) {

                $person = $this->personRepository->findOneBy(['name' => $director]);
                $this->insertPersonInFilm(filmId: $film->getId(), participationTypeId: 1, personId: $person->getId());
            }

            foreach ($writers as $writer) {
                $person = $this->personRepository->findOneBy(['name' => $writer]);
                $this->insertPersonInFilm(filmId: $film->getId(), participationTypeId: 2, personId: $person->getId());
            }

            foreach ($actors as $actor) {
                $person = $this->personRepository->findOneBy(['name' => $actor]);
                $this->insertPersonInFilm(filmId: $film->getId(), participationTypeId: 3, personId: $person->getId());
            }
        }*/
    }

    private function insertPersonInFilm(
        string $filmId,
        string $participationTypeId,
        string $personId
    ): void
    {
        /*$this->peopleInFilmsCreator->execute(
            filmId: $filmId,
            participationTypeId: $participationTypeId,
            personId: $personId,
        );*/
    }

    private function producerId(string $producerName): string
    {
        $producer = $this->queryBus->ask(SearchProducerByCriteriaQuery::create('name',$producerName));
        if (!is_null($producer)){
            return $producer['id'];
        }
        $producerId = Uuid::random()->value();

        $this->commandBus->dispatch(
            CreateProducerCommand::create(
                new ProducerId($producerId),
                new ProducerName($producerName)
            )
        );

        return $producerId;
    }
    private function getVariables(array $data): array
    {
        return [
            'actors'    => isset($data[12]) ? $this->explodeFormattedNames(names:$data[12]) : '',
            'date'      => isset($data[4]) ? \DateTime::createFromFormat(format: 'Y-m-d', datetime: $data[4]) : null,
            'directors' => isset($data[9]) ? $this->explodeFormattedNames(names: $data[9]) : '',
            'duration'  => isset($data[6]) ? (int) $data[6] : 0,
            'place'     => isset($data[7]) ? $this->explodeFormattedNames($data[7]) : '',
            'producer'  => $data[11] ?? '',
            'title'     => $data[2] ?? '',
            'writers'   => isset($data[10]) ? $this->explodeFormattedNames(names: $data[10]) : ''
        ];
    }

    private function explodeFormattedNames(string $names): array|string
    {
        $unformattedNames = explode(separator: ',',string: $names);
        $out = [];

        foreach ($unformattedNames as $name){
            $out = trim($name);
        }

        return $out;
    }
}