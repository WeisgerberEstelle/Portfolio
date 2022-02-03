<?php

namespace App\DataFixtures;

use App\Entity\Experience;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExperienceFixtures extends Fixture
{
    public const EXPERIENCES = [
        [
            'title' => 'Projet client - CERHA',
            'description' => 'Réaliser un site pour une jeune entreprise spécialisée en conseils R.H. pour professionnels et particuiers, avec au coeur du projet la génération automitisée d\'un C.V. anonyme pour les particuliers. Réalisé à partir de PHP / Symfony, MySQl, Twig, Bootstrap, et Scss, en suivant la méthode SCRUM.',
            'place' => 'Wild Code School',
            'start' => '06-12-2021',
            'end' => '10-02-2022',
            'role' => 'Développeur web'
            
        ],
        [
            'title' => 'Hackathon en partenariat avec ManoMano',
            'description' => 'Hackathon réalisé en partenariat avec ManoMano, commerce en ligne spécialisée dans le domaine du bricolage et du jardinage. Sous la contrainte d\'une durée de 2 jours, intégrer une amélioration ou une fonctionnalité qui pourrait répondre aux problèmatiques du parcours client et ainsi l\'optimiser en se basant sur les profils des acheteurs du site. Réalisé à partir de PHP / Symfony, MySQl, Twig, Bootstrap, et Scss.',
            'place' => 'Wild Code School',
            'start' => '19-01-2022',
            'end' => '21-02-2022',
            'role' => 'Développeur web'
        ],
        [
            'title' => 'Projet client fictif - APCLO',
            'place' => 'Wild Code School',
            'description' => 'Refonte d\'un site vitrine local de l\'APCLO afin de mettre en avant les animaux à adopter, afin d’encourager leurs adoptions. Refonte de la chartre graphique. Réalisé à partir de PHP et l\'architecture MVC, MySQl, Twig, Bootstrap, Css, en suivant la méthode SCRUM.' ,
            'start' => '25-10-2021',
            'end' => '19-11-2021',
            'role' => 'Développeur web'
        ]
    ];

    public function load(ObjectManager $manager): void
    {
       
        foreach (self::EXPERIENCES as $experience) {
            $newExperience = new Experience();
            $newExperience->setTitle($experience['title']);
            $newExperience->setPlace($experience['place']);
            $newExperience->setDescription($experience['description']);
            $newExperience->setRole($experience['role']);
            $newExperience->setStartDate(new DateTime($experience['start']));
            $newExperience->setEndDate(new DateTime($experience['end']));
            $manager->persist($newExperience);
        }

        $manager->flush();
    }
}
