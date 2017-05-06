<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;


use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Requests;

use App\Comment;
use App\Video;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
        /**
     * Send back all comments as JSON
     *
     * @return Response
     */
    public function index(Request $request, $video_id)
    {
        return response()->json(Comment::where('video_id', $video_id)->get());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, $video_id)
    {
        $author = Auth::user()->username;
        $auth = Auth::user()->id;        
        $img = Auth::user()->avatar;
        $title = $request['text'];

        $video = Video::find($video_id);

        $comment = new Comment();
        $comment->user_id = $auth;
        $comment->video()->associate($video);
        $comment->author = $author;
        $comment->img = $img;
        $comment->text = $request['text'];

        $comment->save();

        /* Comment::create(array(
            'author' => $username,
            'img' => $img,
            'video_id' => $img,
            'text' => Input::get('text')
        ));
        return response()->json(array('success' => true)); */
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        Comment::destroy($id);
    
        return Response::json(array('success' => true));
    }
    
}
 