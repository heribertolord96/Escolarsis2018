<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sesion;use App\Alumno;use DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class SesionController extends Controller
{
    public function index(Request $request)
    {
                if (!$request->ajax()) return redirect('/');

                $buscar = $request->buscar;
                $criterio = $request->criterio;
                
                $user = Auth::user()->id1; 
                $useral = Auth::user()->id2;
                $rolid = Auth::user()->idrol;
                if($rolid=='1'){  
                    if ($buscar==''){
                        $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
                        ->join('materias','sesions.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->join('periodos','sesions.idperiodo','=','periodos.id')
                        ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
                        'sesions.asistencia','sesions.conducta','sesions.condicion',
                        'sesions.idperiodo','periodos.nump as nperiodo',  
                        'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
                        \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                        ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')
                        ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
                        ->orderBy('sesions.fecha','asc')
                        ->paginate(10);
                    }
                    else{
                            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
                            ->join('materias','sesions.idmateria','=','materias.id')
                            ->join('cursos','materias.idcurso','=','cursos.id')
                            ->join('periodos','sesions.idperiodo','=','periodos.id')
                            ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
                            'sesions.asistencia','sesions.conducta','sesions.condicion',
                            'sesions.idperiodo','periodos.nump as nperiodo',  
                            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
                            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                            ->where($criterio, 'like', '%'. $buscar . '%')
                            ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')
                            ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
                            ->orderBy('sesions.fecha')->paginate(10);
                        }
                } else       
                if($rolid=='2'){                
                if ($buscar==''){
                    $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
                        ->join('materias','sesions.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->join('periodos','sesions.idperiodo','=','periodos.id')
                        ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
                        'sesions.asistencia','sesions.conducta','sesions.condicion',
                        'sesions.idperiodo','periodos.nump as nperiodo',  
                        'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
                        \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                        ->where('materias.idpersona','=',$user)
                    //->where('users.idrol','=',$rolid)
                    ->orderBy('cursos.nombre','asc')  
                    ->orderBy('materias.nombre')->orderBy('periodos.nump')->
                    orderBy('alumnos.nombre')->orderBy('sesions.fecha')
                    ->paginate(10);
                }
                else{
                    $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
                    ->join('materias','sesions.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->join('periodos','sesions.idperiodo','=','periodos.id')
                        ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
                        'sesions.asistencia','sesions.conducta','sesions.condicion',
                        'sesions.idperiodo','periodos.nump as nperiodo',  
                        'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
                        \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                        ->where('materias.idpersona','=',$user)
                        ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') 
                    ->orderBy('periodos.nump')->orderBy('alumnos.nombre')
                    ->orderBy('sesions.fecha')->paginate(10);
                }
                }else if($rolid=='3'){
                    if ($buscar==''){
                        $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
                    ->join('materias','sesions.idmateria','=','materias.id')
                        ->join('cursos','materias.idcurso','=','cursos.id')
                        ->join('periodos','sesions.idperiodo','=','periodos.id')
                        ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
                        'sesions.asistencia','sesions.conducta','sesions.condicion',
                        'sesions.idperiodo','periodos.nump as nperiodo',  
                        'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
                        \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                        ->where('sesions.idalumno','=',$useral)
                        //->where('users.idrol','=',$rolid)
                        ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')  
                        ->orderBy('periodos.nump')->orderBy('alumnos.nombre')->orderBy('sesions.fecha')
                        ->paginate(10);
                    }
                    else{
                        $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
                        ->join('materias','sesions.idmateria','=','materias.id')
                            ->join('cursos','materias.idcurso','=','cursos.id')
                            ->join('periodos','sesions.idperiodo','=','periodos.id')
                            ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
                            'sesions.asistencia','sesions.conducta','sesions.condicion',
                            'sesions.idperiodo','periodos.nump as nperiodo',  
                            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
                            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                            ->where('sesions.idalumno','=',$useral)
                        ->where($criterio, 'like', '%'. $buscar . '%')
                        ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')               ->orderBy('periodos.nump')->orderBy('alumnos.nombre')->orderBy('sesions.fecha')->paginate(10);
                        //->orderBy('sesions.id', 'desc')->paginate(10);
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
   
    public function listarSesion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        $user = Auth::user()->id1; 
        $rolid = Auth::user()->idrol;        
         if($rolid=='2'){
        
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
            ->join('materias','sesions.idmateria','=','materias.id')
            //->join('cursos','alumnos.idcurso','=','cursos.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->join('periodos','sesions.idperiodo','=','periodos.id')
            ->join('users','users.idrol','=','users.id')
            ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
            'sesions.asistencia','sesions.conducta','sesions.condicion',
            'sesions.idperiodo','periodos.nump as nperiodo',
            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',  
             \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
              ->where('materias.idpersona','=',$user)
              //->where('users.idrol','=',$rolid)
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')               ->orderBy('periodos.nump')->orderBy('alumnos.nombre')->orderBy('sesions.fecha')->paginate(10);
        }
        else{
            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
            ->join('materias','sesions.idmateria','=','materias.id')
            //->join('cursos','alumnos.idcurso','=','cursos.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->join('periodos','sesions.idperiodo','=','periodos.id')
            ->select('sesions.id','sesions.idalumno','sesions.fecha',
            'sesions.idperiodo','periodos.nump as nperiodo',             'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',  
            'sesions.idalumno','sesions.calificacion','sesions.asistencia','sesions.conducta','sesions.condicion',
            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,'',alumnos.nombre) AS nombre_alumno"))
            ->where('materias.idpersona','=',$user)
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('sesions.id', 'desc')->paginate(10);
        }
        }else if($rolid=='1'){
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
            ->join('materias','sesions.idmateria','=','materias.id')
            //->join('cursos','alumnos.idcurso','=','cursos.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->join('periodos','sesions.idperiodo','=','periodos.id')
            ->join('users','users.idrol','=','users.id')
            ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
            'sesions.asistencia','sesions.conducta','sesions.condicion',
            'sesions.idperiodo','periodos.nump as nperiodo',  
            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
             \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
              //->where('materias.idpersona','=',$user)
              //->where('users.idrol','=',$rolid)
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')               ->orderBy('periodos.nump')->orderBy('alumnos.nombre')->orderBy('sesions.fecha')->paginate(10);
        }
        else{
            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
            ->join('materias','sesions.idmateria','=','materias.id')
            //->join('cursos','alumnos.idcurso','=','cursos.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->join('periodos','sesions.idperiodo','=','periodos.id')
            ->select('sesions.id','sesions.idalumno','sesions.fecha',
            'sesions.idperiodo','periodos.nump as nperiodo',             'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',  
            'sesions.idalumno','sesions.calificacion','sesions.asistencia','sesions.conducta','sesions.condicion',
            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,'',alumnos.nombre) AS nombre_alumno"))
           // ->where('materias.idpersona','=',$user)
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('sesions.id', 'desc')->paginate(10);
        }
    } else if($rolid=='3')
    {
        if ($buscar==''){
            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
            ->join('materias','sesions.idmateria','=','materias.id')
            //->join('cursos','alumnos.idcurso','=','cursos.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->join('periodos','sesions.idperiodo','=','periodos.id')
            ->join('users','users.idrol','=','users.id')
            ->select('sesions.id','sesions.idalumno','sesions.fecha','sesions.idalumno','sesions.calificacion',
            'sesions.asistencia','sesions.conducta','sesions.condicion',
            'sesions.idperiodo','periodos.nump as nperiodo',
            'materia_s.nombre as nombre_materia','cursos.nombre as nombre_curso',  
             \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
              ->where('sesions.idalumno','=',$user)
              //->where('users.idrol','=',$rolid)
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre')               
             ->orderBy('periodos.nump')->orderBy('alumnos.nombre')->orderBy('sesions.fecha')
             ->orderBy('cursos.nombre','asc')  ->orderBy('materias.nombre') 
             ->orderBy('periodos.nump')->orderBy('alumnos.nombre')->orderBy('sesions.fecha')
             ->paginate(10);
        }
        else{
            $sesions = Sesion::join('alumnos','sesions.idalumno','=','alumnos.id')
            ->join('materias','sesions.idmateria','=','materias.id')
            //->join('cursos','alumnos.idcurso','=','cursos.id')
            ->join('cursos','materias.idcurso','=','cursos.id')
            ->join('periodos','sesions.idperiodo','=','periodos.id')
            ->select('sesions.id','sesions.idalumno','sesions.fecha',
            'sesions.idperiodo','periodos.nump as nperiodo',             'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',  
            'sesions.idalumno','sesions.calificacion','sesions.asistencia','sesions.conducta','sesions.condicion',
            'materias.nombre as nombre_materia','cursos.nombre as nombre_curso',
            \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,'',alumnos.nombre) AS nombre_alumno"))
            ->where('sesions.idalumno','=',$user)
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('sesions.id', 'desc')->paginate(10);
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
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');        
        $sesion = new Sesion();
        $sesion->idcurso =     $request->idcurso;
        $sesion->idmateria =   $request->idmateria;
        $sesion->idalumno =    $request->idalumno;
        $sesion->idperiodo =   $request->idperiodo;
        $sesion->fecha =       $request->fecha;
        $sesion->calificacion = $request->calificacion;
        $sesion->asistencia =  $request->asistencia;
        $sesion->conducta =    $request->conducta;
        $sesion->condicion = '1';
        $sesion->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sesion = Sesion::findOrFail($request->id);
        $sesion->idmateria = $request->idmateria;
        $sesion->idcurso = $request->idcurso;
        $sesion->idalumno = $request->idalumno;
        $sesion->idperiodo = $request->idperiodo;
        $sesion->fecha = $request->fecha;
        $sesion->calificacion = $request->calificacion;
        $sesion->asistencia = $request->asistencia;
        $sesion->conducta = $request->conducta;
        $sesion->condicion = '1';
        $sesion->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $sesion = Sesion::findOrFail($request->id);
        $sesion->delete();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sesion = Sesion::findOrFail($request->id);
        $sesion->condicion = '0';
        $sesion->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sesion = Sesion::findOrFail($request->id);
        $sesion->condicion = '1';
        $sesion->save();
    }
}
