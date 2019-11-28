<?php


namespace App\Repository;


use App\Message;

class MessageRepository extends BaseRepository implements MessageRepositoryInterface
{
    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function getChatMessages(int $chatId, int $userId)
    {
        $messagesData = $this->model
            ->select(
                [
                    'messages.text',
                    'messages.updated_at',
                    'messages.user_id',
                    'users.name',
                ]
            )
            ->join('users', 'users.id', '=', 'messages.user_id')
            ->where('messages.chat_id', $chatId)
            ->get();

        $messages = [];

        foreach ($messagesData as $message) {
            $messages[] = [
                'text' => $message->text,
                'author' => $message->name,
                'date' => $message->updated_at,
                'style' => $message->user_id == $userId ? 'mine' : 'notmine'
            ];
        }

        return $messages;
    }
}
