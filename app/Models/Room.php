<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{

    use SoftDeletes;

    protected $table = 'room';

    protected $fillable = ['id', 'company_id', 'enable', 'name', 'short_name', 'vacancies', 'play_time', 'room_price', 'ticket_price', 'schedule_type', 'picture_large'];

    const SCHEDULE_TYPE_TICKET = 1, SCHEDULE_TYPE_ROOM = 2;

    /**
     * Timetables
     */
    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

}
