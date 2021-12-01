<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
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
        $programs = $this->getDoctrine()->getRepository(Program::class)->findAll();
        return $this->render('Programs/index.html.twig', ['programs' => $programs]);
    }

    /**
     * @Route ("/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="show")
     */
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->find($id);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table'
            );
        }
        return $this->render('Programs/show.html.twig', ['program' => $program]);
    }

    /**
     * @Route ("/{programId}/saison/{seasonId}", requirements={"programId"="\d+", "seasonId"="\d+"}, name="season_show")
     */
    public function showSeason(int $seasonId, SeasonRepository $seasonRepository): Response
    {
        $season = $seasonRepository->find($seasonId);
        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id : ' . $seasonId . ' found in season\'s table'
            );
        }
        return $this->render('Programs/season_show.html.twig', ['season' => $season]);
    }
}
