<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Repositories\JobRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{
    private $jobRepo;
    private $request;

    public function __construct(
        JobRepository $jobRepo,
        Request $request
    ) {
        $this->jobRepo = $jobRepo;
        $this->request = $request;
    }

    /**
     * @return string[]
     * @throws ValidationException
     */
    public function createJob() {
        $rules = [
            Job::_JOBNAME => 'required',
            Job::_DESCRIPTION => 'required',
        ];
            $this->validate($this->request, $rules);

        $job = [
            Job::_JOBNAME => $this->request->input(Job::_JOBNAME),
            Job::_DESCRIPTION => $this->request->input(Job::_DESCRIPTION),
        ];
        $this->jobRepo->insertGetId($job);
        return [
            'result' => 'success'
        ];
    }

    public function findJob() {
        $rules = [
            Job::_JOBID => 'required'
        ];

        try {
            $this->validate($this->request, $rules);
        } catch (ValidationException $e) {
        }

        return $this->jobRepo->findJobName($this->request->input(Job::_JOBID));
    }
}
