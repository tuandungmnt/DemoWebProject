<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentRepository
{
    public function getModel()
    {
        return User::class;
    }
}
