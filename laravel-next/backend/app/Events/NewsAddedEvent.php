<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Haber;
use App\Models\User;

class NewsAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Haber $news;
    public User $user;

    public function __construct(Haber $news, User $user)
    {
        $this->news = $news;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
