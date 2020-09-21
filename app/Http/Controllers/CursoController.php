<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use Illuminate\Http\JsonResponse;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $cursos = Curso::
            select('cursos.id','cursos.nombre','cursos.descripcion','cursos.condicion')
            ->orderBy('cursos.id', 'desc')->paginate(10);
        }
        else{
            $cursos = Curso::
            select('cursos.id','cursos.nombre','cursos.descripcion','cursos.condicion')
             ->where('cursos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cursos.id', 'desc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $cursos->total(),
                'current_page' => $cursos->currentPage(),
                'per_page'     => $cursos->perPage(),
                'last_page'    => $cursos->lastPage(),
                'from'         => $cursos->firstItem(),
                'to'           => $cursos->lastItem(),
            ],
            'cursos' => $cursos
        ];
    }
    public function selectCurso(Request $request){
        if (!$request->ajax()) return redirect('/');
        $cursos = Curso::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['cursos' => $cursos];
    }
  
    public function listarCurso(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $cursos = Curso::
            select('cursos.id','cursos.nombre','cursos.descripcion','cursos.condicion')
            ->orderBy('cursos.id', 'desc')->paginate(10);
        }
        else{
            $cursos = Curso::
            select('cursos.id','cursos.nombre','cursos.descripcion','cursos.condicion')
            ->where('cursos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cursos.id', 'desc')->paginate(10);
        }
        

        return ['cursos' => $cursos];
    }

    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $curso = new Curso();
       // $curso->idcategoria = $request->idcategoria;
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
       //
        $curso->condicion = '1';
        $curso->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $curso = Curso::findOrFail($request->id);
       // $curso->idcategoria = $request->idcategoria;       
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
       //
        $curso->condicion = '1';
        $curso->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $curso = Curso::findOrFail($request->id);
        $curso->condicion = '0';
        $curso->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $curso = Curso::findOrFail($request->id);
        $curso->delete('cascade');   
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $curso = Curso::findOrFail($request->id);
        $curso->condicion = '1';
        $curso->save();
    }

}
