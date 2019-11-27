<?php


namespace App\Repository;


use App\User;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function saveJWTToken(string $email, string $token)
    {
        $this->model
            ->where('email', $email)
            ->update(
                [
                    'jwt_token' => $token,
                    'token_expires' => strtotime('+60 minutes')
                ]
            );
    }

    public function removeJWTToken(int $id)
    {
        $this->model
            ->where('id', $id)
            ->update(
                [
                    'jwt_token' => '',
                    'token_expires' => ''
                ]
            );
    }

//    public function getUserWithCredentials(array $credentials)
//    {
//        $this->model
//    }
}
