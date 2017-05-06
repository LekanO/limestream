<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['file_name', 'mime_type', 'file_size', 'file_path', 'status', 'type'];
    
    public function user()
    {
    	return $this->belongsTo('App\User');
    }


    public function uploadThumbAndMainImage(Request $request) {

        $s3 = Storage::disk('s3');
        $file = $request->file('file');
        $extension = $request->file('file')->guessExtension();
        $fileName = uniqid() . '.' . $extension;
        $mimeType = $request->file('file')->getClientMimeType();
        $fileSize = $request->file('file')->getClientSize();
        $image = Image::make($file);
        $userId = Auth::user()->id;


        //generate the thumb and medium image

        $imageThumb = Image::make($file)->fit(320)->crop(320, 240, 0, 0);
        $imageThumb->encode($extension);

        $imageMedium = Image::make($file)->resize(800, null, function ($contstraint) {
            $contstraint->aspectRatio();
        });
        $imageMedium->encode($extension);

        $image->encode($extension);

        $s3->put("user_{$userId}/main/" . $fileName, (string) $image, 'public');
        $s3->put("user_{$userId}/medium/" . $fileName, (string) $imageMedium, 'public');
        $s3->put("user_{$userId}/thumb/" . $fileName, (string) $imageThumb, 'public');


        $file = File::create([
            'file_name' => $fileName,
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
            'file_path' => env('S3_URL') . "user_{$fileName}/main/" . $fileName,
            'type' => 's3', 
        ]);

        DB::table('user_images')->insert([
            'user_id' => $userId,
            'file_id' => $file->id,
        ]);

        $fileImg = File::find($file->id);
        $fileImg->status = 1;
        $fileImg->save();

        return response('Success', 200);
    }
}