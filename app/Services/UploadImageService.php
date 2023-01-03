<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class UploadImageService 
{

    public function Upload($image)
    {
        $extension = $image->getClientOriginalExtension();
        $url = Carbon::now().''.$image->getFilename() . '.' . $extension;
        Storage::disk('public')->put($url,File::get($image));
        return $url;
    }
}