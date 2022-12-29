<?php

namespace App\Controller;

use App\Entity\CategoryArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Service\FileUploader;

#[AsController]
class CategoryPictureController extends AbstractController
{
    public function __invoke(Request $request, FileUploader $fileUploader):CategoryArticle
    {
        $uploadedFile = $request->files->get('pictureCategory');
        if (!$uploadedFile) 
        {
            throw new BadRequestHttpException('"pictureCategory" is required');
        }

        // create a new entity and set its values
        $category = new CategoryArticle();
        $category->setNameCategory($request->get('NameCategory'));
        $category->setpictureCategory($request->get('pictureCategory'));
    
        

        $uploadName = $fileUploader->upload($uploadedFile, $this->getParameter("categorysPicture"));
        // upload the file and save its filename
        $category->setpictureCategory($fileUploader->getUrl($uploadName, $this->getParameter("categorysPicture")));
        return $category;
    }
}





