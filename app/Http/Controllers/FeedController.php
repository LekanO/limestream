<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Events\NewFeed;
use App\Live;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(Live $live)
    {
    	return response()->json(
    		$live->feeds()->with('user')->latest()->get()
		);
    }

    public function store(Live $live)
    {
    	$feed = $live->feeds()->create([
    		'body' => request('body'),
    		'user_id' => auth()->user()->id,
    		'live_id' => $live->id
		]);
        $feed = Feed::where('id', $feed->id)->with('user')->first();
		broadcast(new NewFeed($feed))->toOthers();
		return $feed;
    }
}