<?php

namespace App\Controller;

use App\Entity\CategoryArticle;
use App\Repository\CategoryArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function getArticle( CategoryArticleRepository $categoryArticleRepository): Response
    {
        $categorys = $categoryArticleRepository->findAll();

        $response = [
            'success' => false,
            'categories' => $categorys,
        ];
        return $this->json($response);

    }
}

