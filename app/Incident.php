<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    public function category()
    {

        return $this->belongsTo('App\Category');
    }

    public function requirement()
    {

        return $this->belongsTo('App\Requirement');
    }

    public function support()
    {

        return $this->belongsTo('App\User', 'support_id');
    }

    public function client()
    {

        return $this->belongsTo('App\User', 'client_id');
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

    public function getSupportNameAttribute()
    {
        if ($this->support)
        {
            return $this->support->name;
        }
        return 'Sin asignar';
    }

    // public function getStateAttribute()
    // {

    //     if (($this->active == 0))
    //     {
    //         return 'Resuelto';
    //     }ten

    //     if ( $this->support_id ) //$this->support_id ||
    //     { 
    //         return 'Asignado';            
    //     }
       
    //     return 'Pendiente';
        

       
        
    // }
}
