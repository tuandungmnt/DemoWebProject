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

        $agent = [
            Agent::_USERNAME => $this->request->input(Agent::_USERNAME),
            Agent::_PASSWORD => $this->request->input(Agent::_PASSWORD),
            Agent::_PHONE => $this->request->input(Agent::_PHONE),
            Agent::_EMAIL => $this->request->input(Agent::_EMAIL),
            Agent::_STATUS => 1,
        ];
        $this->agentRepo->create($agent);

        $this->message = 'Tạo thành công';
        $this->status = 'success';

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

        $data = $this->agentRepo->findAgent($this->request->input(Agent::_USERID));
        if ($data == null) {
            $this->message = 'Người dùng không tồn tại';
            $this->status = 'fail';
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }
}
