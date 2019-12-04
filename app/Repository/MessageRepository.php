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

    public function messageSearch(string $text, array $chatIds)
    {
        $messages = [];
        $messagesData = $this->model
            ->where('text', 'regexp', '/.*' . $text . '/i')
            ->whereIn('chat_id', $chatIds)
            ->orderBy('date', 'asc')
            ->orderBy('_id', 'asc')
            ->take(10)
            ->get();

        foreach ($messagesData as $message) {

            $messages[] = [
                'userId' => $message->user_id,
                'text' => $message->text,
                'time' => date('Y-m-d H:i:s', strtotime($message->date)),
                'in' => $message->chat_id
            ];
        }

        return $messages;
    }
}
