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
        $this->message = 'Tạo thành công';
        $this->status = 'success';

        return $this->responseData();
    }

    /**
     * @throws ValidationException
     */
    public function findJob() {
        $rules = [
            Job::_JOBID => 'required'
        ];

        $this->validate($this->request, $rules);

        $data = $this->jobRepo->findJob($this->request->input(Job::_JOBID));
        if ($data == null) {
            $this->message = 'Công việc không tồn tại';
            $this->status = 'fail';
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }
}
