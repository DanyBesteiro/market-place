<?php

namespace App\UseCases\Create\Place;

use App\Entity\Place;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PlaceCreator extends AbstractController
{
    public function __construct(public readonly ManagerRegistry $doctrine)
    {
    }

    public function execute (string $name): void
    {
        $entityManager  = $this->doctrine->getManager();
        $place       = new Place();

        $place->setName(name: $name);

        $entityManager->persist($place);
        $entityManager->flush();
    }
}