<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdatePeopleController extends AbstractController
{
    #[Route('/update_people', name: 'app_update_people')]
    public function index(): Response
    {
        Return new Response('ac-tua-lízame');
    }
}
