<?php

namespace App\DataFixtures;

use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TechnologyFixtures extends Fixture
{
    const TECHNOLOGIES = ['HTML', 'CSS', 'PHP', 'Symfony', 'Twig', 'Git', 'Figma', 'MySQL','Photoshop', 'Inkscape','Illustrator', 'Autocad','3DSMax', 'InDesign', 'Illutrator', 'Premiere', 'Final Cut Pro', 'Bootstrap', 'SCRUM', 'JavaScript'];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TECHNOLOGIES as $key => $technology) {
            $newTechnology = new Technology();

            $newTechnology->setName($technology);

            $manager->persist($newTechnology);
            $this->addReference($technology, $newTechnology);
        }

        $manager->flush();
    }
}
