<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends EloquentRepository
{
    public function getModel()
    {
        return Group::class;
    }

    public function findGroupById($id) {
        return $this->_model
            ->select(
                Group::_GROUPID,
                Group::_GROUPNAME,
                Group::_DESCRIPTION
            )
            ->where(Group::_GROUPID, $id)
            ->first();
    }

    public function findGroupByGroupName($groupName) {
        return $this->_model
            ->select(
                Group::_GROUPID,
                Group::_GROUPNAME,
                Group::_DESCRIPTION
            )
            ->where(Group::_GROUPNAME, $groupName)
            ->first();
    }
}
