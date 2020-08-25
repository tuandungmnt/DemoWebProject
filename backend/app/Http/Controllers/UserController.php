<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;
    private $request;

    public function __construct(
        UserRepository $userRepo,
        Request $request
    ) {
        $this->userRepo = $userRepo;
        $this->request = $request;
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
        return $this->userRepo->readUserInfo($this->request->input('id'));
    }
}
