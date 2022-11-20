<?php

declare(strict_types=1);

namespace App\Film\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Film extends AggregateRoot
{
    public function __construct(
        private readonly FilmId $id,
        private readonly FilmDate $date,
        private readonly FilmDuration $duration,
        private readonly FilmPlace $place,
        private readonly FilmProducer $producer,
        private readonly FilmTitle $title
    )
    {
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

    public function id(): FilmId
    {
        return $this->id;
    }

    public function date(): FilmDate
    {
        return $this->date;
    }
    public function duration(): FilmDuration
    {
        return $this->duration;
    }
    public function place(): FilmPlace
    {
        return $this->place;
    }
    public function producer(): FilmProducer
    {
        return $this->producer;
    }
    public function title(): FilmTitle
    {
        return $this->title;
    }
}
