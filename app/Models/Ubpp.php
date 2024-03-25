<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubpp extends Model
{
    use HasFactory;

    protected $fillable = [
        'ubpp',
        'nombre',
        'director',
        'extension',
    ];

    public function centros()
    {
        return $this->hasMany(Centro::class);
    }
}
