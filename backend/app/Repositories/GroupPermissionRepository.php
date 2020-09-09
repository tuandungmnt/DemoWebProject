<?php

namespace App\Repositories;

use App\Models\GroupPermission;

class GroupPermissionRepository extends EloquentRepository
{
    public function getModel()
    {
        return GroupPermission::class;
    }

    public function findGroupPermission($groupID) {
        $w = $this->_model
            -> select (
                GroupPermission::_PERMISSIONID
            )
            -> where (GroupPermission::_GROUPID, $groupID)
            -> get();

        $array = array();
        foreach($w as $a) {
            array_push($array, $a->permissionid);
        }
        return array_unique($array);
    }
}
