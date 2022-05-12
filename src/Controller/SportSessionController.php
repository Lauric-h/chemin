<?php

namespace App\Controller;

use App\Entity\MainSport;
use App\Entity\SportSession;
use App\Form\MainSportType;
use App\Form\SportSessionType;
use App\Repository\SportSessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sport_session')]
class SportSessionController extends AbstractController
{
    #[Route('/', name: 'sport_session_index', methods: ['GET'])]
    public function index(
        EntityManagerInterface $em,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $dql = "SELECT ss FROM App:SportSession ss";
        $query = $em->createQuery($dql);
        $sportSessions = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('sport_session/index.html.twig', [
            'sport_sessions' => $sportSessions,
        ]);
    }

    #[Route('/new', name: 'sport_session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sportSession = new SportSession();
        $form = $this->createForm(SportSessionType::class, $sportSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sportSession);
            $entityManager->flush();

            return $this->redirectToRoute('sport_session_edit', [
                'id' => $sportSession->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sport_session/new.html.twig', [
            'sport_session' => $sportSession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sport_session_show', methods: ['GET'])]
    public function show(SportSession $sportSession): Response
    {
        return $this->render('sport_session/show.html.twig', [
            'sport_session' => $sportSession,
        ]);
    }

    #[Route('/{id}/edit', name: 'sport_session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SportSession $sportSession, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SportSessionType::class, $sportSession);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sport_session_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sport_session/edit.html.twig', [
            'sport_session' => $sportSession,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'sport_session_delete', methods: ['POST'])]
    public function delete(Request $request, SportSession $sportSession, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sportSession->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sportSession);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sport_session_index', [], Response::HTTP_SEE_OTHER);
    }
}
