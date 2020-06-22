<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTimeImmutable;

class AnimalFixtures extends Fixture
{
    const ANIMALS = [
        'Lion',
        'Elephant',
        'Chauve-souris',
        'Castor',
        'Ornithorynque',
        'Aigle',
        'Requin',
        'Zèbre',
        'Iguane',
        'Jaguar',
        'Hibou',
        'Koala',
        'Mangouste',
        'Otarie',
        'Tortue',
        'Varan',
        'Kangourou',
        'Panthère',
        'Pangolin',
        'Panda',
        'Panda roux',
        'Babouin',
        'Belette',
        'Bison',
        'Biche  ',
        'Blaireau',
        'Boeuf',
        'Bonobo',
        'Bouc',
        'Bouquetin',
        'Brebis',
        'Buffle',
        'Cobaye ',
        'Cochon',
        'Cochon d\'Inde',
        'Cougar',
        'Coyote',
        'Crocodile',
        'Cobra',
        'Couleuvre',
        'Crotale',
        'Crapaud',
        'Âne',
        'Antilope',
        'Atèle',
        'Auroch',
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        foreach (self::ANIMALS as $animalName) {
            $animal = new Animal();
            $animal->setName($animalName);
            $animal->setIsFocus($faker->boolean);
            $animal->setDescription($faker->paragraph());
            $animal->setUpdatedAt(new DateTimeImmutable());
            $manager->persist($animal);
        }

        $manager->flush();
    }
}
