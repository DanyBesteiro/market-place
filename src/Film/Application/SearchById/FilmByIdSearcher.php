<?php

declare(strict_types=1);

namespace App\Film\Application\SearchById;

use App\Film\Domain\FilmId;
use App\Film\Domain\FilmRepository;

final class FilmByIdSearcher
{
    public function __construct(public readonly FilmRepository $filmRepository)
    {

    }

    public function execute(string $id): array
    {
        return $this->filmRepository->search(new FilmId((int)$id));
    }
}