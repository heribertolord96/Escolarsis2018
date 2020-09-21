<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodo;
use App\Materia;use App\Curso;
use App\Persona;use App\Matricula;
use Illuminate\Support\Facades\Auth;
class PeriodoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $user = Auth::user()->id1; 
                $useral = Auth::user()->id2;
                $rolid = Auth::user()->idrol; 
                if($rolid==1){
                    if ($buscar==''){
                        $periodos = Periodo::join('materias','periodos.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->select('periodos.id','periodos.idmateria','materias.idcurso','periodos.nump','materias.nombre as nombre_materia',
                        'cursos.nombre as nombre_curso','periodos.condicion')
                        ->orderBy('cursos.nombre', 'asc')
                        ->orderBy('materias.nombre', 'asc')
                        ->orderBy('periodos.nump', 'asc')
                        ->paginate(10);
                    }
                    else{
                        $periodos = Periodo::join('materias','periodos.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->select('periodos.id','periodos.idmateria','materias.idcurso','periodos.nump','materias.nombre as nombre_materia',
                        'cursos.nombre as nombre_curso','periodos.condicion')
                         ->where($criterio, 'like', '%'. $buscar . '%')
                         ->orderBy('cursos.nombre', 'asc') 
                         ->orderBy('materias.nombre', 'asc')
                         ->orderBy('periodos.nump', 'asc')
                         ->paginate(10);
                    }
                }else if($rolid==2){
                    if ($buscar==''){
                        $periodos = Periodo::join('materias','periodos.idmateria','=','materias.id')
                        ->join('personas','materias.idpersona','=','personas.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->select('periodos.id','periodos.idmateria','periodos.nump','materias.nombre as nombre_materia',
                        'materias.idcurso','cursos.nombre as nombre_curso','periodos.condicion')
                        ->where('materias.idpersona','=',$user)
                        ->orderBy('cursos.nombre', 'asc')                         ->orderBy('materias.nombre', 'asc')                         ->orderBy('periodos.nump', 'asc')
                        ->paginate(10);
                    }
                    else{
                        $periodos = Periodo::join('materias','periodos.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->select('periodos.id','periodos.idmateria','periodos.nump','materias.nombre as nombre_materia',
                        'materias.idcurso','cursos.nombre as nombre_curso','periodos.condicion')
                        ->where('materias.idpersona','=',$user) 
                        ->where($criterio, 'like', '%'. $buscar . '%')
                        ->orderBy('cursos.nombre', 'asc')                         ->orderBy('materias.nombre', 'asc')                         ->orderBy('periodos.nump', 'asc')
                        ->paginate(10);
                    }
                }  else if($rolid==3){
                    if ($buscar==''){
                        $periodos = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')                    
                        ->join('materias','materias.idcurso','=','cursos.id')
                        ->join('grupos','matriculas.idgrupo','=','grupos.id')
                        ->join('alumnos','alumnos.idgrupo','=','matriculas.idgrupo')
                        ->join('periodos','periodos.idmateria','=','materias.id')
                        ->select('periodos.id','periodos.idmateria','periodos.nump',
                        'materias.nombre as nombre_materia',
                        'materias.idcurso','cursos.nombre as nombre_curso','periodos.condicion')
                        ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')   
                        ->where('alumnos.id','=',$useral)
                        ->orderBy('cursos.nombre', 'asc')                         ->orderBy('materias.nombre', 'asc')                         ->orderBy('periodos.nump', 'asc')
                        ->paginate(10);
                    }
                    else{
                        $periodos = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')                    
                        ->join('materias','materias.idcurso','=','cursos.id')
                        ->join('grupos','matriculas.idgrupo','=','grupos.id')
                        ->join('alumnos','alumnos.idgrupo','=','matriculas.idgrupo')
                        ->join('periodos','periodos.idmateria','=','materias.id')
                        ->select('periodos.id','periodos.idmateria','periodos.nump',
                        'materias.nombre as nombre_materia',
                        'materias.idcurso','cursos.nombre as nombre_curso','periodos.condicion')
                        ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')   
                        ->where('alumnos.id','=',$useral) 
                        ->where($criterio, 'like', '%'. $buscar . '%')
                        ->orderBy('cursos.nombre', 'asc')                         ->orderBy('materias.nombre', 'asc')                         ->orderBy('periodos.nump', 'asc')
                        ->paginate(10);
                    }
                }      
        

        return [
            'pagination' => [
                'total'        => $periodos->total(),
                'current_page' => $periodos->currentPage(),
                'per_page'     => $periodos->perPage(),
                'last_page'    => $periodos->lastPage(),
                'from'         => $periodos->firstItem(),
                'to'           => $periodos->lastItem(),
            ],
            'periodos' => $periodos
        ];
    }
    public function selectPeriodo(Request $request){
        if (!$request->ajax()) return redirect('/');  
            $periodos =Periodo::where('condicion','=','1')
        ->select('id','nump')
        ->orderBy('id', 'asc')->get();
        return ['periodos' => $periodos];
    }
    

    public function listarPeriodo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $periodos = Periodo::join('materias','periodos.idmateria','=','materias.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->select('periodos.id','periodos.idmateria','periodos.nump','materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
            'periodos.condicion')
            ->orderBy('periodos.id', 'asc')->paginate(10);
        }
        else{
            $periodos = Periodo::join('materias','periodos.idmateria','=','materias.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->select('periodos.id','periodos.idmateria','periodos.nump','materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
            'periodos.condicion')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('periodos.id', 'asc')->paginate(10);
        }
        

        return ['periodos' => $periodos];
    }

    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $periodo = new Periodo();
        $periodo->idmateria = $request->idmateria;
        $periodo->nump = $request->nump;
        
       //
        $periodo->condicion = '1';
        $periodo->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $periodo = Periodo::findOrFail($request->id);
        $periodo->idmateria = $request->idmateria;
        $periodo->nump = $request->nump;
       //
        $periodo->condicion = '1';
        $periodo->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $periodo = Periodo::findOrFail($request->id);
        $periodo->condicion = '0';
        $periodo->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $periodo = Periodo::findOrFail($request->id);
        $periodo->delete('cascade');
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $periodo = Periodo::findOrFail($request->id);
        $periodo->condicion = '1';
        $periodo->save();
    }

}

