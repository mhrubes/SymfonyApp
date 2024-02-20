<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DataController extends AbstractController
{
    #[Route('/datapage', name: 'app_data_page')]
    public function index(): Response
    {
        $movies = ["Avengers: Endgame", "Loki", "Thief"];

        return $this->render('datapage/index.html.twig', array(
            'movies' => $movies
        ));
    }
}
