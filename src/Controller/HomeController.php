<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjectRepository $projectRepo): Response
    {
        $lastProjects=$projectRepo->findBy([],['startDate'=> 'DESC'], 3);
        return $this->render('home/index.html.twig', [
            'projects' => $lastProjects,
        ]);
    }
}
