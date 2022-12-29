<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\UrlHelper;

class FileUploader
{
    private $slugger;
    private $urlHelper;
    private $publicPath;

    public function __construct($publicPath, SluggerInterface $slugger, UrlHelper $urlHelper)
    {
        $this->slugger = $slugger;
        $this->publicPath = $publicPath;
        $this->urlHelper = $urlHelper;
    }

    public function upload(UploadedFile $file, string $targetDirectory)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($targetDirectory, $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function getuploadPath()
    {
        return $this->uploadPath;
    }

    public function getUrl(?string $fileName, string $targetDirectory,  bool $absolute = true)
    {
        if (empty($fileName)) return null;
        $folder = str_replace($this->publicPath, '', $targetDirectory) . '/';
        if ($absolute) {
            return $this->urlHelper->getAbsoluteUrl($folder . $fileName);
        }

        return $this->urlHelper->getRelativePath($folder . $fileName);
    }
}