<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchPeopleController extends AbstractController
{
    #[Route('/search_people', name: 'app_search_people')]
    public function index(): Response
    {
        return new Response('hola people');
    }
}
