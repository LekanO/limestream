<?php

namespace App\Http\Controllers;


use App\Http\Controllers\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Carbon\Carbon;
use Thumbnail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Filesystem\Filesystem;

use Image;
use App\UserImage;
use App\User;
//use App\File;
use App\Item;
use App\Video;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function update_avatar(Request $request)
    {
         // check if file exists
        if ($request->hasFile('file')) {
            $avatar = $request->file('file');
            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();

            //$data = Image::make($avatar)->resize(200, 200)->save();
            $s3 = Storage::disk('s3');
        if ($s3->put($fileName, file_get_contents($request->file('file')), 'public')) {

            $user = Auth::user();
            $user->avatar = env('S3_URL') . $fileName;
            $user->save();    
        }
            return response('Success', 200);
        }
    }

    public function video_upload(Request $request)
    {

            /*
            // -i   Input file name
            // -an  Disabled audio
            // -ss  Get image from X seconds in the video
            // -s   Size of the image
            */

            $ffmpeg = "/usr/bin/ffmpeg";

            $file = $request->file('file');

            $imageFile = time() . ".jpg";

            $size = "120x90";

            $getFromSecond = 5;
            
            echo $cmd = "$ffmpeg -i $file -an -ss $getFromSecond -s $size $imageFile";

            $auth = Auth::user()->id;
            $title = "Fishing";
            $type = "video/mp4";


            // set storage path for storge video file checked 
            $s3 = Storage::disk('s3');

            //get file from input checked
            $file = $request->hasFile('file');
            
            if ($file && !shell_exec("cd /var/www/html/smagtv/public/img; $cmd;"))  {
               $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();

                echo $yesterday = Carbon::yesterday();
      
                                
                $thumbnail = time() . ".jpg";
                //$data = Image::make($avatar)->resize(200, 200)->save();

            if ($s3->put($fileName, file_get_contents($request->file('file')), 'public'))
            {  
                $file = Video::create([
                'user_id' => $auth,
                'title' => $title,
                'src' => env('S3_URL') . $fileName,
                'poster' => env('S3_URL') . $thumbnail,
                'type' => $type,
            ]);
                $file->save(); 

                return response('Success', 200);
            }
            else
            {
                echo "thumbnail generation has failed";
            }
        }

         if ($file && !shell_exec("$copy"));
    }


    public function profiledetails(Request $request){

        $auth = Auth::user()->id;

        $items = Item::where('user_id', $auth)->get();

        return response()->json(compact('items'));

    }

    public function uploadImage(Request $request)
    {
        $userId = Auth::user()->id;

        // check if file exists
        if (!$request->hasFile('file')) {
            return response('No file sent', 400);
        }

        // check if file is valid 
        if(!$request->file('file')->isValid()) {
            return response('File is not valid', 400);
        }

        // if validation rules

      /*  $validator = Validator::make($request->all(), [
            'userId' => 'required|integer',
            'file' => 'required|mimes:jpeg,jpg,png|max:8000',
        ]);

        if ($validator->fails()) {
            return response('There are errors in the form data', 400);
        } */

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

        return [
        'file' => $file,
        'thumb' => env('S3_URL') . "user_{$userId}/thumb/" . $fileName,
        'medium' => env('S3_URL') . "user_{$userId}/medium/" . $fileName,
        'main' => env('S3_URL') . "user_{$userId}/main/" . $fileName,
        ];
    } 

    public function show($id)
    {
        $userObj = new User;
        return $userObj->getSingleUser($id);
    }
}


// AKIAIBRODLUZ3QUQRNEA
// 5drqvSRGq/5k/Q5jrkRkCDw7um2mLiWIucnY5KK1