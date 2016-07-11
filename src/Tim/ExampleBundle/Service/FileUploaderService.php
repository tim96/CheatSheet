<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/11/2016
 * Time: 9:35 PM
 */

namespace Tim\ExampleBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderService
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        mt_srand();
        // $randomString = substr(str_shuffle(md5(microtime())), 0, 10);
        $randomString = mt_rand();
        // add function to check file exists
        $fileName = sha1($randomString).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }
}