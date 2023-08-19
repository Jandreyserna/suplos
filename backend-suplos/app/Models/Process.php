<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object',
        'description',
        'money',
        'budget',
        'activity',
        'init_date',
        'init_hour',
        'finish_date',
        'finish_hour',
        'state',
    ];

    public static function crearEvento($datos_evento){

        Process::create([
            'object' => $datos_evento->object,
            'description' => $datos_evento->description,
            'money' => $datos_evento->money,
            'budget' => $datos_evento->budget,
            'activity' => $datos_evento->activity,
            'init_date' => $datos_evento->init_date,
            'init_hour' => $datos_evento->init_hour,
            'finish_date' => $datos_evento->finish_date,
            'finish_hour' => $datos_evento->finish_hour,
            'state' => $datos_evento->state,
        ]);

        return true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public static function buscarProcesos(Request $request){
        /* logica en el controller */
    }
}
