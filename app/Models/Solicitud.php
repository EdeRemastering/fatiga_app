<?php
// app/Models/Solicitud.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';  
    protected $fillable = [
        'producto_id', 'user_id', 'cantidad', 'estado', 'fecha_solicitud'
    ];

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación con user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
