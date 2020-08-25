<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentJob extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'agentjob';

    const _USERID = 'userid';
    const _JOBID = 'jobid';

    protected $fillable = [
        self::_USERID,
        self::_JOBID,
    ];
}
