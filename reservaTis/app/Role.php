<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;
class Role extends EntrustRole
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];


    public function users()
    {
        return $this->belongsToMany('Reserva\User', 'role_user');
    }


    

}
