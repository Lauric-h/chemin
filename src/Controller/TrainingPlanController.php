<?php

namespace App\Controller;

use App\Entity\TrainingPlan;
use App\Form\TrainingPlanType;
use App\Repository\TrainingPlanRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/training_plan')]
class TrainingPlanController extends AbstractController
{
    #[Route('/', name: 'training_plan_index', methods: ['GET'])]
    public function index(
        EntityManagerInterface $em,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $dql = "SELECT tp FROM App:TrainingPlan tp";
        $query = $em->createQuery($dql);
        $trainingPlans = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('training_plan/index.html.twig', [
            'training_plans' => $trainingPlans,
        ]);
    }

    #[Route('/new', name: 'training_plan_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainingPlan = new TrainingPlan();
        $form = $this->createForm(TrainingPlanType::class, $trainingPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trainingPlan->checkIsStarted();
            $entityManager->persist($trainingPlan);
            $entityManager->flush();

            return $this->redirectToRoute('training_plan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('training_plan/new.html.twig', [
            'training_plan' => $trainingPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'training_plan_show', methods: ['GET'])]
    public function show(TrainingPlan $trainingPlan): Response
    {
        return $this->render('training_plan/show.html.twig', [
            'training_plan' => $trainingPlan,
        ]);
    }

    #[Route('/{id}/edit', name: 'training_plan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TrainingPlan $trainingPlan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrainingPlanType::class, $trainingPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('training_plan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('training_plan/edit.html.twig', [
            'training_plan' => $trainingPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'training_plan_delete', methods: ['POST'])]
    public function delete(Request $request, TrainingPlan $trainingPlan, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trainingPlan->getId(), $request->request->get('_token'))) {
            $entityManager->remove($trainingPlan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('training_plan_index', [], Response::HTTP_SEE_OTHER);
    }
}
