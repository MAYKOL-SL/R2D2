<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class TipoAmbiente extends Model
{
    protected $table = 'tipoAmbientes';
    protected $timestamps = false;

    public function ambientes()
    {
        return $this->hasMany('Reserva\Ambiente');
    }

}
