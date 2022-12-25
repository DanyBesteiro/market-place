<?php

declare(strict_types=1);

namespace App\Product\Film\Application\Create;

use App\Product\Film\Domain\FilmDate;
use App\Product\Film\Domain\FilmDuration;
use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmPlace;
use App\Product\Film\Domain\FilmProducer;
use App\Product\Film\Domain\FilmTitle;
use App\Shared\Domain\Bus\Command\Command;

final class CreateFilmCommand implements Command
{
    public function __construct(
        public readonly FilmId $id,
        public readonly FilmDate $date,
        public readonly FilmDuration $duration,
        public readonly FilmPlace $place,
        public readonly FilmProducer $producer,
        public readonly FilmTitle $title,
    ) {
    }

    public static function create(
        FilmId $id,
        FilmDate $date,
        FilmDuration $duration,
        FilmPlace $place,
        FilmProducer $producer,
        FilmTitle $title
    ): self {
        return new self(
            $id,
            $date,
            $duration,
            $place,
            $producer,
            $title
        );
    }
}