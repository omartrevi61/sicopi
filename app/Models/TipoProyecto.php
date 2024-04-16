<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    // un Tipo de Proyecto puede tener varios proyectos
    public function proyectos()
    {
       return $this->hasMany(Proyecto::class);
    }
}
