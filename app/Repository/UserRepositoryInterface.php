<?php


namespace App\Repository;


interface UserRepositoryInterface
{
    public function saveJWTToken (string $email, string $token);

    public function removeJWTToken(int $id);
}
