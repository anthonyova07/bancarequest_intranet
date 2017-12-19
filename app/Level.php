<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','requirement_id'];


    public function requirement()
    {

        return $this->belongsTo('App\Requirement');
    }

}
