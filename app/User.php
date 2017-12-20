<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','selected_requirement_id',
    ];
   

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // relaciones

    public function requirements()
    {
        return $this->belongsToMany('App\Requirement');
    }


    //accesors

    public function getListOfRequirementsAttribute()
    {
       if ($this->role == 1)
            return $this->requirements;

       return Requirement::all();

    }


    public function getIsAdminAttribute()
    {
        return $this->role == 0;

    }

    public function getIsSupportAttribute()
    {
        return $this->role == 1;

    }

    public function getIsClientnAttribute()
    {
        return $this->role == 2;

    }


}
