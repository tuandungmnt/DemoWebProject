<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Repositories\AgentRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AgentController extends Controller
{
    private $agentRepo;
    private $request;

    public function __construct(
        AgentRepository $agentRepo,
        Request $request
    ) {
        $this->agentRepo = $agentRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function createAgent() {
        $rules = [
            Agent::_USERNAME => 'required',
            Agent::_PASSWORD => 'required',
            Agent::_PHONE => 'required',
            Agent::_EMAIL => 'required',
        ];

        $this->validate($this->request, $rules);

        $username = $this->request->input(Agent::_USERNAME);
        $password = $this->request->input(Agent::_PASSWORD);
        $phone = $this->request->input(Agent::_PHONE);
        $email = $this->request->input(Agent::_EMAIL);

        $agent = $this->agentRepo->findAgentByUsername($username);
        if ($agent != null) {
            $this->message = 'Tên người dùng đã tồn tại!';
            goto next;
        }

        $agent = $this->agentRepo->findAgentByPhone($phone);
        if ($agent != null) {
            $this->message = 'Số điện thoại đã tồn tại!';
            goto next;
        }

        $agent = $this->agentRepo->findAgentByEmail($email);
        if ($agent != null) {
            $this->message = 'Địa chỉ email đã tồn tại!';
            goto next;
        }

        $agent = [
            Agent::_USERNAME => $username,
            Agent::_PASSWORD => $password,
            Agent::_PHONE => $phone,
            Agent::_EMAIL => $email,
            Agent::_STATUS => 1,
        ];

        $this->agentRepo->insert($agent);

        $this->message = 'Tạo thành công';
        $this->status = 'success';

        next:
        return $this->responseData();
    }
    /**
     * @throws ValidationException
     */
    public function findAgent() {
        $rules = [
            Agent::_USERID => 'required'
        ];

        $this->validate($this->request, $rules);

        $data = $this->agentRepo->findAgentById($this->request->input(Agent::_USERID));
        if ($data == null) {
            $this->message = 'Người dùng không tồn tại';
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }
}
