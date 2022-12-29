<?php
//test prod
namespace App\Controller;

use App\Entity\CategoryArticle;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articlesCategory/{id}', name: 'app_article', methods: ['GET'])]
    public function __invoke(ArticleRepository $articleRepository, CategoryArticle $categoryArticle): Response
    {
        $Articles = $articleRepository->findBy(['category' => $categoryArticle   ],[],);
        $response =[
            'success' => false,
            'category'=>$Articles,
        ];

        return $this->json($response);

    }
}
