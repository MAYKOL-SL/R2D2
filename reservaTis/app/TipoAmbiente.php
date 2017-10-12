<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class TipoAmbiente extends Model
{
    protected $table = 'tipo_ambientes';
        protected $primaryKey='id';
    	protected $fillable=['tipo_aula','id'];

}
