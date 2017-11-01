<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class AmbienteComplemento extends Model
{
    protected $table = 'ambiente_complemento';
    protected $fillable=['ambiente_id','complemento_id'];
}
