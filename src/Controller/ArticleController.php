<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article.index")
     */
    public function index(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepository->findAll();

        $page = $paginator->paginate($articles, $request->query->getInt('page', 1), 10);

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'pages' => $page,
        ]);
    }
    /**
     * @Route("/article/{id}", name="article.show")
     */
    public function show($id)
    {
        $articleRepository = $this->getDoctrine()->getRepository(Article::class);
        $article = $articleRepository->find($id);
        if (!$article)
        {
            throw $this->createNotFoundException('The article does not exist');
        }
        else
        {
            return $this->render('article/show.html.twig', [
                'article' => $article,
            ]);
        }
        
    }
}

