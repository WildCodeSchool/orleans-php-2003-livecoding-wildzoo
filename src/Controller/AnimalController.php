<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    /**
     * @Route("/animal/details/{id}", name="animal_show")
     */
    public function show(Animal $animal)
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }
}
