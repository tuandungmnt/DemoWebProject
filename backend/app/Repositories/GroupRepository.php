<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends EloquentRepository
{
    public function getModel()
    {
        return Group::class;
    }

    public function findGroup($id) {
        return $this->_model
            ->select(
                Group::_GROUPNAME,
                Group::_DESCRIPTION
            )
            ->where(Group::_GROUPID, $id)
            ->first();
    }
}
