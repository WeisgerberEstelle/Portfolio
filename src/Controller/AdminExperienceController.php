<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/experiences")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminExperienceController extends AbstractController
{
    /**
     * @Route("/", name="admin_experience_index", methods={"GET"})
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        return $this->render('admin_experience/index.html.twig', [
            'experiences' => $experienceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_experience_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();
            $this->addFlash('success', 'Votre expérience a bien été ajoutée.');

            return $this->redirectToRoute('admin_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_experience/new.html.twig', [
            'experience' => $experience,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_experience_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre expérience a bien été modifiée.');
            return $this->redirectToRoute('admin_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_experience/edit.html.twig', [
            'experience' => $experience,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_experience_delete", methods={"POST"})
     */
    public function delete(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getId(), $request->request->get('_token'))) {
            $entityManager->remove($experience);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Votre expérience a bien été supprimée.');
        return $this->redirectToRoute('admin_experience_index', [], Response::HTTP_SEE_OTHER);
    }
}
