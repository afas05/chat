<?php


namespace App\Repository;


use App\UserAssigment;

class UserAssigmentRepository extends BaseRepository implements UserAssigmentRepositoryInterface
{
    public function __construct(UserAssigment $assigment)
    {
        $this->model = $assigment;
    }

    public function assigntUser($userId, $chatId)
    {
        $this->model->insert(
            [
                'user_id' => $userId,
                'chat_id' => $chatId
            ]
        );
    }

    public function userChatList($userId)
    {
        return $this->model
            ->where('user_id', $userId)
            ->get();
    }
}
