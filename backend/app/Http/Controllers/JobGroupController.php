<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobGroup;
use App\Repositories\JobGroupRepository;
use App\Repositories\GroupRepository;
use App\Repositories\JobRepository;
use Illuminate\Validation\ValidationException;


class JobGroupController extends Controller
{
    private $jobGroupRepo;
    private $jobRepo;
    private $groupRepo;
    private $request;

    public function __construct(
        JobGroupRepository $jobGroupRepo,
        JobRepository $jobRepo,
        GroupRepository $groupRepo,
        Request $request
    ) {
        $this->jobGroupRepo = $jobGroupRepo;
        $this->jobRepo = $jobRepo;
        $this->groupRepo = $groupRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function createJobGroup() {
        $rules = [
            JobGroup::_JOBID => 'required',
            JobGroup::_GROUPID => 'required',
        ];

        $this->validate($this->request, $rules);

        $jobid = $this->request->input(JobGroup::_JOBID);
        $groupid = $this->request->input(JobGroup::_GROUPID);

        $job = $this->jobRepo->findJob($jobid);
        $group = $this->groupRepo->findgroup($groupid);

        if ($job == null) {
            $this->message = 'Công việc không tồn tại';
            goto next;
        }

        if ($group == null) {
            $this->message = 'Nhóm không tồn tại';
            goto next;
        }

        $jobGroup = [
            JobGroup::_JOBID => $jobid,
            JobGroup::_GROUPID => $groupid,
        ];
        $this->jobGroupRepo->create($jobGroup);
        $this->message = 'Tạo thành công';
        $this->status = 'success';

        next:
        return $this->responseData();
    }

    /**
     * @throws ValidationException
     */
    public function findJobGroup() {
        $rules = [
            JobGroup::_JOBID => 'required'
        ];

        $this->validate($this->request, $rules);

        $jobid = $this->request->input(JobGroup::_JOBID);
        $job = $this->jobRepo->findJob($jobid);
        $sss = array();

        if ($job == null) {
            $this->message = 'Công việc không tồn tại';
            goto next;
        }

        $result = $this->jobGroupRepo->findJobGroup($jobid);

        foreach ($result as $a) {
            $b = $this->groupRepo->findGroup($a);
            array_push($sss, $b->groupname);
        }
        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($sss);
    }

}
