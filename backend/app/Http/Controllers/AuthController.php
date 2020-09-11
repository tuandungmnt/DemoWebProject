<?php

namespace App\Http\Controllers;

require '../vendor/autoload.php';

use App\Models\Agent;
use App\Repositories\AgentJobRepository;
use App\Repositories\AgentRepository;
use App\Repositories\GroupPermissionRepository;
use App\Repositories\JobGroupRepository;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use \Firebase\JWT\JWT;

class AuthController extends Controller
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
    public function auth() {
        $rules = [
            Agent::_USERNAME => 'required',
            Agent::_PASSWORD => 'required',
        ];

        $this->validate($this->request, $rules);

        $username = $this->request->input(Agent::_USERNAME);
        $password = $this->request->input(Agent::_PASSWORD);
        $token = '';
        $url = '';
        $permissions = '';

        $agent = $this->agentRepo->findAgentByUsernameAndPassword($username, $password);
        if ($agent == null || $agent->status == 0) {
            $this->message = 'Người đùng không tồn tại hoặc đã ngừng hoạt động';
            goto next;
        }

        $agent['validateTime'] = time() + (60 * 60);

        $token = JWT::encode($agent, 'key lung tung');
        if ($username == 'admin') $url = '/admin';
        else $url = '/user';
        $permissions = $this->findAgentPermission($agent->userid);

        $this->message = 'Đăng nhập thành công';
        $this->status = 'success';
        next:
        $result = ['token' => $token, 'url' => $url, 'permissions' => $permissions];
        return $this->responseData($result);
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
        $permissions = array_unique($permissions);

        $result = array();
        foreach ($permissions as $permission) {
            $t = $this->permissionRepo->findPermissionById($permission);
            array_push($result, $t->permission);
        }
        return $result;
    }
}
