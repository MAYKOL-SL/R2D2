<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'detalle_reservas';
    public $timestamps = true;
  	protected $primaryKey = 'id';
  	protected $fillable = ['estado','reserva_id','calendario_id','periodo_id','ambiente_id'];
}
