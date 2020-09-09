<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentJob;
use App\Repositories\AgentJobRepository;
use App\Repositories\AgentRepository;
use App\Repositories\JobRepository;
use Illuminate\Validation\ValidationException;


class AgentJobController extends Controller
{
    private $agentJobRepo;
    private $agentRepo;
    private $jobRepo;
    private $request;

    public function __construct(
        AgentJobRepository $agentJobRepo,
        AgentRepository $agentRepo,
        JobRepository $jobRepo,
        Request $request
    ) {
        $this->agentJobRepo = $agentJobRepo;
        $this->agentRepo = $agentRepo;
        $this->jobRepo = $jobRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function createAgentJob() {
        $rules = [
            AgentJob::_USERID => 'required',
            AgentJob::_JOBID => 'required',
        ];

        $this->validate($this->request, $rules);

        $userid = $this->request->input(AgentJob::_USERID);
        $jobid = $this->request->input(AgentJob::_JOBID);

        $agent = $this->agentRepo->findAgent($userid);
        $job = $this->jobRepo->findJob($jobid);

        if ($agent == null || $agent->status == 0) {
            $this->message = 'Người đùng không tồn tại hoặc đã ngừng hoạt động';
            goto next;
        }

        if ($job == null) {
            $this->message = 'Công việc không tồn tại';
            goto next;
        }

        $agentJob = [
            AgentJob::_USERID => $userid,
            AgentJob::_JOBID => $jobid,
        ];
        $this->agentJobRepo->create($agentJob);
        $this->message = 'Tạo thành công';
        $this->status = 'success';

        next:
        return $this->responseData();
    }

    /**
     * @throws ValidationException
     */
    public function findAgentJob() {
        $rules = [
            AgentJob::_USERID => 'required'
        ];

        $this->validate($this->request, $rules);

        $userid = $this->request->input(AgentJob::_USERID);
        $agent = $this->agentRepo->findAgent($userid);
        $sss = array();

        if ($agent == null || $agent->status == 0) {
            $this->message = 'Người đùng không tồn tại hoặc đã ngừng hoạt động';
            goto next;
        }

        $result = $this->agentJobRepo->findAgentJob($userid);

        foreach ($result as $a) {
            $b = $this->jobRepo->findJob($a);
            array_push($sss, $b->jobname);
        }
        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($sss);
    }

}
