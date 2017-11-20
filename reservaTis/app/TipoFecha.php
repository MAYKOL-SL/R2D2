<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class TipoFecha extends Model
{
    protected $table = 'tipo_fechas';
    public $timestamps = true;
	protected $fillable=['id', 'nombre_fecha','motivo_feriado'];

    public function calendarios()
    {
        return $this->hasMany('Reserva\Calendario');
    }
}
