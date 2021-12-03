<?php

namespace App\Controller;

use App\Repository\RegionRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(RoomRepository $roomRepository, RegionRepository $regionRepository): Response
    {
        return $this->render('/main/index.html.twig', [
            'controller_name' => 'Main Page',
            'regions' => $regionRepository->findAll(),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/main/features", name="features")
     */
    public function features(): Response
    {
        return $this->render('/main/features.html.twig', [
            'controller_name' => 'Nop',
        ]);
    }
    /**
     * @Route("/main/profile", name="profile")
     */
    public function profile(): Response
    {
        return $this->render('/main/profile.html.twig', [
            'controller_name' => 'Profil',
        ]);
    }

    /**
     * @Route("/main/research", name="research")
     */
    public function research(): Response
    {
        return $this->render('/main/research.html.twig', []);
    }



}
