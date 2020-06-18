<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AnimalRepository $animalRepository, ActivityRepository $activityRepository)
    {
        $animals = $animalRepository->findBy(['isFocus'=>true], ['name'=>'ASC'], 3);
        $activities = $activityRepository->findBy(['isFocus'=>true], ['name'=>'ASC'], 3);

        return $this->render('home/index.html.twig', [
            'animals' => $animals,
            'activities' => $activities,
        ]);
    }
}
