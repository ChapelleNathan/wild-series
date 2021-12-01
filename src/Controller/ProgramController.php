<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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
