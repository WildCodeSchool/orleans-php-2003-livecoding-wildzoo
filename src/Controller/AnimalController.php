<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\AnimalSearch;
use App\Form\AnimalSearchType;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, AnimalRepository $animalRepository)
    {
        $animalSearch = new AnimalSearch();
        $form = $this->createForm(AnimalSearchType::class, $animalSearch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // recuperer uniquement les animaux commençant par 'animalSearch'
            $animals = $animalRepository->animalSearchLike($animalSearch->getAnimalSearch());
        } else {
            $animals = $animalRepository->findBy([], ['name' => 'ASC']);
        }

        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/search/{input}", name="search")
     */
    public function search(Request $request, string $input, AnimalRepository $animalRepository)
    {
        $animals = $animalRepository->animalSearchLike($input);

        return $this->json($animals);
    }
}
