<?php

declare(strict_types=1);

namespace App\Product\Film\Application\Create;

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

final class FilmCreator
{
    public function __construct(private readonly FilmRepository $filmRepository)
    {

    }

    public function execute(
        FilmId $id,
        FilmDate $date,
        FilmDuration $duration,
        FilmPlace $place,
        FilmProducer $producer,
        FilmTitle $title
    ): void {
        $this->filmRepository->save(
            Film::create(
                $id,
                $date,
                $duration,
                $place,
                $producer,
                $title
            )
        );
    }
}