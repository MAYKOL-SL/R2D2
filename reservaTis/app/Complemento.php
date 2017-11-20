<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
    protected $table = 'complementos';
    public $timestamps = true;
    protected $fillable =['nombre_complemento','estado'];

    public function ambientes()
    {
        return $this->belongsToMany('Reserva\Ambiente');
    }
}
