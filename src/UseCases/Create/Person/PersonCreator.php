<?php

namespace App\UseCases\Create\Person;

use App\Entity\Person;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PersonCreator extends AbstractController
{
    public function __construct(public readonly ManagerRegistry $doctrine)
    {
    }

    public function execute (string $name): void
    {
        $entityManager  = $this->doctrine->getManager();
        $person       = new Person();

        $person->setName(name: $name);

        $entityManager->persist($person);
        $entityManager->flush();
    }
}