<?php

namespace App\UseCases\Command;

use App\Repository\FilmRepository;
use App\Repository\PersonRepository;
use App\Repository\PlaceRepository;
use App\Repository\ProducerRepository;
use App\UseCases\Create\Film\FilmCreator;
use App\UseCases\Create\PeopleInFilms\PeopleInFilmsCreator;
use App\UseCases\Create\Person\PersonCreator;
use App\UseCases\Create\Place\PlaceCreator;
use App\UseCases\Create\Producer\ProducerCreator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'byl:data-loader')]
final class DataLoaderCommand extends Command
{
    public function __construct(
        private readonly FilmCreator        $filmCreator,
        private readonly FilmRepository     $filmRepository,
        private readonly PeopleInFilmsCreator $peopleInFilmsCreator,
        private readonly PersonCreator      $personCreator,
        private readonly PersonRepository   $personRepository,
        private readonly PlaceCreator       $placesCreator,
        private readonly PlaceRepository    $placeRepository,
        private readonly ProducerCreator    $producerCreator,
        private readonly ProducerRepository $producerRepository
    ) {
        parent::__construct(name: null);
    }

    protected function configure()
    {
        $this
            ->setName(name: 'byl:data-loader')
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
        $row = 0;
        if (($manager = fopen(filename: $fileUrl, mode: "r")) !== FALSE) {
            while (($data = fgetcsv($manager, length: 1000, separator: ",")) !== FALSE) {
                if ($row!== 0) {

                    $vars = $this->getVariables(data: $data);
                    $this->performInserts(vars: $vars);

                    $output->writeln('Managing ' . $vars['title']);
                }
                $row++;
            }
        }
    }

    private function performInserts(array $vars): void
    {
        $this->manageProducer(name: $vars['producer']);

        $this->insertPlace(name: $vars['place']);

        $this->insertPeople(
            actors: $vars['actors'],
            directors: $vars['directors'],
            writers: $vars['writers'],
        );

        $this->insertFilm(
            date: $vars['date'],
            duration: $vars['duration'],
            placeName: $vars['place'],
            producerName: $vars['producer'],
            title: $vars['title']
        );

        $this->insertPeopleInFilms(
            actors: $vars['actors'],
            directors: $vars['directors'],
            writers: $vars['writers'],
            title: $vars['title']
        );
    }

    private function manageProducer(string $name): void
    {
        $result = $this->producerRepository->findBy(['name' => $name]);

        if (count($result) === 0){
            $this->producerCreator->execute(name: $name);
        }
    }

    private function insertFilm(
        bool|\DateTime $date,
        int $duration,
        string $placeName,
        string $producerName,
        string $title
    ): void {

        $producer   = $this->producerRepository->findOneBy(['name' => $producerName]);
        $place      = $this->placeRepository->findOneBy(['name' => $placeName]);
        $film       = $this->filmRepository->findOneBy(['title' => $title]);

        if (false !== $date and is_null($film) and !is_null($producer) and !is_null($place)) {

            $this->filmCreator->execute(
                date: $date,
                duration: $duration,
                place: $place->getId(),
                producer: $producer->getId(),
                title: $title,
            );
        }
    }

    private function insertPeople(
        array $actors,
        array $directors,
        array $writers,
    ): void {
        $this->insertEachPerson($actors);
        $this->insertEachPerson($directors);
        $this->insertEachPerson($writers);
    }

    private function insertEachPerson(array $people): void
    {
        foreach ($people as $person){
            $result =  $this->personRepository->findBy(['name' => $person]);

            if (count($result) === 0){
                $this->personCreator->execute($person);
            }
        }
    }

    private function insertPlace(string $name): void
    {
        $result = $this->placeRepository->findBy(['name' => $name]);

        if (count($result) === 0){
            $this->placesCreator->execute(name: $name);
        }
    }

    private function insertPeopleInFilms(
        array $actors,
        array $directors,
        array $writers,
        string $title,
    ): void {
        $film   = $this->filmRepository->findOneBy(['title' => $title]);

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
        }
    }

    private function insertPersonInFilm(
        string $filmId,
        string $participationTypeId,
        string $personId
    ): void
    {
        $this->peopleInFilmsCreator->execute(
            filmId: $filmId,
            participationTypeId: $participationTypeId,
            personId: $personId,
        );
    }

    private function getVariables(array $data): array
    {
        return [
            'actors'    => explodeFormattedNames(names:$data[12]),
            'date'      => \DateTime::createFromFormat(format: 'Y-m-d', datetime: $data[4]),
            'directors' => explodeFormattedNames(names: $data[9]),
            'duration'  => (int) $data[6],
            'place'     => $data[7],
            'producer'  => $data[11],
            'title'     => $data[2],
            'writers'   => explodeFormattedNames(names: $data[10])
        ];
    }
}