<?php

namespace App\Http\Controllers;

use App\Repository\ChatRepositoryInterface;
use App\Repository\MessageRepositoryInterface;
use App\Repository\UserAssigmentRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    protected $message;
    protected $chat;
    protected $assigment;
    protected $user;

    public function __construct(
        MessageRepositoryInterface $message,
        ChatRepositoryInterface $chat,
        UserAssigmentRepositoryInterface $assigment,
        UserRepositoryInterface $user
    )
    {
        $this->message = $message;
        $this->chat = $chat;
        $this->assigment = $assigment;
        $this->user = $user;
    }

    public function messageSearch(Request $request)
    {
        $text = $request->all('searchFor');
        $user = auth()->user();
        $chatList = [];

        if(count_chars($text['searchFor']) < 2) {
            return response()->json(['status' => 'char count less then 2']);
        }

        $assignedChats = $this->assigment->userChatList($user->id);
        $chatList = $assignedChats->map(function($item, $key) {
            return $item->chat_id;
        })->toArray();

        $messages = $this->message->messageSearch($text['searchFor'], $chatList);

        foreach ($messages as &$message) {
            $message['author'] = $this->user->get($message['userId'])->name;
        }

        return response()->json($messages);
    }
}
