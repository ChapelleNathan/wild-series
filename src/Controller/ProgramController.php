<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\CommentType;
use App\Form\ProgramType;
use App\Repository\CommentRepository;
use App\Service\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /** 
     * @Route ("/new", name="new")
     */
    public function new(Request $request, Slugify $slugify, MailerInterface $mailer): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $slug = $slugify->generate($program->getTitle());
            $program->setSlug($slug);
            $entityManager->persist($program);
            $entityManager->flush();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('your_email@example.com')
                ->subject('Une nouvelle série a été publiée !')
                ->html($this->renderView('Programs/newProgramEmail.html.twig', ['program' => $program]));
            $mailer->send($email);
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
     * @Route ("/{slug}", methods={"GET"}, name="show")
     */
    public function show(Program $program): Response
    {
        return $this->render('Programs/show.html.twig', ['program' => $program]);
    }

    /**
     * @Route ("/{programSlug}/saison/{season}", requirements={"program"="\d+", "season"="\d+"}, name="season_show")
     */
    public function showSeason(Season $season): Response
    {
        return $this->render('Programs/season_show.html.twig', ['season' => $season]);
    }

    /**
     * @Route(
     * "/{programSlug}/saison/{season}/{episodeId}",
     * requirements={"season"="\d+"},
     * name="episode_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"programSlug": "slug"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season": "id"}})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episodeId": "id"}})
     */
    public function showEpisode(
        Program $program,
        Season $season,
        Episode $episode,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setEpisode($episode);
            $entityManager->persist($comment);
            $entityManager->flush($comment);
            return $this->redirectToRoute(
                'program_episode_show',
                [
                    'programSlug' => $program->getSlug(),
                    'season' => $season->getId(),
                    'episodeId' => $episode->getId(),
                ],
                Response::HTTP_SEE_OTHER
            );
        }
        return $this->render(
            'Programs/episode_show.html.twig',
            [
                'episode' => $episode,
                'form' => $form->createView(),
            ]
        );
    }
}
