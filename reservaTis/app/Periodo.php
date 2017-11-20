<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodos';
    public $timestamps = true;
    protected $fillable = ['hora', 'created_at', 'updated_at'];
    
}
