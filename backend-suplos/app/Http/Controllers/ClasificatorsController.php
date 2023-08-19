<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificators;

class ClasificatorsController extends Controller
{
    /**
     * Funcion que busca un Evento/proceso del sistema
     *
     * @param  mixed $request datos del evento a Buscar
     * @return void respuesta datos encontrados
     */
    public function buscarActividades(Request $request)
    {

        $respuesta = Clasificators::buscarActividades($request);

        return $respuesta;

        
    }
}
