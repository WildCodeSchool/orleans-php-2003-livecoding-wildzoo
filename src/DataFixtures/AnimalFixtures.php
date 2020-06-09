<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixtures extends Fixture
{
    const ANIMALS = [
        'Pangolin', 'Lion', 'Elephant', 'Chauve-souris', 'Castor', 'Ornithorynque', 'Dragon', 'Aigle', 'Requin'
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        foreach (self::ANIMALS as $animalName) {
            $animal = new Animal();
            $animal->setName($animalName);
            $animal->setDescription($faker->paragraph());
            $manager->persist($animal);
        }

        $manager->flush();
    }
}
