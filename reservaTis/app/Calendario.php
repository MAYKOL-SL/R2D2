<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';
    public $timestamps = false;


    public function tipoFechas()
    {
        return $this->belongsTo('Reserva\TipoFecha');
    }

    
}
