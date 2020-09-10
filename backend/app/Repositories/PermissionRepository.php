<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends EloquentRepository
{
    public function getModel()
    {
        return Permission::class;
    }

    public function findPermissionById($id) {
        return $this->_model
            ->select(
                Permission::_PERMISSIONID,
                Permission::_PERMISSION,
                Permission::_DESCRIPTION
            )
            ->where(Permission::_PERMISSIONID, $id)
            ->first();
    }

    public function findPermissionByPermission($permission) {
        return $this->_model
            ->select(
                Permission::_PERMISSIONID,
                Permission::_PERMISSION,
                Permission::_DESCRIPTION
            )
            ->where(Permission::_PERMISSION, $permission)
            ->first();
    }
}
