<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Repository\ExperienceRepository;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/apropos", name="about")
     */
    public function index(ExperienceRepository $experienceRepository,FormationRepository $formationRepository): Response
    {
        $experiences = $experienceRepository->findBy([],['startDate' => 'DESC']);
        $formations = $formationRepository->findBy([],['startDate' => 'DESC']);

        return $this->render('about/index.html.twig', [
            'experiences' => $experiences,
            'formations' => $formations
        ]);
    }
}
