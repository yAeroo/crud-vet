<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $fillable = ['nombre', 'fecha_nacimiento', 'especie_id', 'genero'];

    public function propietario()
    {
        return $this->belongsTo(Propietario::class, 'id'); // Una mascota pertecene a un propietario
    }

    public function especie()
    {
        return $this->belongsTo(EspecieCatalog::class, 'especie_id'); // Una mascota pertenece a una especie
    }

    public function genero()
    {
        return $this->belongsTo(GeneroCatalog::class, 'genero'); // Una mascota tiene un género
    }
}
