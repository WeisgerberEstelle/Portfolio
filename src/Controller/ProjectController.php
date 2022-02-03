<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projets", name="projects")
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects= $projectRepository->findBy([],['startDate' => 'DESC']);

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
