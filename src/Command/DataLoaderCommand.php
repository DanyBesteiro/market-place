<?php

declare(strict_types=1);

namespace App\Command;

use App\Command\DataLoaderCommandServices\SaveFilmService;
use App\Command\DataLoaderCommandServices\SavePeopleInFilmService;
use App\Command\DataLoaderCommandServices\SavePeopleService;
use App\Command\DataLoaderCommandServices\SavePlaceService;
use App\Command\DataLoaderCommandServices\SaveProducerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'byl:data-loader')]
final class DataLoaderCommand extends Command
{
    private int $row;
    public function __construct(
        private readonly SaveFilmService $saveFilmService,
        private readonly SavePeopleService $savePeopleService,
        private readonly SavePeopleInFilmService $savePeopleInFilmService,
        private readonly SavePlaceService $savePlaceService,
        private readonly SaveProducerService $saveProducerService
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
        $producerId = $this->saveProducerService->saveProducer($vars['producer']);
        $placeId    = $this->savePlaceService->savePlace($vars['place']);
        $filmId = $this->saveFilmService->saveFilm(
            film: $vars,
            placeId: $placeId,
            producerId: $producerId
        );

        $peopleIds = $this->savePeopleService->savePeople($vars);

        $this->savePeopleInFilmService->savePeopleInFilms(
            actors: $peopleIds['actors'],
            directors: $peopleIds['directors'],
            writers: $peopleIds['writers'],
            filmId: $filmId
        );
    }

    private function getVariables(array $data): array
    {
        return [
            'actors'    => isset($data[12]) ? $this->explodeFormattedNames(names:$data[12]) : '',
            'date'      => isset($data[4]) ? \DateTime::createFromFormat(format: 'Y-m-d', datetime: $data[4]) : null,
            'directors' => isset($data[9]) ? $this->explodeFormattedNames(names: $data[9]) : '',
            'duration'  => isset($data[6]) ? (int) $data[6] : 0,
            'place'     => isset($data[7]) ? $this->explodeFormattedPlace($data[7]) : '',
            'producer'  => $data[11] ?? '',
            'title'     => $data[2] ?? '',
            'writers'   => isset($data[10]) ? $this->explodeFormattedNames(names: $data[10]) : ''
        ];
    }

    private function explodeFormattedNames(string $names): array
    {
        $unformattedNames = explode(separator: ',',string: $names);
        $out = [];

        foreach ($unformattedNames as $name){
            $out[] = trim($name);
        }

        return $out;
    }

    private function explodeFormattedPlace(string $names): string
    {
        $unformattedNames = explode(separator: ',',string: $names);
        $out = '';

        foreach ($unformattedNames as $name){
            $out = trim($name);
        }

        return $out;
    }
}