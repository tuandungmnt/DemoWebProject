<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PermissionController extends Controller
{
    private $permissionRepo;
    private $request;

    public function __construct(
        PermissionRepository $permissionRepo,
        Request $request
    ) {
        $this->permissionRepo = $permissionRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function createPermission() {
        $rules = [
            Permission::_PERMISSION => 'required',
            Permission::_DESCRIPTION => 'required',
        ];
        $this->validate($this->request, $rules);

        $permission = $this->request->input(Permission::_PERMISSION);
        $description = $this->request->input(Permission::_DESCRIPTION);

        if ($this->permissionRepo->findPermissionByPermission($permission) != null) {
            $this->message = 'Quyền đã tồn tại!';
            goto next;
        }

        $job = [
            Permission::_PERMISSION => $permission,
            Permission::_DESCRIPTION => $description,
        ];
        $this->permissionRepo->insert($job);
        $this->message = 'Tạo thành công';
        $this->status = 'success';

        next:
        return $this->responseData();
    }

    /**
     * @throws ValidationException
     */
    public function findPermission() {
        $rules = [
            Permission::_PERMISSIONID => 'required'
        ];

        $this->validate($this->request, $rules);

        $data = $this->permissionRepo->findPermissionById($this->request->input(Permission::_PERMISSIONID));
        if ($data == null) {
            $this->message = 'Quyền không tồn tại';
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }
}
