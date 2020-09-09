<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Repositories\AgentJobRepository;
use App\Repositories\AgentRepository;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class AgentController extends Controller
{
    private $agentRepo;
    private $agentJobRepo;
    private $jobRepo;
    private $request;

    public function __construct(
        AgentRepository $agentRepo,
        AgentJobRepository $agentJobRepo,
        JobRepository $jobRepo,
        Request $request
    ) {
        $this->agentRepo = $agentRepo;
        $this->agentJobRepo = $agentJobRepo;
        $this->jobRepo = $jobRepo;
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
        $this->agentRepo->insert($agent);

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
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }

    public function getAgentJobByToken() {
        $user = $this->request->get('user');
        $id = Arr::get($user,'userid');
        $result = $this->agentJobRepo->findAgentJob($id);

        $sss = array();
        foreach ($result as $a) {
            $b = $this->jobRepo->findJob($a);
            array_push($sss, $b->jobname);
        }
        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        return $this->responseData($sss);
    }
}
