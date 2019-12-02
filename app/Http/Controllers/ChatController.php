<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Repository\ChatRepositoryInterface;
use App\Repository\MessageRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $user;
    protected $message;
    protected $chat;

    public function __construct(
        UserRepositoryInterface $user,
        MessageRepositoryInterface $message,
        ChatRepositoryInterface $chat
    )
    {
        $this->user = $user;
        $this->message = $message;
        $this->chat = $chat;
    }

    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $inputData = $request->all();

        if(!isset($inputData['message']) || !isset($inputData['chatId'])) {
            return;
        }

        $message = $this->message->create([
            'chat_id' => $inputData['chatId'],
            'user_id' => $user->id,
            'text' => $inputData['message'],
            'date' => date('Y-m-d H:i:s')
        ]);

        $chat = $this->chat->get($inputData['chatId']);

        broadcast(new SendMessage($user, $chat, $message));
    }

    public function chatData(Request $request)
    {
        $chatId = $request->post('id');
        $user = auth()->user();

        if(!isset($chatId) || empty($user)) {
            return;
        }

        $messages = $this->message->getChatMessages($chatId, $user->id);

        foreach ($messages as &$message) {
            $message['author'] = $this->user->get($message['userId'])->name;
        }

        return response()->json([
            'messages' => $messages,
            'id' => $chatId
        ]);
    }
}
