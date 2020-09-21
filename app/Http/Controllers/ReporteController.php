<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reporte;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
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
                    $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                    ->select('reportes.id','reportes.idalumno','reportes.nombre',
                    'reportes.fecha','reportes.descripcion','reportes.condicion',
                    \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                    ->orderBy('reportes.fecha', 'asc')
                    ->paginate(10);
                    }
                else{
                    $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                    ->select('reportes.id','reportes.idalumno','reportes.nombre',
                    'reportes.fecha','reportes.descripcion','reportes.condicion',
                    \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))     
                    ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('reportes.fecha', 'asc')
                    ->paginate(10);
                     }
            }else if($rolid==2){
                if ($buscar==''){
                    $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                    ->select('reportes.id','reportes.idalumno','reportes.nombre',
                    'reportes.fecha','reportes.descripcion','reportes.condicion',
                    \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                    ->where('reportes.autor','=',$user)
                    ->orderBy('reportes.fecha', 'asc')
                    ->paginate(10);
                }
                else{
                    $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                    ->join('personas','reportes.idpersona','=','personas.id')
                    ->select('reportes.id','reportes.idcurso','reportes.nombre',
                    'cursos.nombre as nombre_curso','reportes.descripcion','reportes.idpersona',
                    'personas.nombre as nombre_persona','reportes.condicion')
                    ->where('reportes.autor','=',$user)
                    ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('reportes.fecha', 'asc')
                    ->paginate(10);
                }
            }
            else if($rolid==3){
                if ($buscar==''){
                    $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                    ->select('reportes.id','reportes.idalumno','reportes.nombre',
                    'reportes.fecha','reportes.descripcion','reportes.condicion',
                    \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                      ->where('reportes.idalumno','=',$useral)
                      ->orderBy('reportes.fecha', 'asc')
                      ->paginate(10);
                }
                else{
                    $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                    ->select('reportes.id','reportes.idalumno','reportes.nombre',
                    'reportes.fecha','reportes.descripcion','reportes.condicion',
                    \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                      ->where('alumnos.id','=',$useral)
                    ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('reportes.fecha', 'asc')
                    ->paginate(10);
                }
            }
                

                return [
                    'pagination' => [
                        'total'        => $reportes->total(),
                        'current_page' => $reportes->currentPage(),
                        'per_page'     => $reportes->perPage(),
                        'last_page'    => $reportes->lastPage(),
                        'from'         => $reportes->firstItem(),
                        'to'           => $reportes->lastItem(),
                    ],
                    'reportes' => $reportes
                ];
    }
    public function listarReporte(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if($rolid==1){
            if ($buscar==''){
                $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                ->select('reportes.id','reportes.idalumno','reportes.nombre',
                'reportes.fecha','reportes.descripcion','reportes.condicion',
                'alumnos.id',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))
                ->orderBy('reportes.fecha', 'asc')
                ->paginate(10);
            }
            else{
                $reportes = Reporte::join('alumnos','reportes.idalumno','=','alumnos.id')
                ->select('reportes.id','reportes.idalumno','reportes.nombre',
                'reportes.fecha','reportes.descripcion','reportes.condicion',
                'alumnos.id',
                \DB::raw("CONCAT(alumnos.apaterno,' ',alumnos.amaterno,' ',alumnos.nombre) as nombre_alumno"))     
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('reportes.fecha', 'asc')
                ->paginate(10);
            }
        }
        else if($rolid==2){
            if ($buscar==''){
                $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
                //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
                //->where('horarios.idpersona','=',$user)
                ->orderBy('horarios.id', 'desc')->paginate(10);
            }
            else{
                $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
                //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
                //->where('horarios.idpersona','=',$user) 
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('horarios.id', 'desc')->paginate(10);
            }
        }
        

        return ['horarios' => $horarios];
    }
    public function store(Request $request)
    {
        $user = Auth::user()->id1;
        if (!$request->ajax()) return redirect('/');        
        $reporte = new Reporte();
        $reporte->idalumno =     $request->idalumno;
        $reporte->nombre =     $request->nombre;//asunto
        $reporte->autor =   $user;
        $reporte->fecha =       $request->fecha;
        $reporte->descripcion = $request->descripcion;
        $reporte->condicion = '1';
        $reporte->save();
    }
    public function update(Request $request)
    {   //$user = Auth::user()->id1;
        if (!$request->ajax()) return redirect('/');
        $reporte = Reporte::findOrFail($request->id);
        $reporte->idalumno =     $request->idalumno;
        //$reporte->autor =   $user;
        $reporte->fecha =       $request->fecha;
        $reporte->descripcion = $request->descripcion;
        $reporte->condicion = '1';
        $reporte->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $reporte = Reporte::findOrFail($request->id);
        $reporte->delete();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $reporte = Reporte::findOrFail($request->id);
        $reporte->condicion = '0';
        $reporte->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $reporte = Reporte::findOrFail($request->id);
        $reporte->condicion = '1';
        $reporte->save();
    }
}
