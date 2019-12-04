<?php


namespace App\Repository;


interface MessageRepositoryInterface
{
    public function getChatMessages(int $chatId, int $userId);

    public function messageSearch(string $text, array $chatIds);
}
