<?php

namespace App\Http\Controllers;

use App\Classes\Uploader;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function showForm()
    {
        return '<form enctype="multipart/form-data" method="POST">'.
            csrf_field() .
            'Choose file <input type="file" name="file" /><br>
            <input type="submit" value="Upload file" />
        </form>';
    }

    public function processUpload(Request $request, Uploader $uploader, Upload $uploadModel)
    {
        $rules = [
            'maxSize' => 10 * 1024 * 1024,
            'minSize' => 10 * 1024,
            'allowedExt' => [
                'jpeg',
                'jpg',
                'png',
                'gif',
                'bmp',
                'tiff',
                'pdf'
            ],
            'allowedMime' => [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/bmp',
                'image/tiff',
                'application/pdf'
            ],
        ];

        if ($uploader->validate($request, 'file', $rules)) {
            $uploadedPath = $uploader->upload('images');

            if ($uploadedPath !== false) {
                $uploadsModel = $uploader->register($uploadModel);
                $uploadedProps = $uploader->getProps();
            }

            return $uploadedPath;
        }
        else {
            dump($uploader->getProps());
            dump($uploader->getErrors());
        }

        //return $uploader->getErrors();
    }
}
