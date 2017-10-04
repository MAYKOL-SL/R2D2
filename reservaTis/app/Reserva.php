<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
  protected $table = 'reservas';
  protected $timestamps = false;

    public function ambientes()
    {
        return $this->hasOne('App\Ambiente');
    }

    public function dias()
    {
        return $this->hasMany('Reserva\Dia');
    }

    public function calendarios()
    {
        return $this->belongsTo('Reserva\Calendario');
    }

    public function users()
    {
        return $this->belongsTo('Reserva\User');
    }
}
