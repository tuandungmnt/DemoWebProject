<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'user';

    const _USERID = 'userid';
    const _USERNAME = 'username';
    const _PASSWORD = 'password';
    const _PHONE = 'phone';
    const _EMAIL = 'email';
    const _STATUS = 'status';

    protected $fillable = [
        self::_USERID,
        self::_USERNAME,
        self::_PASSWORD,
        self::_PHONE,
        self::_EMAIL,
        self::_STATUS,
    ];
}
