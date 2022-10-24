<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Entity\UserAuthentication;
use App\Service\FileUploader;

#[AsController]
final class UserPictureController extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader): UserAuthentication
    {
        $uploadedFile = $request->files->get('picture');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"picture" is required');
        }

        // create a new entity and set its values
        $user = new UserAuthentication();
        $user->setEmail($request->get('email'));
        $user->setUserName($request->get('userName'));
        $user->setPlainPassword($request->get('password'));
        

        $uploadName = $fileUploader->upload($uploadedFile, $this->getParameter("usersPicture"));
        // upload the file and save its filename
        $user->setPicture($fileUploader->getUrl($uploadName, $this->getParameter("usersPicture")));
        return $user;
    }
}

