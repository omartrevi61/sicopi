<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'recibo_id', 
        'provedor_id',
        'factura',
        'fecha_factura',
        'concepto',
        'importe',
    ];
    
    public function recibo()
    {
        return $this->belongsTo(Recibo::class);
    }
        
    public function provedor()
    {
        return $this->belongsTo(Provedor::class);
    }
}
