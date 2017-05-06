<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;
use App\Live;
use App\Quiz;

class DashLiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    public function index(Request $request)
    {
     
        $status = 'Online';
        
        $input = $request->all();
        if($request->get('search')){
           $lives = Live::where("title", "LIKE", "%{$request->get('search')}%")
                ->paginate(5);
        }else{
                $lives = Live::where('status', $status)->paginate(5);
        //  $videos = Quiz::paginate(5);
        }
        return response($lives);
    }

    public function getLive($id)
    {
        $data = Live::where('id',$id)->get();
        
        return response()->json(compact('data'));
    }

    public function store(Request $request)
    {
	$input = $request->all();
	$create = Live::create($input);
	return response($create);
    }
    public function edit($id)
    {
        $live = Live::find($id);
        return response($live);
    }
    public function update(Request $request,$id)
    {
    	$input = $request->all();
        Live::where("id",$id)->update($input);
        $live = Live::find($id);
        return response($live);
    }
    public function destroy($id)
    {
        return Live::where('id',$id)->delete();
    }
//    public function getvideo($id)
//    {
 //       $video = Video::where('id',$id)->get();       
        
   //     return ($video);
  //  }
}