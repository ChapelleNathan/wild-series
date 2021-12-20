<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route ("/", name="app_")
     */
class DefaultController extends AbstractController
{

    /**
     * @Route ("/", name="index")
     */
    public function index(ProgramRepository $programRepository): Response
    {
        $lastReleases = $programRepository->findBy([],['id' => 'desc'],3);
        return $this->render('index.html.twig', ['lastReleases' => $lastReleases]);
    }

    /**
     * @Route("/mon-profile", name="profile")
     */
    public function profile(): Response
    {
        return $this->render('profile.html.twig');
    }
}