<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Fullcalendarevento extends Model
{
    protected $table = 'fullcalendareventos';
    protected $fillable =['start', 'end', 'title', 'color', 'id'];
    protected $hidden = ['id_event'];


}
