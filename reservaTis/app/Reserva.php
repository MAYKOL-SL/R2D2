<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
  protected $table = 'reservas';
  public $timestamps = true;
  	protected $primaryKey = 'id';
  	protected $fillable = [
  		'nombre_reserva','description','start','end','user_id'
  	];

    
    public function users()
    {
        return $this->belongsTo('Reserva\User');
    }
}
