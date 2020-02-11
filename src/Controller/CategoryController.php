<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 *
 * @Route("/categorie")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function index(ArticleRepository $repository, Category $category)
    {
        // les 5 derniers articles de la catégorie :
        $articles = $repository->findBy(
            ['category' => $category], // filtre
            ['publicationDate' => 'DESC'], // tri
            5 // limite
        );

        return $this->render('category/index.html.twig', [
            'category' => $category,
            'articles' => $articles
        ]);
    }

    public function menu(CategoryRepository $repository)
    {
        $categories = $repository->findBy([], ['id' => 'ASC']);

        return $this->render(
            'category/menu.html.twig',
            ['categories' => $categories]
        );
    }
}
