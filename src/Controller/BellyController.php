<?php

namespace App\Controller;

use App\Entity\UserAuthentication;
use App\Repository\BellyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BellyController extends AbstractController
{
    #[Route('/userBelly/{id}', name: 'app_user_books', methods: ['GET'] )]
    public function __invoke(BellyRepository $bellyRepository, UserAuthentication $userAuthentication,): Response
    {
        $Belly = $bellyRepository->findBy(['user' => $userAuthentication],[],);
       
        $response =[
            'success' => false,
            'belly'=>$Belly,
    
        ];
    
        return $this->json($response);
    
    }
}
