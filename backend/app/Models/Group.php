<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'group';

    const _GROUPID = 'groupid';
    const _GROUPNAME = 'groupname';
    const _DESCRIPTION = 'description';

    protected $fillable = [
        self::_GROUPID,
        self::_GROUPNAME,
        self::_DESCRIPTION,
    ];
}
