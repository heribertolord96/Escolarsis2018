<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;use App\Categoria;

class GrupoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $grupos = Grupo::
            select('grupos.id','grupos.nombre','grupos.descripcion','grupos.condicion')
            ->orderBy('grupos.id', 'desc')->paginate(10);
        }
        else{
            $grupos = Grupo::
            select('grupos.id','grupos.nombre','grupos.descripcion','grupos.condicion')
             ->where('grupos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('grupos.id', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $grupos->total(),
                'current_page' => $grupos->currentPage(),
                'per_page'     => $grupos->perPage(),
                'last_page'    => $grupos->lastPage(),
                'from'         => $grupos->firstItem(),
                'to'           => $grupos->lastItem(),
            ],
            'grupos' => $grupos
        ];
    }

    public function listarGrupo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $grupos = Grupo::
            select('grupos.id','grupos.nombre','grupos.descripcion','grupos.condicion')
            ->orderBy('grupos.id', 'desc')->paginate(10);
        }
        else{
            $grupos = Grupo::
            select('grupos.id','grupos.nombre','grupos.descripcion','grupos.condicion')
            ->where('grupos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('grupos.id', 'desc')->paginate(10);
        }
        

        return ['grupos' => $grupos];
    }    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $grupo = new Grupo();
       // $grupo->idcategoria = $request->idcategoria;
       $escuela = Categoria::select('id')
             ->first()->id;
             $grupo->idcategoria = $escuela;     
        $grupo->nombre = $request->nombre;
        $grupo->descripcion = $request->descripcion;
       //
        $grupo->condicion = '1';
        $grupo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $grupo = Grupo::findOrFail($request->id);
       // $grupo->idcategoria = $request->idcategoria;       
        $grupo->nombre = $request->nombre;
        $grupo->descripcion = $request->descripcion;
        $grupo->condicion = '1';
        $grupo->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $grupo = Grupo::findOrFail($request->id);
        $grupo->condicion = '0';
        $grupo->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $grupo = Grupo::findOrFail($request->id);
        $grupo->delete('cascade');   
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $grupo = Grupo::findOrFail($request->id);
        $grupo->condicion = '1';
        $grupo->save();
    }
}
