<?php

namespace Reserva;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
  protected $table = 'reservas';
<<<<<<< Updated upstream
  public $timestamps = true;
  	protected $primaryKey = 'id';
  	protected $fillable = [
  		'nombre_reserva','description','start','end','user_id'
  	];
=======
  public $timestamps = false;
  protected $fillable = ['nombre_reserva', 'description','start', 'end', 'created_at', 'updated_at', 'user_id'];

>>>>>>> Stashed changes

    public function users()
    {
        return $this->belongsTo('Reserva\User');
    }
}
