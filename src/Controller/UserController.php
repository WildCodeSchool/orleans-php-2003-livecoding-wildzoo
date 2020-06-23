<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="user_index")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findBy([], ['lastname' => 'ASC', 'firstname' => 'ASC']),
        ]);
    }
}
