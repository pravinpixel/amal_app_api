<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Storage;
use Intervention\Image\Facades\Image;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $error;

    public function storeImage($image, $folder, $quality = 90)
    {
        $imageName = time() . '.' . ".webp";
        $img = Image::make($image)->orientate()->encode('webp', 100);
        $path = $folder . '/' . $imageName;
        Storage::disk('public')->put($path, (string) $img);
        return $path;
    }

    public function returnError($errors = false, $message = 'Error', $code = 400, $statuscode = '')
    {
        return response([
            'success' => false,
            'message' => $message,
            'statuscode' => $statuscode,
            'error' => $errors
        ], $code);
    }
    public function returnSuccess($data, $message = 'Success')
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
    }
}
