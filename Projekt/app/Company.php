<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{   
    //
    protected $table = "company";
    
    protected $fillable = [
         'company_name', 'operating_status',
    ];
    
    public function user()
    {
        return $this->hasMany('App\User', 'company_id');
    }
}
