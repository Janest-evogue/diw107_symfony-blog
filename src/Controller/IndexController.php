<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(ArticleRepository $repository)
    {
        // les 5 derniers articles du blog
        $articles = $repository->findBy(
            [], // filtre
            ['publicationDate' => 'DESC'], // tri
            5 // limite
        );

        return $this->render(
            'index/index.html.twig',
            ['articles' => $articles]
        );
    }
}
