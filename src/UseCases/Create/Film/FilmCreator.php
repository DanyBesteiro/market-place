<?php

namespace App\UseCases\Create\Film;

use App\Entity\Film;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class FilmCreator extends AbstractController
{
    public function __construct(public readonly ManagerRegistry $doctrine)
    {
    }

    public function execute (
        \DateTime $date,
        int $duration,
        int $place,
        int $producer,
        string $title,
    ): void {
        $entityManager  = $this->doctrine->getManager();
        $film           = new Film();

        $film->setTitle(title: $title);
        $film->setDate(date: $date);
        $film->setDuration(duration: $duration);
        $film->setProducer(producer: $producer);
        $film->setPlace(place: $place);

        $entityManager->persist($film);
        $entityManager->flush();
    }
}