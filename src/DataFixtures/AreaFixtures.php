<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Area;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AreaFixtures extends Fixture
{
    const AREA = ['Asie', 'Europe', 'Amérique', 'Afrique', 'Océanie'];

    public function load(ObjectManager $manager)
    {
        foreach (self::AREA as $areaName) {
            $area = new Area();
            $area->setName($areaName);
            $manager->persist($area);
        }
        $manager->flush();
    }
}
