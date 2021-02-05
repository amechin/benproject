<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{slug}", name="category")
     * @param string $slug
     * @return Response
     */
    public function show(string $slug): Response
    {
        $category = $this->getDoctrine()->getRepository(Category::class)->findOneBy(['slug' => $slug]);

        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}
