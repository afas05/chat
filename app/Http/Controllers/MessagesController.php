<?php

namespace App\Http\Controllers;

use App\Repository\ChatRepositoryInterface;
use App\Repository\MessageRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    protected $message;
    protected $chat;

    public function __construct(
        MessageRepositoryInterface $message,
        ChatRepositoryInterface $chat
    )
    {
        $this->message = $message;
        $this->chat = $chat;
    }

    public function messageSearch(Request $request)
    {
        $text = $request->all('searchFor');

        if(count_chars($text['searchFor']) < 2) {
            return response()->json(['status' => 'char count less then 2']);
        }

        $messages = $this->message->messageSearch($text['searchFor']);

        return response()->json($messages);
    }
}
