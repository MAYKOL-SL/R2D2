<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'detalle_reservas';
<<<<<<< Updated upstream
    public $timestamps = true;
  	protected $primaryKey = 'id';
  	protected $fillable = ['estado','reserva_id','calendario_id','periodo_id','ambiente_id'];
=======
    protected $fillable = ['created_at', 'updated_at', 'reserva_id', 'calendario_id', 'periodo_id', 'ambiente_id'];
>>>>>>> Stashed changes
}
