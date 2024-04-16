<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    // un Tipo de Pago existe en varios contra-recibos
    public function recibos()
    {
      return $this->hasMany(Recibo::class);
    }
}
