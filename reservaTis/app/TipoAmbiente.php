<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class TipoAmbiente extends Model
{
    protected $table = 'tipo_ambientes';
    public $timestamps = false;
    protected $fillable=['tipo_aula','id'];

    public function ambientes()
    {
        return $this->hasMany('Reserva\Ambiente');
    }
}
