<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $table = 'ambientes';

    public $timestamps = false;

    protected $fillable=['title','capacidad','ubicacion','tipo_ambiente_id','complemento_id'];

    public static function towns($id){
       return Ambiente::where('tipo_ambiente_id','=',$id)
       ->get();
    }

    public function scopeSearch($query,$name){
       return $query->where('title','LIKE', "%$name%");
    }
      public function complementos()
    {
        return $this->hasMany('Reserva\Complemento');
    }

    public function tipoAmbientes()
    {
        return $this->belongsTo('Reserva\TipoAmbientes');
    }

    

}
