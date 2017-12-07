<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Ambiente extends Model
{
    protected $table = 'ambientes';

    public $timestamps = true;

    protected $fillable=['title','capacidad','ubicacion','imagen','facultad_id','tipo_ambiente_id'];

    public function setImagenAttribute($imagen){
        if (!empty($imagen)) {
        $name = Carbon::now()->second.$imagen->getClientOriginalName();
        $this->attributes['imagen'] = $name;
        \Storage::disk('local')->put($name, \File::get($imagen));
       }
    }

    public static function towns($id){
       return Ambiente::where('tipo_ambiente_id','=',$id)
       ->get();
    }

    public function scopeSearch($query,$name){
       return $query->where('title','LIKE', "%$name%");
    }
      public function complementos()
    {
        return $this->belongsToMany('Reserva\Complemento');
    }

    public function tipo_ambiente()
    {
        return $this->belongsTo('Reserva\TipoAmbiente');
    }

    public function facultads()
   {
       return $this->belongsTo('Reserva\Facultad');
   }
   /*ultimo anadido para dosselects*/
   public static function ambientesFacultad($id){
      return Ambiente::where('facultad_id','=',$id)
      ->get();
   }

}
