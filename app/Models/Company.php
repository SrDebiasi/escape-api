<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['company_id', 'name', 'email', 'uid', 'email', 'address', 'zip_code', 'estate', 'country', 'logo'];


    protected $table = 'company';

    /**
     * Users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_company', 'company_id', 'user_id');
    }

}
