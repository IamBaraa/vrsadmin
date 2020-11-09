<?php

namespace VRSAdmin;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    public function vehicles(){
        return $this->hasMany('VRSAdmin\Vehicle');
    }

    public function rentalRecord(){
        return $this->hasMany('VRSAdmin\RentalRecord');
    }
}
