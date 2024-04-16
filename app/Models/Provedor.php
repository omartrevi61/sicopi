<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'rfc',
        'nombre',
        'email',
        'telefono',
        'clabe',
        'banco',
     ];

     // un proveedor tiene varios Documentos (facturas) (ReciboItem)
    public function documentos()
    {
      return $this->hasMany(ReciboItems::class);
    }
}
