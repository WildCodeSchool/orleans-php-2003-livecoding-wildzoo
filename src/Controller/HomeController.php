<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AnimalRepository $animalRepository)
    {
        $animals = $animalRepository->findBy([], ['name'=>'DESC'], 3);

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
        ]);
    }
}
