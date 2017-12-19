<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementUser extends Model
{
    protected $table = 'requirement_user';


    public function requirement()
    {
        return $this->belongsTo('App\Requirement');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }
}
