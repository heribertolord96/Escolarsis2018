<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;use App\User;
use Illuminate\Support\Facades\Auth;
use App\Grupo;
use App\Matricula;


class MatriculaController extends Controller
{
    
    public function index(Request $request)
    {

        $user = Auth::user()->id1; 
        $user2 = Auth::user()->id2; 
        $rolid = Auth::user()->idrol;  
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($rolid==1){/*
            select alumnos.nombre as alumno, grupos.nombre as Grupo, cursos.nombre as curso 
            from `alumnos` join matriculas 
            join cursos on matriculas.idcurso = cursos.id 
            join grupos on matriculas.idgrupo=grupos.id 
            where alumnos.idgrupo = matriculas.idgrupo */
        if ($buscar==''){
            /**/
            $alumnos = Alumno::crossjoin('matriculas')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->join('cursos','matriculas.idcurso','=','cursos.id')
            ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
            )
            ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')
            ->orderBy('nombre_alumno', 'asc')
            ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')            
            ->groupBy('alumnos.apaterno','alumnos.amaterno',
            'alumnos.nombre','cursos.nombre','grupos.nombre')
            ->paginate(10);
           
        }
        else{
            //$matriculas = Matricula::select('matriculas.id','matriculas.idcurso','matriculas.idgrupo')
            $alumnos = Alumno::crossjoin('matriculas')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->join('cursos','matriculas.idcurso','=','cursos.id')
            ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
            )
            ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('nombre_alumno', 'asc')
            ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')            
            ->groupBy('alumnos.apaterno','alumnos.amaterno',
            'alumnos.nombre','cursos.nombre','grupos.nombre')
            ->paginate(10);
        }
        }else if($rolid==2){
            if ($buscar==''){
                $alumnos = Alumno::join('grupos','alumnos.idgrupo','=','grupos.id')
                ->join('matriculas','matriculas.idgrupo','=','grupos.id')
                ->join('cursos','matriculas.idcurso','=','cursos.id')                
                ->join('materias','materias.idcurso','=','cursos.id')
                ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
                )
                ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')
                ->where('materias.idpersona','=',$user)
                ->orderBy('nombre_alumno', 'asc')
            ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
                ->groupBy('alumnos.apaterno','alumnos.amaterno',
                'alumnos.nombre','cursos.nombre','grupos.nombre')
                ->paginate(10);
            
            }
            else{
                $alumnos = Alumno::join('grupos','alumnos.idgrupo','=','grupos.id')
                ->join('matriculas','matriculas.idgrupo','=','grupos.id')
                ->join('cursos','matriculas.idcurso','=','cursos.id')                
                ->join('materias','materias.idcurso','=','cursos.id')
                ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
                )
                ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')              
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->where('materias.idpersona','=',$user)
                ->where('materias.idpersona','=',$user)
                ->orderBy('nombre_alumno', 'asc')
                ->orderBy('grupos.nombre', 'asc')
                ->orderBy('cursos.nombre', 'asc')
                ->groupBy('alumnos.apaterno','alumnos.amaterno',
                'alumnos.nombre','cursos.nombre','grupos.nombre')
                ->paginate(10);
            }
        }else if($rolid==3){
            if ($buscar==''){
                $alumnos = Alumno::crossjoin('matriculas')
                ->join('grupos','matriculas.idgrupo','=','grupos.id')
                ->join('cursos','matriculas.idcurso','=','cursos.id')
                ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
                )
                ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')       
                ->where('alumnos.id','=',$user2) 
                ->orderBy('grupos.nombre', 'asc')
                ->orderBy('cursos.nombre', 'asc')                
                ->groupBy('alumnos.apaterno','alumnos.amaterno',
                'alumnos.nombre','cursos.nombre','grupos.nombre')
                ->paginate(10);
            
            }
            else{
                $alumnos = Alumno::crossjoin('matriculas')
                ->join('grupos','matriculas.idgrupo','=','grupos.id')
                ->join('cursos','matriculas.idcurso','=','cursos.id')
                ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
                )
                ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')
                ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo') 
                ->where('alumnos.id','=',$user2)           
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            
            ->groupBy('alumnos.apaterno','alumnos.amaterno',
            'alumnos.nombre','cursos.nombre','grupos.nombre')
            ->paginate(10);
            }
        }      
    
        return [
            'pagination' => [
                'total'        => $alumnos->total(),
                'current_page' => $alumnos->currentPage(),
                'per_page'     => $alumnos->perPage(),
                'last_page'    => $alumnos->lastPage(),
                'from'         => $alumnos->firstItem(),
                'to'           => $alumnos->lastItem(),
            ],
            'alumnos' => $alumnos
        ];
    }    
public function listarMatricula(Request $request)
    {
        $user = Auth::user()->id1; 
        $user2 = Auth::user()->id2; 
        $rolid = Auth::user()->idrol;  
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
            if($rolid==1){/*
            select alumnos.nombre as alumno, grupos.nombre as Grupo, cursos.nombre as curso 
            from `alumnos` join matriculas 
            join cursos on matriculas.idcurso = cursos.id 
            join grupos on matriculas.idgrupo=grupos.id 
            where alumnos.idgrupo = matriculas.idgrupo */
            if ($buscar==''){
                //$matriculas = Matricula::join('grupos','matriculas.idgrupo','=','grupos.id')
                $alumnos = Alumno::crossjoin('matriculas')
                ->select('matriculas.id','grupos.nombre as grupo_name')
                ->paginate(10);
                $alumnos = Alumno::crossjoin('matriculas')
                ->join('grupos','matriculas.idgrupo','=','grupos.id')
                ->join('cursos','matriculas.idcurso','=','cursos.id')
                ->select('cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno")
                )
                ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')
                ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
                ->paginate(10);
               
            }
        else{
            $alumnos = Matricula::join('alumnos','users.id2','=','alumnos.id')
            ->join('roles','users.idrol','=','roles.id')
            ->join('cursos','alumnos.idcurso','=','cursos.id')
            ->select('matriculas.id','alumnos.idcurso','alumnos.nombre','cursos.nombre as nombre_curso',
            'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday',
            'alumnos.num_ide','alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo',
            'alumnos.edad','users.usuario','alumnos.condicion')
            ->where('users.idrol','=' ,'3')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')->paginate(10);
        }
    }
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $matricula = Matricula::findOrFail($request->id);
        $matricula->delete('cascade');
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $matricula = new Matricula();
        $matricula->idcurso = $request->idcurso;
        $matricula->idgrupo = $request->idgrupo;
        $matricula->condicion = '1';
        $matricula->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $matricula = Matricula::findOrFail($request->id);
        $matricula->idcurso = $request->idcurso;
        $matricula->idgrupo = $request->idgrupo;
        $matricula->condicion = '1';
        $matricula->save();
    }
}
