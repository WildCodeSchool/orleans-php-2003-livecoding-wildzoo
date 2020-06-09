<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/animal", name="admin_animal_")
 */
class AdminAnimalController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AnimalRepository $animalRepository) :Response
    {
        $animals = $animalRepository->findBy([], ['name' => 'ASC']);
        return $this->render('admin_animal/index.html.twig', [
            'animals' => $animals,
        ]);

    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager) :Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('animal_index');
        }

        return $this->render('admin_animal/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
