<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesion;use App\Categoria;
use App\Persona;use App\Alumno;
use App\User;
use Illuminate\Support\Facades\Auth;
class PromcursoController extends Controller
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
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')     
                ->paginate(20);         
        }
        else{
            
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                ->join('materias','materias.id','=','sesions.idmateria')
                ->join('cursos','cursos.id','=','materias.idcurso')        
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')                   
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')  
            ->paginate(20);
        }
    }else if($rolid==2)
    {
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')              
                ->where('materias.idpersona','=',$user)
                ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')     
            ->paginate(20); 
        }
        else{            
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('materias.idpersona','=',$user)
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')     
            ->paginate(20); 
        }
    }else if($rolid==3){
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                ->join('materias','materias.id','=','sesions.idmateria')
                ->join('cursos','cursos.id','=','materias.idcurso')        
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                ->where('sesions.idalumno','=',$useral)  
                ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')
                ->paginate(20); 
        }
        else{            
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('sesions.idalumno','=',$useral) 
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')
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
        $useral = Auth::user()->id2; 
        $rolid = Auth::user()->idrol; 
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
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                ->groupBy('alumnos.id','cursos.id','cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')                 
                ->get();
                $pdf =\PDF::loadView('pdf.promcursospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
                return $pdf->download('promcursos.pdf');
            }
            else{
                $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                ->join('materias','materias.id','=','sesions.idmateria')
                ->join('cursos','cursos.id','=','materias.idcurso')        
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                ->groupBy('alumnos.id','cursos.id','cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('alumnos.apaterno','asc')                 
                ->get();
                $pdf =\PDF::loadView('pdf.promcursospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
                return $pdf->download('promcursos.pdf');
        }
    }
        else if($rolid==2){
            if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('materias.idpersona','=',$user)
            ->groupBy('alumnos.id','cursos.id','cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')                 
            ->get();
            $pdf =\PDF::loadView('pdf.promcursospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
                return $pdf->download('promcursos.pdf');
        }else{
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->where('materias.idpersona','=',$user)
            ->groupBy('alumnos.id','cursos.id','cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')                 
            ->get();
            $pdf =\PDF::loadView('pdf.promcursospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
                return $pdf->download('promcursos.pdf');
        }
    }
        else if($rolid==3){
            if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('alumnos.id','cursos.id','cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')                 
            ->get();
            $pdf =\PDF::loadView('pdf.promcursospdf',['sesions'=>$sesions,'printman'=>$printman,'userrol'=>$userrol]);
                return $pdf->download('promcursos.pdf');
        }
        else{
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('alumnos.id','cursos.id','cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')                 
            ->get();
            $pdf =\PDF::loadView('pdf.promcursospdf',['sesions'=>$sesions,'printman'=>$printman]);
                return $pdf->download('promcursos.pdf');
        }
    }
    }
    
    public function listarPromcurso(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($rolid==1){
                if ($buscar==''){
                    $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                    ->join('materias','materias.id','=','sesions.idmateria')
                    ->join('cursos','cursos.id','=','materias.idcurso')        
                    ->select('cursos.nombre as cursonombre',
                    \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                    ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                    ->selectRaw('SUM(asistencia) as t_asistencias')           
                    ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                    ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                    ->orderBy('alumnos.apaterno','asc')     
                    ->paginate(20);          
            }
            else{
                
                $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                ->join('materias','materias.id','=','sesions.idmateria')
                ->join('cursos','cursos.id','=','materias.idcurso')        
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                   
             ->where($criterio, 'like', '%'. $buscar . '%')
             ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')  
            ->paginate(20);
            }
        }else if($rolid==2){
            if ($buscar==''){
                $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')              
                ->where('materias.idpersona','=',$user)
                ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')     
            ->paginate(20); 
            }
            else{
                
                $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
                ->join('materias','materias.id','=','sesions.idmateria')
                ->join('cursos','cursos.id','=','materias.idcurso')        
                ->select('cursos.nombre as cursonombre',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
                ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
                ->selectRaw('SUM(asistencia) as t_asistencias')           
                ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
                ->where('materias.idpersona','=',$user)
                 ->where($criterio, 'like', '%'. $buscar . '%')
                 ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
                ->orderBy('alumnos.apaterno','asc')     
                ->paginate(20); 
            }
        }else if($rolid==3){
            if ($buscar==''){
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')                 
            ->get();
        }
        else{
            $sesions = Sesion::join('alumnos','alumnos.id','=','sesions.idalumno')
            ->join('materias','materias.id','=','sesions.idmateria')
            ->join('cursos','cursos.id','=','materias.idcurso')        
            ->select('cursos.nombre as cursonombre',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as alumno_nombre"))                      
            ->selectRaw('ROUND(AVG(calificacion),2) as promedio_calif')            
            ->selectRaw('SUM(asistencia) as t_asistencias')           
            ->selectRaw('ROUND(AVG(conducta),2) as prom_conducta')
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->where('sesions.idalumno','=',$useral)
            ->groupBy('cursos.nombre','alumnos.nombre','alumnos.apaterno','alumnos.amaterno')
            ->orderBy('alumnos.apaterno','asc')                 
            ->get();
        }
    }

    } 
}
