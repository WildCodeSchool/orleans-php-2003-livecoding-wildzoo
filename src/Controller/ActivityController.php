<?php

namespace App\Controller;

use App\Entity\Activity;
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

     /**
     * @Route("/details/{id}", name="show")
     */
    public function show(Activity $activity)
    {
        return $this->render('activity/show.html.twig', [
            'activity' => $activity,
        ]);
    }
}
