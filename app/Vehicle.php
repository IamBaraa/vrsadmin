<?php

namespace VRSAdmin;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function customer(){
        return $this->belongsTo('VRSAdmin\Customer');
    }

    public function rentalRecord(){
        return $this->hasMany('VRSAdmin\RentalRecord');
    }
}
