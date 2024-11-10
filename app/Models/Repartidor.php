<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    // Definir la tabla y la clave primaria
    protected $table = 'users';  // La tabla 'users' contiene todos los roles, incluyendo repartidor
    protected $primaryKey = 'id';

    // Asegurarse de que no se manejen automáticamente las marcas de tiempo
    public $timestamps = true;

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = [
        'name',
        'email',
        'telefono',
        'direccion',
        'rol'
    ];

    // Función que devuelve solo los repartidores
    public static function obtenerRepartidores()
    {
        return self::where('rol', 'repartidor')->get();
    }

    // Función para obtener un repartidor específico
    public static function obtenerRepartidorPorId($id)
    {
        return self::find($id);
    }
}


