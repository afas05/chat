<?php


namespace App\Repository;

use App\Chat;


class ChatRepository extends BaseRepository implements ChatRepositoryInterface
{
    public function __construct(Chat $chat)
    {
        $this->model = $chat;
    }
}
