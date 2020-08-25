<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'job';

    const _JOBID = 'jobid';
    const _JOBNAME = 'jobname';
    const _DESCRIPTION = 'description';

    protected $fillable = [
        self::_JOBID,
        self::_JOBNAME,
        self::_DESCRIPTION,
    ];
}
