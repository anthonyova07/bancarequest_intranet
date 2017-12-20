<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public function category()
    {

        return $this->belongsTo('App\Category');
    }


    public function getPriorityFullAttribute()
    {

        switch ($this->priority) {

            case 'M':
                return 'Menor';

            case 'N':
                return 'Normal';

            default:
                return 'Alta';
        }
    }

    public function getTitleShortAttribute()
    {

        return mb_strimwidth($this->title, 0, 20, '...');
       
    }

    public function getCategoryNameAttribute()
    {
        if ($this->category)
        {
            return $this->category->name;
        }
        return 'General';
    }
}
