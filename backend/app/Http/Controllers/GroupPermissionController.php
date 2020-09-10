<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupPermission;
use App\Repositories\GroupPermissionRepository;
use App\Repositories\GroupRepository;
use App\Repositories\PermissionRepository;
use Illuminate\Validation\ValidationException;


class GroupPermissionController extends Controller
{
    private $groupPermissionRepo;
    private $groupRepo;
    private $permissionRepo;
    private $request;

    public function __construct(
        GroupPermissionRepository $groupPermissionRepo,
        GroupRepository $groupRepo,
        PermissionRepository $permissionRepo,
        Request $request
    ) {
        $this->groupPermissionRepo = $groupPermissionRepo;
        $this->groupRepo = $groupRepo;
        $this->permissionRepo = $permissionRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function createGroupPermission() {
        $rules = [
            GroupPermission::_GROUPID => 'required',
            GroupPermission::_PERMISSIONID => 'required',
        ];

        $this->validate($this->request, $rules);

        $groupid = $this->request->input(GroupPermission::_GROUPID);
        $permissionid = $this->request->input(GroupPermission::_PERMISSIONID);

        $group = $this->groupRepo->findGroupById($groupid);
        $permission = $this->permissionRepo->findPermissionById($permissionid);

        if ($group == null) {
            $this->message = 'Nhóm không tồn tại';
            goto next;
        }

        if ($permission == null) {
            $this->message = 'Quyền không tồn tại';
            goto next;
        }

        $groupPermission = [
            GroupPermission::_GROUPID => $groupid,
            GroupPermission::_PERMISSIONID => $permissionid,
        ];
        $this->groupPermissionRepo->create($groupPermission);
        $this->message = 'Tạo thành công';
        $this->status = 'success';

        next:
        return $this->responseData();
    }

    /**
     * @throws ValidationException
     */
    public function findGroupPermission() {
        $rules = [
            GroupPermission::_GROUPID => 'required'
        ];

        $this->validate($this->request, $rules);

        $groupid = $this->request->input(GroupPermission::_GROUPID);
        $group = $this->groupRepo->findGroupById($groupid);
        $sss = array();

        if ($group == null) {
            $this->message = 'Nhóm không tồn tại';
            goto next;
        }

        $result = $this->groupPermissionRepo->findGroupPermission($groupid);

        foreach ($result as $a) {
            $b = $this->permissionRepo->findPermissionById($a);
            array_push($sss, $b->permission);
        }
        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($sss);
    }

}
