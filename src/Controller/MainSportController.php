<?php

namespace App\Controller;

use App\Entity\MainSport;
use App\Entity\SportSession;
use App\Form\MainSportType;
use App\Repository\MainSportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/main_sport')]
class MainSportController extends AbstractController
{
    #[Route('/', name: 'main_sport_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $mainSports = $entityManager
            ->getRepository(MainSport::class)
            ->findAll();

        return $this->render('main_sport/index.html.twig', [
            'main_sports' => $mainSports,
        ]);
    }

    #[Route('/new', name: 'main_sport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mainSport = new MainSport();
        $sportSession = $entityManager->getRepository(SportSession::class)->find($request->get('id'));
        $mainSport->setSportSession($sportSession);

        $form = $this->createForm(MainSportType::class, $mainSport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mainSport);
            $entityManager->flush();

            return $this->redirectToRoute('sport_session_edit', [
                'id' => $sportSession->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main_sport/new.html.twig', [
            'main_sport' => $mainSport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'main_sport_show', methods: ['GET'])]
    public function show(MainSport $mainSport): Response
    {
        return $this->render('main_sport/show.html.twig', [
            'main_sport' => $mainSport,
        ]);
    }

    #[Route('/{id}/edit', name: 'main_sport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MainSport $mainSport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MainSportType::class, $mainSport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('main_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('main_sport/edit.html.twig', [
            'main_sport' => $mainSport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'main_sport_delete', methods: ['POST'])]
    public function delete(Request $request, MainSport $mainSport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainSport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mainSport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('main_sport_index', [], Response::HTTP_SEE_OTHER);
    }
}
