<?php

namespace App;

abstract class FileBase6
{

	static function pullFile($base64_str, $path)
	{
		$path = storage_path($path);

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $idImage = \Uuid::generate();

        $parts = explode(',' , $base64_str);
        $part = end($parts);

        $extension = $parts[0];
        $extension = str_replace('data:', '',$extension);
        $extension = str_replace(';base64', '',$extension);

        switch($extension){
            case "image/png":
                $image = $path.'/'.$idImage.'.png';
                $ImageUp = file_put_contents($image, base64_decode($part));
                $img_save = $idImage.'.png';
                break; 
            case "image/jpg":
                $image = $path.'/'.$idImage.'.jpg';
                $ImageUp = file_put_contents($image, base64_decode($part));
                $img_save = $idImage.'.jpg';
                break;    
            case "image/jpeg":
                $image = $path.'/'.$idImage.'.jpeg';
                $ImageUp = file_put_contents($image, base64_decode($part));
                $img_save = $idImage.'.jpeg';
                break;
            case "image/svg+xml":
                $image = $path.'/'.$idImage.'.svg';
                $ImageUp = file_put_contents($image, base64_decode($part));
                $img_save = $idImage.'.svg';
                break; 
           default:
                $img_save = false;
                break;       
        }

        return $img_save;
	}

}
