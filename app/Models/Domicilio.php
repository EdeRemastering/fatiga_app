<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'direccion_destino', 'estado', 'fecha_entrega'
    ];

    // Relación con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
