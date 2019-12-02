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
            ->where('chat_id', $chatId)
            ->get();

        $messages = [];

        foreach ($messagesData as $message) {

            $messages[] = [
                'userId' => $message->user_id,
                'text' => $message->text,
                'time' => date('Y-m-d H:i:s', strtotime($message->date)),
            ];
        }

        return $messages;
    }

    public function messageSearch(string $text)
    {
        $messages = $this->model
            ->whereRaw(
                ['$text' => ['$search' => $text]]
            )
            ->orderBy(['score' => ['$meta' => 'textScore']])
            ->orderBy('_id', 'asc')
            ->get();

        return $messages;
    }
}
