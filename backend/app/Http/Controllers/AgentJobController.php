<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgentJob;
use App\Repositories\AgentJobRepository;
use App\Repositories\JobRepository;
use Illuminate\Validation\ValidationException;


class AgentJobController extends Controller
{
    private $agentJobRepo;
    private $jobRepo;
    private $request;

    public function __construct(
        AgentJobRepository $agentJobRepo,
        JobRepository $jobRepo,
        Request $request
    ) {
        $this->agentJobRepo = $agentJobRepo;
        $this->jobRepo = $jobRepo;
        $this->request = $request;
    }

    public function createAgentJob() {
        $rules = [
            AgentJob::_USERID => 'required',
            AgentJob::_JOBID => 'required',
        ];

        try {
            $this->validate($this->request, $rules);
        } catch (ValidationException $e) {
        }

        $agentJob = [
            AgentJob::_USERID => $this->request->input(AgentJob::_USERID),
            AgentJob::_JOBID => $this->request->input(AgentJob::_JOBID),
        ];
        $this->agentJobRepo->create($agentJob);
        return [
            'result' => 'success'
        ];
    }

    public function findAgentJob() {
        $rules = [
            AgentJob::_USERID => 'required',
        ];

        try {
            $this->validate($this->request, $rules);
        } catch (ValidationException $e) {
        }

        $result = $this->agentJobRepo->findAgentJob($this->request->input(AgentJob::_USERID));
        $sss = array();
        foreach ($result as $a) {
            $b = $this->jobRepo->findJobName($a);
            array_push($sss, $b->jobname);
        }
        return $sss;
    }

}
