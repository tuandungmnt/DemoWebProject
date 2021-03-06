<?php

namespace App\Http\Middleware;

require '../vendor/autoload.php';

use Closure;
use Exception;
use http\Message;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Arr;


class ApiMiddleware
{
    public function handle($request, Closure $next) {
        $user = $this->verifyToken($request);
        if (!$user) {
            $permissionDenied = [
                'message' => 'Token không hợp lệ'
            ];
            return response()->json($permissionDenied, 401);
        }

        if ($user['username'] != 'admin') {
            $permissionDenied = [
                'message' => 'Người dùng không có quyền'
            ];
            return response()->json($permissionDenied, 401);
        }

        if ($user['validateTime'] < time()) {
            $permissionDenied = [
                'message' => 'Token het han'
            ];
            return response()->json($permissionDenied, 401);
        }

        $request->attributes->add(['user' => $user]);
        $request->auth = $user;
        return $next($request);
    }

    public function verifyToken(Request $request) {
        $token = $request->header('token');

        if (!$token) {
            $token = $request->input('token');
        }

        if (!$token || $token == 'null') {
            return false;
        }

        try {
            $decode_token = JWT::decode($token, 'key lung tung', array('HS256'));
        } catch (Exception $e) {
            return false;
        }
        return (array)$decode_token;
    }
}
