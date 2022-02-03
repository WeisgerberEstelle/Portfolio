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
            'technologies' => ['PHP', 'Symfony', 'Twig', 'Bootstrap', 'MySQL', 'Figma', 'SCRUM', 'CSS'],
            'image' => 'cerha.png'
            
        ],
        [
            'title' => 'Hackathon en partenariat avec ManoMano',
            'description' => 'Hackathon réalisé en partenariat avec ManoMano, commerce en ligne spécialisée dans le domaine du bricolage et du jardinage. Sous la contrainte d\'une durée de 2 jours, intégrer une amélioration ou une fonctionnalité qui pourrait répondre aux problèmatiques du parcours client et ainsi l\'optimiser en se basant sur les profils des acheteurs du site',
            'link' => '',
            'start' => '19-01-2022',
            'end' => '21-02-2022',
            'technologies' => ['PHP', 'Symfony', 'Twig', 'Bootstrap', 'MySQL', 'Figma', 'SCRUM', 'CSS'],
            'image' => 'manomano.png'
        ],
        [
            'title' => 'APCLO - Refonte pour une association de protection des chats',
            'link' => 'https://orleans-projet2-apclo.phprover.wilders.dev/',
            'description' => ' Refonte du site APCLO afin qu\'il mette en avant les animaux à adopter, de manière plus attrayante, claire et ergonomique afin d’optimiser les adoptions des pensionnaires. Le but étant de moderniser et restructurer le site, ainsi que d’épurer les informations afin de gagner en lisibilité.',
            'start' => '25-10-2021',
            'end' => '19-11-2021',
            'technologies' => ['PHP', 'Twig', 'Bootstrap', 'MySQL', 'Figma', 'SCRUM', 'CSS', 'Inkscape'],
            'image' => 'apclo.png'
        ],
        [
            'title' => 'Container - Comment en faire un espace de vie?',
            'link' => '',
            'description' => 'Comment réhabiliter un container en fin d\'utilisation afin d\'en faire un espace de vie dans un contexte donné? Lors des descentes dans les gorges de l\' Ardèche, il peut devenir un espace de bivouac convivial grâce à son ouverture latérale permettant de garder un espace ouvert tout en délimitant une espace de convivialité.',
            'start' => '25-12-2014',
            'end' => '19-06-2015',
            'technologies' => ['3DSMax', 'Photoshop', 'Autocad', 'Illustrator', 'InDesign'],
            'image' => 'interieur.png'
        ],
        [
            'title' => 'Mozaïques et chocolats',
            'link' => '',
            'description' => 'A partir de formes géométriques les plus basiques, réaliser une mozaïque de chocolats complexe et riche en possibilités afin de décorer les vitrines des chocolatiers d\' Orléans',
            'start' => '25-10-2014',
            'end' => '19-11-2015',
            'technologies' => ['3DSMax', 'Photoshop', 'Autocad', 'Illustrator', 'InDesign'],
            'image' => 'chocolat.png'
        ],
        [
            'title' => 'Souffleur de verre, et Art de la table',
            'link' => '',
            'description' => 'Comment moderniser l\'Art de la table et plus particulièrement la technique ancestrale du soufflage de verre. Les verres partiellement fondus laissent place à une nouvelle manière de les appréhender et ainsi de déguster son contenu',
            'start' => '25-10-2014',
            'end' => '19-06-2015',
            'technologies' => ['3DSMax', 'Photoshop', 'Autocad', 'Illustrator', 'InDesign'],
            'image' => 'verre.png'
        ]

    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROJECTS as $project) {
            $newProject = new Project();
            $newProject->setTitle($project['title']);
            $newProject->setDescription($project['description']);
            $newProject->setLink($project['link']);
            $newProject->setImage($project['image']);
            copy(__DIR__ . '/'.$project['image'], __DIR__ . '/../../public/uploads/projets/'. $project['image']);
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
