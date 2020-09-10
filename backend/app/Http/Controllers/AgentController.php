<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Repositories\AgentJobRepository;
use App\Repositories\AgentRepository;
use App\Repositories\GroupPermissionRepository;
use App\Repositories\JobGroupRepository;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class AgentController extends Controller
{
    private $agentRepo;
    private $agentJobRepo;
    private $jobGroupRepo;
    private $groupPermissionRepo;
    private $permissionRepo;
    private $request;

    public function __construct(
        AgentRepository $agentRepo,
        AgentJobRepository $agentJobRepo,
        JobGroupRepository $jobGroupRepo,
        GroupPermissionRepository $groupPermissionRepo,
        PermissionRepository $permissionRepo,
        Request $request
    ) {
        $this->agentRepo = $agentRepo;
        $this->agentJobRepo = $agentJobRepo;
        $this->jobGroupRepo = $jobGroupRepo;
        $this->groupPermissionRepo = $groupPermissionRepo;
        $this->permissionRepo = $permissionRepo;
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

    public function getAgentPermissionByToken() {
        $user = $this->request->get('user');
        $userid = Arr::get($user,'userid');
        return $this->findAgentPermission($userid);
    }

    public function findAgentPermission($userid) {
        $jobs = $this->agentJobRepo->findAgentJob($userid);

        $groups = array();
        foreach ($jobs as $job) {
            $t = $this->jobGroupRepo->findJobGroup($job);
            $groups = array_merge($groups, $t);
        }
        $groups = array_unique($groups);

        $permissions = array();
        foreach ($groups as $group) {
            $t = $this->groupPermissionRepo->findGroupPermission($group);
            $permissions = array_merge($permissions, $t);
        }
        $permissions = Arr::sort($permissions);
        $permissions = array_unique($permissions);

        $result = array();
        foreach ($permissions as $permission) {
            $t = $this->permissionRepo->findPermissionById($permission);
            array_push($result, $t->permission);
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        return $this->responseData($result);
    }
}
