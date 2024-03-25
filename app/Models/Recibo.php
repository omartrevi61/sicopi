<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    use HasFactory;

    protected $casts = [
        'fecha' => 'datetime:d-m-Y',
    ];

    protected $fillable = [
        'fecha',
        'proyecto_id',
        'tipo_pago_id',
        'beneficiario',
        'user_id',
        'administrativo_id'
    ];
        
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
        
    public function tipo_pago()
    {
        return $this->belongsTo(TipoPago::class);
    }
        
    public function documentos()
    {
        return $this->hasMany(ReciboItems::class);
    }
        
    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
