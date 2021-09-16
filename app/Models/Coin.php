<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{


    protected $table = 'coin';
    public $timestamps = false;
    protected $fillable = ['coin', 'percentual', 'profit', 'value', 'date_transaction'];

}
