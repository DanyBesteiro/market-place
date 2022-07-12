<?php

namespace App\UseCases\Create\PeopleInFilms;

use App\Entity\PeopleInFilms;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PeopleInFilmsCreator extends AbstractController
{
    public function __construct(public readonly ManagerRegistry $doctrine)
    {
    }

    public function execute (
        int $filmId,
        int $participationTypeId,
        int $personId
    ): void {
        $entityManager  = $this->doctrine->getManager();
        $peopleInFilms = new PeopleInFilms();

        $peopleInFilms->setFilmId(FilmId: $filmId);
        $peopleInFilms->setParticipationTypeId(ParticipationTypeId: $participationTypeId);
        $peopleInFilms->setPersonId(PersonId: $personId);

        $entityManager->persist($peopleInFilms);
        $entityManager->flush();
    }
}