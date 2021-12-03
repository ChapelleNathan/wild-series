<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/categorie", name="category_")
 */
class CategoryController extends AbstractController
{
    /** 
     * @Route ("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('category_index');
        }
        return $this->render('Category/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('Category/index.html.twig', ['categories' => $categories]);
    }

    /**
     * @Route("/detail/{categoryName}", name="show")
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['name' => $categoryName]);
        if (!$category) {
            throw $this->createNotFoundException(
                'No catégory with name : ' . $categoryName . ' found in category\'s table'
            );
        }

        $programs = $this->getDoctrine()->getRepository(Program::class)->findBy(['category' => $category], ['id' => 'DESC'], 3);
        if (!$programs) {
            throw $this->createNotFoundException(
                'No program with name : ' . $categoryName . ' found in program\'s table'
            );
        }
        return $this->render('Category/show.html.twig', ['category' => $categoryName, 'programs' => $programs]);
    }
}
