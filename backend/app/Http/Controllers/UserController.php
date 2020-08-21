<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(
        UserRepository $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function createUser() {
        $user = [
            User::_NAME => "Quynh Trang",
            User::_AGE => 23,
            User::_PHONE => "0949999999",
            User::_EMAIL => "xoai@gmail.com"
        ];
        $this->userRepo->create($user);
        return "success";
    }

    public function deleteUser() {
        $this->userRepo->delete(8);
        return "delete";
    }

    public function updateUser() {
        $user = [
            User::_NAME => "Q",
            User::_AGE => 24,
            User::_PHONE => "0949999999",
            User::_EMAIL => "xoai@gmail.com"
        ];
        $this->userRepo->update(3, $user);
        return "la";
    }

    public function readUser() {
        return $this->userRepo->readUserInfo(6);
    }
}
