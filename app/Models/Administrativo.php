<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;

    // tabla de jefes de administrativos de la Dgip
    protected $fillable = [
        'expediente',
        'nombre',
    ];
}
