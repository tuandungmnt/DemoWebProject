<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'permission';

    const _PERMISSIONID = 'permissionid';
    const _PERMISSION = 'permission';
    const _DESCRIPTION = 'description';

    protected $fillable = [
        self::_PERMISSIONID,
        self::_PERMISSION,
        self::_DESCRIPTION,
    ];
}
