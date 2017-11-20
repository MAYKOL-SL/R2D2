<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';
    public $timestamps = true;
    protected $fillable = ['id', 'Fecha', 'Dia', 'Actividad', 'created_at', 'updated_at'];


    public function tipoFechas()
    {
        return $this->belongsTo('Reserva\TipoFecha');
    }

    
}
