<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobGroup extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'jobgroup';

    const _JOBID = 'jobid';
    const _GROUPID = 'groupid';

    protected $fillable = [
        self::_JOBID,
        self::_GROUPID,
    ];
}
