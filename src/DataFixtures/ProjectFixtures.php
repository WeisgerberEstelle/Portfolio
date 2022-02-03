<?php

namespace App\DataFixtures;
use DateTime;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROJECTS = [
        [
            'title' => 'CERHA - Site pour un cabinet de conseil, d’expertise RH,',
            'description' => 'Réaliser un site pour une jeune entreprise spécialisée en conseils et accompagnements, que ce soit pour les entreprises ou pour les personnes éloignées de l\'emploi. Cette entreprise joue un rôle important d\'intermédiaire entre ces deux parties. Le point central dans la réalisation de ce projet a été la génération automatique d\'un C.V. anonymisé à partie des informations fournies par les particuliers.',
            'link' => 'https://orleans-cerha.phprover.wilders.dev/',
            'start' => '06-12-2021',
            'end' => '10-02-2022',
            'picture' => 'placeholder.png',
            'technologies' => ['PHP', 'Symfony', 'Twig', 'Bootstrap', 'MySQL', 'Figma', 'SCRUM', 'CSS']
            
        ],
        [
            'title' => 'Hackathon en partenariat avec ManoMano',
            'description' => 'Hackathon réalisé en partenariat avec ManoMano, commerce en ligne spécialisée dans le domaine du bricolage et du jardinage. Sous la contrainte d\'une durée de 2 jours, intégrer une amélioration ou une fonctionnalité qui pourrait répondre aux problèmatiques du parcours client et ainsi l\'optimiser en se basant sur les profils des acheteurs du site',
            'link' => '',
            'start' => '19-01-2022',
            'end' => '21-02-2022',
            'picture' => 'placeholder.png',
            'technologies' => ['PHP', 'Symfony', 'Twig', 'Bootstrap', 'MySQL', 'Figma', 'SCRUM', 'CSS']
        ],
        [
            'title' => 'APCLO - Refonte pour une association de protection des chats',
            'link' => 'https://orleans-projet2-apclo.phprover.wilders.dev/',
            'description' => ' Refonte du site APCLO afin qu\'il mette en avant les animaux à adopter, de manière plus attrayante, claire et ergonomique afin d’optimiser les adoptions des pensionnaires. Le but étant de moderniser et restructurer le site, ainsi que d’épurer les informations afin de gagner en lisibilité.',
            'start' => '25-10-2021',
            'end' => '19-11-2021',
            'picture' => 'placeholder.png',
            'technologies' => ['PHP', 'Twig', 'Bootstrap', 'MySQL', 'Figma', 'SCRUM', 'CSS', 'Inkscape']
        ]
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROJECTS as $project) {
            $newProject = new Project();
            $newProject->setTitle($project['title']);
            $newProject->setDescription($project['description']);
            $newProject->setLink($project['link']);
            $newProject->setImage($project['picture']);
            copy(__DIR__ . '/placeholder.png', __DIR__ . '/../../public/uploads/projets/placeholder.png');
            for ($i = 0; $i < count($project['technologies']); $i++) {

                $newProject->addTechnology($this->getReference($project['technologies'][$i]));
            }
            $newProject->setStartDate(new DateTime($project['start']));
            $newProject->setEndDate(new DateTime($project['end']));

            $manager->persist($newProject);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TechnologyFixtures::class
        ];
    }
}
