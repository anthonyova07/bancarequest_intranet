<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{

    use SoftDeletes;
    
 
    protected $table = 'requirements';

    protected $fillable = [

        'name', 'description', 'start',
    ];
    //relaciones
    public function users()
    {
        return $this->belongsToMany('App\User');
    }




    //accesors

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function levels()
    {

        return $this->hasMany('App\Level');
    }



    
}
