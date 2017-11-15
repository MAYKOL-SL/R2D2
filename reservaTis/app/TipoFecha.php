<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class TipoFecha extends Model
{
    protected $table = 'tipo_fechas';
    public $timestamps = false;
	protected $fillable=['nombre_fecha','motivo_feriado'];

    public function calendarios()
    {
        return $this->hasMany('Reserva\Calendario');
    }
}
