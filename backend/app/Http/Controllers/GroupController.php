<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    private $groupRepo;
    private $request;

    public function __construct(
        GroupRepository $groupRepo,
        Request $request
    ) {
        $this->groupRepo = $groupRepo;
        $this->request = $request;
    }

    /**
     * @throws ValidationException
     */
    public function createGroup() {
        $rules = [
            Group::_GROUPNAME => 'required',
            Group::_DESCRIPTION => 'required',
        ];
        $this->validate($this->request, $rules);

        $groupName = $this->request->input(Group::_GROUPNAME);
        $description = $this->request->input(Group::_DESCRIPTION);

        if ($this->groupRepo->findGroupByGroupName($groupName) != null) {
            $this->message = "Tên nhóm đã tồn tại!";
            goto next;
        }

        $group = [
            Group::_GROUPNAME => $groupName,
            Group::_DESCRIPTION => $description,
        ];
        $this->groupRepo->insert($group);
        $this->message = 'Tạo nhóm thành công';
        $this->status = 'success';

        next:
        return $this->responseData();
    }

    /**
     * @throws ValidationException
     */
    public function findGroup() {
        $rules = [
            Group::_GROUPID => 'required'
        ];

        $this->validate($this->request, $rules);

        $data = $this->groupRepo->findGroupById($this->request->input(Group::_GROUPID));
        if ($data == null) {
            $this->message = 'Nhóm không tồn tại';
            goto next;
        }

        $this->message = 'Lấy thông tin thành công';
        $this->status = 'success';
        next:
        return $this->responseData($data);
    }
}
