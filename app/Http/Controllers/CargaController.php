<?php

namespace App\Http\Controllers;
use App\Alumno;use App\User;
use Illuminate\Support\Facades\Auth;
use App\Grupo;
use App\Matricula;
use Illuminate\Http\Request;

class CargaController extends Controller
{
    public function selectMatricula(Request $request){
        if (!$request->ajax()) return redirect('/');
        $cargas = Matricula::select('id','idcurso','idgrupo')
        ->orderBy('idgrupo', 'asc')->get();
        return ['matriculas' => $cargas];
    }
    public function index(Request $request)
    {

        $user = Auth::user()->id1; 
        $user2 = Auth::user()->id2; 
        $rolid = Auth::user()->idrol;  
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($rolid==1){
        if ($buscar==''){
            $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')
            ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            ->paginate(10);
           
        }
        else{
            //$cargas = Matricula::select('matriculas.id','matriculas.idcurso','matriculas.idgrupo')
            $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            ->paginate(10);
        }
        }else if($rolid==2){
            if ($buscar==''){
                $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->join('materias','materias.idcurso','=','cursos.id')
            ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')
            ->where('materias.idpersona','=',$user)
                ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            ->paginate(10);
            
            }
            else{
                $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->join('materias','materias.idcurso','=','cursos.id')
            ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')
            ->where('materias.idpersona','=',$user)
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            ->paginate(10);
            }
        }else{
            if ($buscar==''){
                $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
                ->join('grupos','matriculas.idgrupo','=','grupos.id')
                ->join('alumnos','alumnos.idgrupo','=','grupos.id')
                ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')                       
                ->where('alumnos.id','=',$user2) 
                ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            ->paginate(10);            
            }
            else{
                $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->join('alumnos','alumnos.idgrupo','=','grupos.id')
            ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')            
                ->where('alumnos.id','=',$user2)           
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('grupos.nombre', 'asc')
            ->orderBy('cursos.nombre', 'asc')
            ->paginate(10);
            }
        }      
    
        return [
            'pagination' => [
                'total'        => $cargas->total(),
                'current_page' => $cargas->currentPage(),
                'per_page'     => $cargas->perPage(),
                'last_page'    => $cargas->lastPage(),
                'from'         => $cargas->firstItem(),
                'to'           => $cargas->lastItem(),
            ],
            'cargas' => $cargas
        ];
    }    
public function listarCarga(Request $request)
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
                $cargas = Matricula::join('cursos','matriculas.idcurso','=','cursos.id')
                ->join('grupos','matriculas.idgrupo','=','grupos.id')
                ->select('matriculas.id','cursos.nombre as nombre_curso','grupos.nombre as nombre_grupo')
                ->orderBy('grupos.nombre', 'asc')
                ->orderBy('cursos.nombre', 'asc')
                ->paginate(10);  
            }
        else{
            $cargas = Matricula::join('alumnos','users.id2','=','alumnos.id')
            ->join('roles','users.idrol','=','roles.id')
            ->join('cursos','alumnos.idcurso','=','cursos.id')
            ->select('matriculas.id','alumnos.id','alumnos.idcurso','alumnos.nombre','cursos.nombre as nombre_curso',
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
    
}
