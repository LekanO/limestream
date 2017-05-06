<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use App\Video;
use App\Quiz;
use App\Comment;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
           $videos = Video::where("name", "LIKE", "%{$request->get('search')}%")
                ->paginate(5);
        }else{
                $videos = Video::with('Quiz')->paginate(5);
//		$videos = Quiz::paginate(5);
        }
        return response($videos);
    }

    public function getVideo($id)
    {
        $data = Video::with('Quiz')->where('id',$id)->get();
        
        return response()->json(compact('data'));
    }

    public function store(Request $request)
    {
	$input = $request->all();
	$create = Video::create($input);
	return response($create);
    }
    public function edit($id)
    {
        $video = Video::find($id);
        return response($video);
    }
    public function update(Request $request,$id)
    {
    	$input = $request->all();
        Video::where("id",$id)->update($input);
        $video = Video::find($id);
        return response($video);
    }
    public function destroy($id)
    {
        return Video::where('id',$id)->delete();
    }
//    public function getvideo($id)
//    {
 //       $video = Video::where('id',$id)->get();       
        
   //     return ($video);
  //  }
}