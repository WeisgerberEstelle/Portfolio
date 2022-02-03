<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/formations")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminFormationController extends AbstractController
{
    /**
     * @Route("/", name="admin_formation_index", methods={"GET"})
     */
    public function index(FormationRepository $formationRepository): Response
    {
        return $this->render('admin_formation/index.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_formation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();
            $this->addFlash('success', 'Votre formation a bien été ajoutée.');
            return $this->redirectToRoute('admin_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_formation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre formation a bien été modifiée.');
            return $this->redirectToRoute('admin_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_formation_delete", methods={"POST"})
     */
    public function delete(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formation);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Votre expérience a bien été supprimée.');
        return $this->redirectToRoute('admin_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
