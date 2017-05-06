<?php
namespace App\Http\Controllers;
use App\Commentary;
use App\Events\NewComment;
use App\Live;
use Illuminate\Http\Request;

class CommentaryController extends Controller
{
    public function index(Live $live)
    {
    	return response()->json(
    		$live->commentaries()->with('user')->latest()->get()
		);
    }
    public function store(Live $live)
    {
    	$commentaries = $live->commentaries()->create([
    		'body' => request('body'),
    		'user_id' => auth()->user()->id,
    		'live_id' => $live->id
		]);
        $commentary = Commentary::where('id', $commentary->id)->with('user')->first();
		broadcast(new NewComment($commentary))->toOthers();
		return $commentary;
    }
}