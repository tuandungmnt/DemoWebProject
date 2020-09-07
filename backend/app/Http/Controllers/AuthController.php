<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Agent;
use App\Repositories\AgentRepository;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use \Firebase\JWT\JWT;

class AuthController extends Controller
{
    private $agentRepo;
    private $authRepo;
    private $request;

    public function __construct(
        AgentRepository $agentRepo,
        AuthRepository $authRepo,
        Request $request
    ) {
        $this->agentRepo = $agentRepo;
        $this->authRepo = $authRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function auth() {
        $rules = [
            Agent::_USERNAME => 'required',
            Agent::_PASSWORD => 'required',
        ];

        $this->validate($this->request, $rules);

        $username = $this->request->input(Agent::_USERNAME);
        $password = $this->request->input(Agent::_PASSWORD);
        $token = '';

        $agent = $this->agentRepo->findAgentByUsernameAndPassword($username, $password);
        if ($agent == null || $agent->status == 0) {
            $this->message = 'Người đùng không tồn tại hoặc đã ngừng hoạt động';
            goto next;
        }

        $token = JWT::encode($agent, 'key lung tung');
        $this->message = 'Đăng nhập thành công';
        $this->status = 'success';
        next:
        return $this->responseData($token);
    }
}
