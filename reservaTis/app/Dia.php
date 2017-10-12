<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
  protected $table = 'dias';
  public $timestamps = false;

  public function periodos()
  {
      return $this->hasMany('Reserva\Periodo');
  }

  public function reservas()
  {
      return $this->belongsTo('Reserva\Reserva');
  }

}
