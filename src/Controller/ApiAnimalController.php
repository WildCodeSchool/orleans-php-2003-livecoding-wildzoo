<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/animals", name="api_animal_")
 */
class ApiAnimalController extends AbstractController
{
    /**
     * @Route("/", name="index", methods="GET")
     */
    public function index(AnimalRepository $animalRepository): Response
    {
        return $this->json($animalRepository->findAll());
    }

    /**
     * @Route("/{id}", name="show", methods="GET")
     */
    public function show(Animal $animal): Response
    {
        return $this->json($animal);
    }

    /**
     * @Route("/", name="add", methods="POST")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animal = new Animal();
        $animal->setName($request->query->get('name'));
        $animal->setDescription($request->query->get('description'));

        $entityManager->persist($animal);
        $entityManager->flush();

        return $this->json('Ressource créée', 201);
    }
}
