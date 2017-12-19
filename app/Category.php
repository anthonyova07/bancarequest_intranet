<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    use SoftDeletes;

    protected $fillable = [ 'name', 'requirement_id' ];



    public function requirement()
    {

        return $this->belongsToMany('App\Requirement');
    }
}
