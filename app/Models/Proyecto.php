<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Database\Eloquent\Casts\Attribute;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto',
        'titulo',
        'tipo_proyecto_id',
        'profesor_id',
        'centro_id',
        'aprobado',
        'porcentaje',
        'asignado',
    ];

    // defino un accesor (atributo) que regresa el asignado ya calculado
    /* public function getAsignadoAttribute()
    {
      return $this->aprobado * $this->porcentaje / 100;
    } */

    public function tipo_proyecto()
    {
       return $this->belongsTo(TipoProyecto::class);
    }

    public function profesor()
    {
       return $this->belongsTo(Profesor::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function centro()
    {
       return $this->belongsTo(Centro::class);
    }

    // un proyecto tiene varios contra-recibos
    public function recibos()
    {
      return $this->hasMany(Recibo::class);
    }

    // un proyecto tiene varios Documentos (ReciboItem) a través de Contra-recibos (Recibo)
    public function documentos()
    {
      return $this->hasManyThrough(ReciboItems::class, Recibo::class);
    }
}
