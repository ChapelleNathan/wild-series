<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route ("/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="details")
     */
    public function show(int $id): Response
    {
        return $this->render('Programs/show.html.twig', ['id' => $id]);
    }
}