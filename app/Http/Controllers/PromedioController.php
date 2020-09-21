<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesion;use App\Categoria;
use App\Persona;use App\Alumno;
use Illuminate\Support\Facades\Auth;

class PromedioController extends Controller
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
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')
            ->select('materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->paginate(20);            
        }
        else{
            
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->paginate(20);
        }
    }else if($rolid==2){
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('materias.idpersona','=',$user)
            ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->paginate(20);            
        }
        else{
            
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('materias.idpersona','=',$user)
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
             ->orderBy('alumnos.apaterno','asc')
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')            
            ->paginate(20);
        }
    }else if($rolid==3){
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->paginate(20);
            
        }
        else{            
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('sesions.idalumno','=',$useral)
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')            
            ->paginate(20);
    }
    }
           

        return [
            'pagination' => [
                'total'        => $sesions->total(),
                'current_page' => $sesions->currentPage(),
                'per_page'     => $sesions->perPage(),
                'last_page'    => $sesions->lastPage(),
                'from'         => $sesions->firstItem(),
                'to'           => $sesions->lastItem(),
            ],
            'sesions' => $sesions
        ];
    }
 
    public function listarPdf(Request $request){
        $user = Auth::user()->id1; 
        $rolid = Auth::user()->idrol; 
        $useral = Auth::user()->id2;
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $cont=Sesion::count();
        $printman = '';
        $userrol = '';
        if($rolid==3){
            $userrol = "Alumno";
        }else if($rolid==2){
            $userrol = "Maestro";
        }else if($rolid==1){
            $userrol = "Administrador";
        } 
        if($rolid==3){
            $printman = Alumno::where('id','=',$useral)
            ->select(\DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
             ->first()->nombre_alumno;
        }else{
            $printman=Persona::where('id','=',$user)
            ->first()->nombre;
        }
        if($rolid==1){
            if ($buscar==''){
        $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->groupBy('alumnos.id','periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->get();
            $pdf =\PDF::loadView('pdf.promediospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
            return $pdf->download('promedios.pdf');
        }else{
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->groupBy('alumnos.id','periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->get();
            $pdf =\PDF::loadView('pdf.promediospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
            return $pdf->download('promedios.pdf');
        }
    }
        else if($rolid==2){
            if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select('alumnos.id','materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('materias.idpersona','=',$user)
            ->groupBy('alumnos.id','periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->get();
            $pdf =\PDF::loadView('pdf.promediospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
            return $pdf->download('promedios.pdf');

        }else{
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select('alumnos.id','materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->where('materias.idpersona','=',$user)
            ->groupBy('alumnos.id','periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->get();
            $pdf =\PDF::loadView('pdf.promediospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
            return $pdf->download('promedios.pdf');
        }
    }
        else if($rolid==3){
            if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select('alumnos.id','materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('alumnos.id','periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->get();
            $pdf =\PDF::loadView('pdf.promediospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
            return $pdf->download('promedios.pdf');
        }else{
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select('alumnos.id','materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('alumnos.id','periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->get();
            $pdf =\PDF::loadView('pdf.promediospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
            return $pdf->download('promedios.pdf');
        }
        }
    } 
        public function listarPromedio(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->paginate(20);
            
        }
        else{
           
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')
            ->join('periodos','periodos.id','=','sesions.idperiodo')             
            ->select(
            'materias.nombre as materia_nombre','cursos.nombre as curso_nombre','periodos.nump as nombre_periodo',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
             ->where('sesions.'.$criterio, 'like', '%'. $buscar . '%')
             ->groupBy('periodos.nump','alumnos.nombre','materias.nombre','cursos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
            ->paginate(20);
        }
        ///////////////////////////

       
    }

 
}
