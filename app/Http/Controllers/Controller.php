<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
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
    public function storeDocument($document, $folder)
    {
        $documentName = time() . '.' . $document->getClientOriginalExtension();
        $path = $folder . '/' . $documentName;
        Storage::disk('public')->put($path, (string) file_get_contents($document));
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

    public function createActivityLog($module, $moduleId, $doneBy, $oldValue, $newValue, $message)
    {
        ActivityLog::create([
            'module' => $module,
            'moduleId' => $moduleId,
            'doneBy' => $doneBy,
            'oldValue' => $oldValue,
            'newValue' => $newValue,
            'message' => $message
        ]);
    }
}
