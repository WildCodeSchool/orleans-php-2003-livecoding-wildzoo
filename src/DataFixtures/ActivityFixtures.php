<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use DateTimeImmutable;

class ActivityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $activity = new Activity();
            $manager->persist($activity);
            $activity->setName($faker->sentence(3));
            $activity->setDescription($faker->realText());
            $activity->setIsFocus($faker->boolean());
            $activity->setUpdatedAt(new DateTimeImmutable());
        }

        $manager->flush();
    }
}
