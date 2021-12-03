<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /** 
     * @Route ("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();
            return $this->redirectToRoute('program_index');
        }
        return $this->render('Programs/new.html.twig', ['form' => $form->createView()]);
    }
    /**
     * @Route("/", methods={"GET"}, name="index")
     * @return Response
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()->getRepository(Program::class)->findAll();
        return $this->render('Programs/index.html.twig', ['programs' => $programs]);
    }

    /**
     * @Route ("/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="show")
     */
    public function show(Program $program): Response
    {
        return $this->render('Programs/show.html.twig', ['program' => $program]);
    }

    /**
     * @Route ("/{program}/saison/{season}", requirements={"program"="\d+", "season"="\d+"}, name="season_show")
     */
    public function showSeason(Season $season): Response
    {
        return $this->render('Programs/season_show.html.twig', ['season' => $season]);
    }

    /**
     * @Route(
     * "/{program}/saison/{season}/episode/{episode}",
     * requirements={
     *      "program"="\d+",
     *      "season"="\d+",
     *      "episode"="\d+",
     * },
     * name="episode_show"
     * )
     */
    public function showEpisode(Episode $episode)
    {
        return $this->render('Programs/episode_show.html.twig', ['episode' => $episode]);
    }
}
