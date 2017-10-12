<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class TipoFecha extends Model
{
    protected $table = 'tipoFechas';
    public $timestamps = false;

    public function calendarios()
    {
        return $this->hasMany('Reserva\Calendario');
    }
}
