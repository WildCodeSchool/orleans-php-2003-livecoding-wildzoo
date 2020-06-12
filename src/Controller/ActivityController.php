<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activity", name="activity_")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ActivityRepository $activityRepository)
    {
        return $this->render('activity/index.html.twig', [
            'activities' => $activityRepository->findBy([], ['name' => 'ASC']),
        ]);
    }
}
