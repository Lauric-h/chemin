<?php

namespace App\Controller;

use App\Repository\MainSportRepository;
use App\Repository\SecondarySportRepository;
use App\Repository\SportSessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        SportSessionRepository $sportSessionRepository,
        MainSportRepository $mainSportRepository,
        SecondarySportRepository $secondarySportRepository
    ): Response
    {

        $sportSession = $sportSessionRepository->findAll();

//        dd($sportSession);
        $mainSport = $mainSportRepository->findAll();
        $secondarySport = $secondarySportRepository->findAll();

        return $this->render('home/index.html.twig', [
            'sportSession' => $sportSession,
            'main' => $mainSport,
            'second' => $secondarySport
        ]);
    }
}
