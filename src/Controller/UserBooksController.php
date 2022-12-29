<?php

namespace App\Controller;

use App\Entity\UserAuthentication;
use App\Repository\BookRepository;
use App\Repository\NotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserBooksController extends AbstractController
{
    #[Route('/userBooks/{id}', name: 'app_user_books', methods: ['GET'] )]
    public function __invoke(BookRepository $bookRepository, UserAuthentication $userAuthentication, NotesRepository $notesRepository,): Response
    {
        $Books = $bookRepository->findBy(['user' => $userAuthentication],[],);
       
        $response =[
            'success' => false,
            'book'=>$Books,
    
        ];
    
        return $this->json($response);
    
    }
}

