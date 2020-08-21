<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function readUserInfo($userId) {
        return $this->_model
            ->select(
                User::_ID,
                User::_NAME,
                User::_AGE,
                User::_PHONE,
                User::_EMAIL
            )
            ->where(User::_ID, $userId)
            ->first();
    }
}
