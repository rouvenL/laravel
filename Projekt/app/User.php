<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    
    const ADMIN_TYPE= 'admin'; //Variable for admin users
    const DEFAULT_TYPE = 'default'; //Variable for normal users
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'company_id', 'surname', 'name', 'email', 'password', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getIsAdminAttribute() {
        return true;
    }
    
    public function isAdmin(){
            return $this->type === self::ADMIN_TYPE; //Checks if someone is Admin
    }
    
    public function company()
   {        
        return $this->belongsTo('App\Company');
   } 
}
