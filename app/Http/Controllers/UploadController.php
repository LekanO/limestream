<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Image;
use App\UserImage;

use App\Http\Requests;




class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        $userId = $request->input('userId');

        // check if file exists
        if (!$request->hasFile('file')) {
            return response('No file sent', 400);
        }

        // check if file is valid
        if(!$request->file('file')->isValid()) {
            return response('File is not valid', 400);
        }
        // validating
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer',
            'file' => 'required|mimes:jpeg,jpg,png|max:80000',

        ]);

        if ($validator->fails()) {
            return response('There are errors in the form', 400);
        }

        $mimeType = $request->file('file')->getClientMimeType();
        $fileSize = $request->file('file')->getClientSize();
        $fileName = 'user_' . $userId . '_' . uniqid() . '.' . $request->file('file')->guessClientExtension();

        $s3 = Storage::disk('s3');
        if ($s3->put($fileName, file_get_contents($request->file('file')), 'public')) {
            $file = File::create([
                'file_name' => $fileName,
                'mime_type' => $mimeType,
                'file_size' => $fileSize,
                'file_path' => env('S3_URL') . $fileName,
                'type' => 's3', 
            ]);

            DB::table('user_images')->insert([
                'user_id' => $userId,
                'file_id' => $file->id,
            ]);

            $fileImg = File::find($file->id);
            $fileImg->status = 1;
            $fileImg->save();
        }

        return response($file, 201);

    }   
}
