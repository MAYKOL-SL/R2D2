<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
     protected $table = 'facultads';
     public $timestamps = false;
     protected $fillable=['nombref','id'];

     public function ambientes()
     {
         return $this->hasMany('Reserva\Ambiente');
     }
}
