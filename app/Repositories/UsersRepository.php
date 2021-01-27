<?php


namespace App\Repositories;


use App\Models\User;

class UsersRepository
{
    public static function getOneById(int $id): ? User
    {
        return User::query()->find($id);
    }

}
