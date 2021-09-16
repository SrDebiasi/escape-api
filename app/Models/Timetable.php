<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{

    protected $table = 'timetable';

    protected $fillable = ['id', 'room_id', 'enable', 'start', 'end','days'];

    /**
     * Room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }


    /**
     * Room
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

}
