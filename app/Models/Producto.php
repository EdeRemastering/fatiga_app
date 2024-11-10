<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'descripcion', 'precio'
    ];

    // Relación con solicitudes
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class);
    }
}
