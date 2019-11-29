<?php

namespace App\Http\Controllers;

use App\Repository\ChatRepositoryInterface;
use App\Repository\MessageRepositoryInterface;
use App\Repository\UserAssigmentRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    protected $chat;
    protected $assigment;
    protected $message;

    public function __construct(
        UserRepositoryInterface $user,
        ChatRepositoryInterface $chat,
        UserAssigmentRepositoryInterface $assigment,
        MessageRepositoryInterface $message
    )
    {
        $this->user = $user;
        $this->chat = $chat;
        $this->assigment = $assigment;
        $this->message = $message;
    }

    public function info()
    {

        $user = auth()->user();

        if(!isset($user->id)) {
            return response()->json([
                'status' => 301,
                'User Error'
            ]);
        }

        $chats = $this->assigment->userChatList($user->id);
        $chatsList = [];

        foreach ($chats as $chat) {
            $chatInfo = $this->chat->get($chat->chat_id);
            $chatsList[$chatInfo->id] = [
                'name' => $chatInfo->name,
                'id' => $chatInfo->id
            ];
        }

        $messages = $this->message->getChatMessages($chats[0]->chat_id, $user->id);

        $outputData = [
            'name' => $user->name,
            'chats' => $chatsList,
            'messages' => $messages
        ];

        return response()->json($outputData);
    }
}
