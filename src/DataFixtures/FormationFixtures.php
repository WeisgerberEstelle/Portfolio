<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormationFixtures extends Fixture
{
    public const FORMATIONS = [
        [
            'title' => 'Développement web',
            'description' => 'Réalisation de site grâce à l\'apprentissage de HTML, CSS, PHP, MySQL, et notamment le framework Symfony. Réaliser un product Bbcklog, construire des wireframes, et des maquettes, utiliser une API. Utilisation de la méthode SCRUM.',
            'place' => 'Wild Code School',
            'start' => '13-09-2021',
            'end' => '11-02-2022',
            
        ],
        [
            'title' => 'T.B.M.2',
            'description' => 'Techniques et bases du management. Coaching, formation, gestion des stocks, responsable qualité des produits et recrutement.',
            'place' => 'Mcdonald\'s',
            'start' => '01-10-2016',
            'end' => '',
        ],
        [
            'title' => 'T.B.M.1',
            'place' => 'Mcdonald\'s',
            'description' => 'Techniques et bases du management. Coaching, formation, gestion des stocks, responsable qualité des produits et recrutement.' ,
            'start' => '10-03-2018',
            'end' => '',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
       
        foreach (self::FORMATIONS as $formation) {
            $newformation = new Formation();
            $newformation->setTitle($formation['title']);
            $newformation->setPlace($formation['place']);
            $newformation->setDescription($formation['description']);
            $newformation->setStartDate(new DateTime($formation['start']));
            $newformation->setEndDate(new DateTime($formation['end']));
            $manager->persist($newformation);
        }

        $manager->flush();
    }
}