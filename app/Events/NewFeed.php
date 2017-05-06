<?php

namespace App\Events;

use App\Feed;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewFeed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feed;

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    public function broadcastOn()
    {
        return new PresenceChannel('live');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->feed->id,
            'body' => $this->feed->body,
            'user' => [
                'name' => $this->feed->user->name,
                'id' => $this->feed->user->id,
            ],
        ];
    }
}
