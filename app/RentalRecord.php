<?php

namespace VRSAdmin;

use Illuminate\Database\Eloquent\Model;

class RentalRecord extends Model
{
    public function vehicles(){
        return $this->belongsTo('VRSAdmin\Vehicle');
    }

    public function customer(){
        return $this->belongsTo('VRSAdmin\Customer');
    }
}
