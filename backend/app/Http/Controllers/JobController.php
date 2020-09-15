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

        $id = null;
        $jobName = $this->request->input(Job::_JOBNAME);
        $description = $this->request->input(Job::_DESCRIPTION);

        if ($this->jobRepo->findJobByJobName($jobName) != null) {
            $this->message = "Công việc đã tồn tại!";
            goto next;
        }

        $job = [
            Job::_JOBNAME => $jobName,
            Job::_DESCRIPTION => $description,
        ];
        $id = $this->jobRepo->insertGetId($job);
        $this->message = 'Tạo thành công, id của công việc là '."$id";
        $this->status = 'success';

        next:
        return $this->responseData($id);
    }

    /**
     * @throws ValidationException
     */
    public function findJob() {
        $rules = [
            Job::_JOBID => 'required'
        ];

        $this->validate($this->request, $rules);

        $data = $this->jobRepo->findJobById($this->request->input(Job::_JOBID));
        if ($data == null) {
            $this->message = 'Công việc không tồn tại';
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }
}
