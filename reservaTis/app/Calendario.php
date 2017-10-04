<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';
    protected $timestamps = false;


    public function tipoFechas()
    {
        return $this->belongsTo('Reserva\TipoFecha');
    }

    public function reservas()
    {
        return $this->hasMany('Reserva\Reserva');
    }
}
