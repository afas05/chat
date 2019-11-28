<?php


namespace App\Repository;


interface UserAssigmentRepositoryInterface
{
    public function assigntUser($userId, $chatId);

    public function userChatList($userId);
}
