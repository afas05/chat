<?php

namespace App\Events;

use App\Chat;
use App\Message;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $chat;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Message $message
     * @param Chat $chat
     */
    public function __construct(User $user, Chat $chat, Message $message)
    {
        $this->message = $message;
        $this->chat = $chat;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chatId-' . $this->chat->id);
    }

    public function broadcastWith()
    {
        return [
            'text' => $this->message->text,
            'author' => $this->user->name,
            'time' => date('Y-m-d H:i:s', strtotime($this->message->created_at)),
            'style' => 'notmine'
        ];
    }
}
