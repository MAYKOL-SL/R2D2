<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
  protected $table = 'reservas';
  public $timestamps = false;

    
    public function users()
    {
        return $this->belongsTo('Reserva\User');
    }
}
