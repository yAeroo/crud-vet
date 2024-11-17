<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $fillable = ['nombre', 'apellido', 'telefono', 'dui', 'genero', 'mascota_id'];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function genero()
    {
        return $this->belongsTo(GeneroCatalog::class, 'genero'); // Un propietario tiene un género
    }
}
