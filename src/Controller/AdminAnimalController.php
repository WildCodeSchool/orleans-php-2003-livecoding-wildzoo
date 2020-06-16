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
    public function index(AnimalRepository $animalRepository): Response
    {
        $animals = $animalRepository->findBy([], ['name' => 'ASC']);

        return $this->render('admin_animal/index.html.twig', [
            'animals' => $animals,
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animal);
            $entityManager->flush();
            $this->addFlash('success', 'L\'animal a été ajouté');
            return $this->redirectToRoute('admin_animal_index');
        }

        return $this->render('admin_animal/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La modification de l\'animal est un succès');
            return $this->redirectToRoute('admin_animal_index');
        }

        return $this->render('admin_animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete", methods="POST")
     */
    public function delete(Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($animal);
        $this->addFlash('success', 'La suppression de l\'animal est un succès');
        $entityManager->flush();

        return $this->redirectToRoute('admin_animal_index');
    }
}
