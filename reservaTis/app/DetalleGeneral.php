<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class DetalleGeneral extends Model
{
	//protected $table = 'detalle_general';
    public $timestamps = false;
  	//protected $primaryKey = 'id';
  	protected $fillable = ['calendario_id','fecha','periodo_id','hora','ambiente_id','title','capacidad'];
}
