<?php
/**
 * @author Oluwatosin Amokeodo <oluwatosin.amokeodo@gmail.com>
 * @package CRUD API
 * * @license MIT http://opensource.org/licenses/MIT
 * @since Version 1.0
 */
namespace App\Services;
use Intervention\Image\ImageManagerStatic as Image;

class ImageIntervention
{

    public function thumbnail($data)
    {
        $width = 200;
        $height = 200;
        return $this->imageValidation($data, $width, $height);
    }

    public function fullImage($data)
    {
        $width = 600;
        $height = 600;
        return $this->imageValidation($data, $width, $height);
    }

    protected function imageIntervntion($width, $height, $image)
    {
        Image::make($image)
            ->resize($width, $height, static function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize();
            })
        ->orientate()
        ->sharpen(5)
        ->encode('jpg', 75)
        ->save($image)
        ->destroy();
    }


    /**
     * @param $imageType
     * @param $imageURL
     * @param $tempName
     */
    public function imageValidation($data, $width, $height)
    {
        $arrayType = ["image/jpeg", "image/png", "image/jpg"];
        $mtype = null;
        if(in_array($data['imageType'], $arrayType, true)){
            move_uploaded_file($data['tempName'], $data['imageURL']);
            if(function_exists('finfo_open')){
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mtype = finfo_file($finfo, $data['imageURL']);
                finfo_close($finfo);
            }
            elseif (function_exists('mime_content_type')) {
                $mtype = mime_content_type($data['imageURL']);
            }

            if(in_array($mtype, $arrayType, true)){
                $this->imageIntervntion($width, $height, $data['imageURL']);
                return $data['imageURL'];
            }
            echo "Invalid image selected";
            exit;
        }
        echo "Invalid image selected";
        exit;
    }

}
