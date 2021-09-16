<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{

  use SoftDeletes;

  protected $table = 'schedule';

  protected $fillable = ['id', 'timetable_id', 'user_id', 'voucher_id', 'name', 'day', 'phone', 'email', 'quantity', 'payment_value', 'payment_type', 'confirmed', 'paid'];

  /**
   * Timetable
   */
  public function timetable()
  {
    return $this->belongsTo(Timetable::class);
  }


  /**
   * Timetable
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

}
