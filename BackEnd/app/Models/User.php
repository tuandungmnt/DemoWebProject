<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = self::TABLE;
    public $timestamps = false;

    const TABLE = 'user';

    const _ID = 'id';
    const _NAME = 'name';
    const _AGE = 'age';
    const _PHONE = 'phone';
    const _EMAIL = 'email';

    protected $fillable = [
        self::_ID,
        self::_NAME,
        self::_AGE,
        self::_PHONE,
        self::_EMAIL
    ];
}
