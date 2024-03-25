<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediente',
        'nombre',
        'apellidos',
        'grado',
        'email',
        'telefono',
        'ubpp_id'
    ];

    // un responsable pertenece a una Ubpp
    public function ubpp()
    {
        return $this->belongsTo(Ubpp::class);
    }

    // un responsable puede tener varios proyectos
    public function proyectos()
    {
       return $this->hasMany(Proyecto::class);
    }
}
