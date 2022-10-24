<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class LoginController extends AbstractController
{
    #[Route('/dashboard', name: 'app_login')]
    public function __invoke()    
    {
       $user = $this->getUser();
       $response = [
        'success' => false,
        "user" => $user,
        ];
        return $this->json($response);
    }
}
