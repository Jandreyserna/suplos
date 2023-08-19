<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;

class ProcessController extends Controller
{
     /**
     * Funcion que crear un nuevo Evento/proceso del sistema
     *
     * @param  mixed $request datos del evento a crear
     * @return void respuesta estado creacion del evento
     */
    public function crearEvento(Request $request)
    {

        Process::crearEvento($request);

        return response('creado', 200);
    }
    /**
     * Funcion que busca un Evento/proceso del sistema
     *
     * @param  mixed $request datos del evento a buscar
     * @return void respuesta coincidencia en el evento
     */
    public function buscarProcesos(Request $request)
    {
        $object = $request->input('objetoDescripcion');
        $id = $request->input('idCerrada');
        if($request->input('estado') == 'todos'){
            $state = '';
        }else{
            $state = $request->input('estado');
        }
        
        $response = Process::when(isset($object) && !empty($object), function($query) use($object){
            $query->whereRaw("(object LIKE '%$object%' OR description LIKE '%$object%' )");
        })
        ->when(isset($id) && !empty($id), function($query) use($id){
            $query->where('id', 'LIKE', "%$id%" );
        })
        ->when(isset($state) && !empty($state), function($query) use($state){
            $query->where('state', 'LIKE', "%$state%" );
        })
        ->get();

        return response()->json($response);
    }

}
