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

class LiveController extends Controller
{
   
    public function index(Request $request)
    {
        $status = 'Online';
        $input = $request->all();
        if($request->get('search')){
           $lives = Live::where("title", "LIKE", "%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $lives = Live::with('Quiz')->where('status', $status)->paginate(5);
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
        $auth = Auth::user()->id;
        $auth_avatar = Auth::user()->avatar;
        $username = Auth::user()->username;
        $title = $request['title'];
        $src = $request['src'];
        $type = $request['type'];
        $status = $request['status'];
        $avatar = $request['avatar'];

        $input = array (
            'user_id' => $auth,
    	    'title' => $username,
            'src' => $src,
            'type' => $type,
            'status' => $status,
            'avatar' => $auth_avatar
    );
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
}