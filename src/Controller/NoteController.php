<?php
namespace App\Controller;
use App\Repository\BookRepository;
use App\Repository\NotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NoteController extends AbstractController
{
    #[Route('/BookNote/{id}', name: 'app_book_note', methods: ['GET'])]
    public function __invoke(Request $request,  NotesRepository $notesRepository,): Response
    {
        
        
        $notes = $notesRepository->findBy(['book' => $request->get('id')],[],);
       
        $response =[
            'success' => false,
            'notes'=>$notes,
        ];

        return $this->json($response);

    }
        
    

}