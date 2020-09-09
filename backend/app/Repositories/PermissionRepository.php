<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends EloquentRepository
{
    public function getModel()
    {
        return Permission::class;
    }

    public function findPermission($id) {
        return $this->_model
            ->select(
                Permission::_PERMISSION,
                Permission::_DESCRIPTION
            )
            ->where(Permission::_PERMISSIONID, $id)
            ->first();
    }
}
