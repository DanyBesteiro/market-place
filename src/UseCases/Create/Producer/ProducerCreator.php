<?php

namespace App\UseCases\Create\Producer;

use App\Entity\Producer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProducerCreator extends AbstractController
{
    public function __construct(public readonly ManagerRegistry $doctrine)
    {
    }

    public function execute (string $name): void
    {
        $entityManager  = $this->doctrine->getManager();
        $producer       = new Producer();

        $producer->setName(name: $name);

        $entityManager->persist($producer);
        $entityManager->flush();
    }
}