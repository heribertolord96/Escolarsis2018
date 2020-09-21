<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use Illuminate\Http\JsonResponse;
use App\Materia;
use App\Periodo;
use App\Persona;
use App\Alumno;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ChainedController extends Controller
{
    public function curso():JsonResponse{
        return response()->json(Curso::orderBy('nombre', 'ASC')->get());
    }
    public function materia():JsonResponse
    {
        $userid = Auth::user()->id1; 
        $rolid = Auth::user()->idrol;     
            if($rolid==1){               
                $materias = Materia::whereidcurso(request('curso'))
                ->select('materias.id','materias.nombre as nombre')
                ->orderBy('materias.nombre', 'asc')->get();
        return response()->json($materias);
            }else{
                $materias = Materia::whereidcurso(request('curso'))
                ->select('materias.id','materias.nombre as nombre')
                ->where('materias.idpersona','=',$userid)
                ->orderBy('materias.nombre', 'asc')->get();
                return response()->json($materias);
            }
        
    }
    public function periodo():JsonResponse{       
            $periodos = Periodo::whereidmateria(request('materia'))
                ->orderBy('nump', 'ASC')
                ->get();
            return response()->json($periodos);
    
    }
    public function alumno():JsonResponse{
        $alumnos = Alumno::whereidcurso(request('curso'))
        ->select('alumnos.id','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
        ->crossjoin('matriculas')
            ->join('grupos','matriculas.idgrupo','=','grupos.id')
            ->join('cursos','matriculas.idcurso','=','cursos.id')
            ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')
            ->where('alumnos.condicion','=','1')
        ->orderBy('apaterno', 'asc')->get();
        return response()->json($alumnos);

    }

}
