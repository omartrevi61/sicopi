<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $fillable = [
        'centro',
        'nombre',
        'coordinador',
        'ubpp_id',
        'proy_ptal'
    ];

    public function ubpp()
    {
        return $this->belongsTo(Ubpp::class);
    }

    // un centro puede tener varios proyectos
    public function proyectos()
    {
       return $this->hasMany(Proyecto::class);
    }
}
