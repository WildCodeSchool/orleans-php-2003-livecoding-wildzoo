<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $animal = new Animal();
            $animal->setName($faker->word());
            $animal->setDescription($faker->paragraph());
            $manager->persist($animal);
        }

        $manager->flush();
    }
}
