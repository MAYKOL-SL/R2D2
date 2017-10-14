<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    //protected $table = 'permissions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    //protected $fillable = ['name', 'display_name', 'description'];

    /*public function roles()
    {
        return $this->belongsToMany('Reserva\Role');
    }*/

}
