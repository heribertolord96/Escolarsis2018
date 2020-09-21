<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Sesion;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        
       $notas=DB::table('sesions as s')
       ->select(DB::raw('s.idcurso'),
       DB::raw('s.idalumno'),
       DB::Raw('AVG(calificacion) as promedio_calif') )
       ->groupBy(DB::raw('s.idcurso'),DB::raw('s.idalumno'))
       ->get();
       return ['sesions' => $notas];
    }/* $user = Auth::user()->id1; 
        $rolid = Auth::user()->idrol; 

                 
                $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                ->join('materias','materias.id','=','sesions.idmateria')
                ->join('cursos','cursos.id','=','materias.idcurso')        
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('AVG(calificacion) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('AVG(conducta) as prom_conducta')
                ->groupBy('cursos.nombre')
                ->orderBy('alumnos.apaterno','asc')     
                ->paginate(20);         
       
        
               

        return ['sesions' => $sesions]; */
}

