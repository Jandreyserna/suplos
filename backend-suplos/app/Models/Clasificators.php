<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificators extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    /* funcion que busca actividades registradas en la base de datos*/
     public static function buscarActividades(){

        $productos = Clasificators::select('codigo_producto', 'nombre_producto')->get()->map(function ($producto) {
            return [
                'codigo_producto' => $producto->codigo_producto,
                'nombre_producto' => $producto->nombre_producto,
            ];
        });

        return response()->json($productos);
    }
}
