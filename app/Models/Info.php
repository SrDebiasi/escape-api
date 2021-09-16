<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{

    const INFO_ROOM_SIMULTANEOUS = 1;
    const INFO_SCHEDULE_NEW_CONFIRMED_DEFAULT = 1;
    const INFO_SCHEDULE_NEW_SEND_MAIL = 1;

    protected $table = 'info';

    protected $fillable = ['name', 'value', 'company_id', 'user_id'];

    protected $attributes = [
        'value' => 0,
    ];
}
