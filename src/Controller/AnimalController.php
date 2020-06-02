<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AnimalController
 * @package App\Controller
 * @Route("/animal", name="animal_")
 */
class AnimalController extends AbstractController
{
    /**
     * @Route("/details/{id}", name="show")
     */
    public function show(Animal $animal)
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index(AnimalRepository $animalRepository)
    {
        return $this->render('animal/index.html.twig', [
            'animals' => $animalRepository->findBy([], ['name'=>'ASC']),
        ]);
    }
}
