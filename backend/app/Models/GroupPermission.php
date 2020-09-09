<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'grouppermission';

    const _GROUPID = 'groupid';
    const _PERMISSIONID = 'permissionid';

    protected $fillable = [
        self::_GROUPID,
        self::_PERMISSIONID,
    ];
}
