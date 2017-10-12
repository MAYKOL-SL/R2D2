<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $table = 'ambientes';
    //protected $timestamps = false;
        protected $primaryKey='id';
        protected $fillable=['id','nombre_aula','capacidad','ubicacion','tipo_ambiente_id','complemento_id'];

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
