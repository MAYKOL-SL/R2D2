<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $table = 'ambientes';
    protected $timestamps = false;

    public function complementos()
    {
        return $this->hasMany('Reserva\Complemento');
    }

    public function tipoAmbientes()
    {
        return $this->belongsTo('Reserva\TipoAmbientes');
    }

    public function reservas()
    {
        return $this->belongsTo('Reserva\Reserva');
    }

}
