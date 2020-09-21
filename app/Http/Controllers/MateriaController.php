<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;use App\Curso;
use App\Persona;use App\Periodo;
use App\Alumno;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
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
                    $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                    ->join('personas','materias.idpersona','=','personas.id')
                    ->select('materias.id','materias.idcurso','materias.nombre',
                    'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
                    'personas.nombre as nombre_persona','materias.condicion')
                    ->orderBy('materias.id', 'desc')->paginate(10);
                }
                else{
                    $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                    ->join('personas','materias.idpersona','=','personas.id')
                    ->select('materias.id','materias.idcurso','materias.nombre',
                    'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
                    'personas.nombre as nombre_persona','materias.condicion')           
                    ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('materias.id', 'desc')->paginate(10);
                }
            }else if($rolid==2){
                if ($buscar==''){
                    $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                    ->join('personas','materias.idpersona','=','personas.id')
                    ->select('materias.id','materias.idcurso','materias.nombre',
                    'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
                    'personas.nombre as nombre_persona','materias.condicion')
                    ->where('materias.idpersona','=',$user)
                    ->orderBy('materias.id', 'desc')->paginate(10);
                }
                else{
                    $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                    ->join('personas','materias.idpersona','=','personas.id')
                    ->select('materias.id','materias.idcurso','materias.nombre',
                    'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
                    'personas.nombre as nombre_persona','materias.condicion')
                    ->where('materias.idpersona','=',$user) 
                    ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('materias.id', 'desc')->paginate(10);
                }
            }
            else if($rolid==3){
                if ($buscar==''){
                    $materias = Alumno::crossjoin('matriculas')
                    ->join('cursos','matriculas.idcurso','=','cursos.id')                    
                    ->join('materias','materias.idcurso','=','cursos.id')
                    ->join('grupos','matriculas.idgrupo','=','grupos.id')
                    ->join('personas','materias.idpersona','=','personas.id')
                    ->select('materias.id','materias.idcurso','materias.nombre',
                    'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
                    'personas.nombre as nombre_persona','materias.condicion')
                    ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')   
                    ->where('alumnos.id','=',$useral)
                    ->orderBy('materias.id', 'desc')->paginate(10);
                }
                else{
                    $materias = Alumno::crossjoin('matriculas')
                    ->join('cursos','matriculas.idcurso','=','cursos.id')                    
                    ->join('materias','materias.idcurso','=','cursos.id')
                    ->join('grupos','matriculas.idgrupo','=','grupos.id')
                    ->join('personas','materias.idpersona','=','personas.id')
                    ->select('materias.id','materias.idcurso','materias.nombre',
                    'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
                    'personas.nombre as nombre_persona','materias.condicion')
                    ->whereColumn('alumnos.idgrupo','=','matriculas.idgrupo')   
                    ->where('alumnos.id','=',$useral)
                    ->where($criterio, 'like', '%'. $buscar . '%')
                    ->orderBy('materias.id', 'desc')->paginate(10);
                }
            }
                

                return [
                    'pagination' => [
                        'total'        => $materias->total(),
                        'current_page' => $materias->currentPage(),
                        'per_page'     => $materias->perPage(),
                        'last_page'    => $materias->lastPage(),
                        'from'         => $materias->firstItem(),
                        'to'           => $materias->lastItem(),
                    ],
                    'materias' => $materias
                ];
    }
    public function selectMateria(Request $request){
       // $cursoselect = $_GET["cursoselect"];
        $userid = Auth::user()->id1; 
        $rolid = Auth::user()->idrol;
        //$idcurso = $request->idcurso;     
            if($rolid==1){
        if (!$request->ajax()) return redirect('/');
        //if($idcurso >= 0 ){
        $materias = Materia::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')
        //->where('materias.idcurso','=',$idcurso)
        ->get();
        return ['materias' => $materias];
            }else{
                if (!$request->ajax()) return redirect('/');        
                $materias = Materia::where('materias.condicion','=','1')
                ->join('users', 'materias.idpersona','=','users.id1')                  
                ->join('personas','users.id1','=','personas.id')             
                ->where('idrol','!=','3')
                ->where('users.id1','=',$userid)
                ->select('materias.id','materias.nombre as nombre')
                ->orderBy('materias.nombre', 'asc')->get();
                return ['materias' => $materias];
            }
        //}else{
          //  return null;
        //}
    }
    public function listarMateria(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if($rolid==1){
            if ($buscar==''){
                $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                ->join('personas','materias.idpersona','=','personas.id')
            ->select('materias.id','materias.idcurso','materias.nombre',
            'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
            'personas.nombre as nombre_persona','materias.condicion')
                ->orderBy('materias.id', 'desc')->paginate(10);
            }
            else{
                $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                ->join('personas','materias.idpersona','=','personas.id')
            ->select('materias.id','materias.idcurso','materias.nombre',
            'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
            'personas.nombre as nombre_persona','materias.condicion')
                 ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('materias.id', 'desc')->paginate(10);
            }
        }else{
            if ($buscar==''){
                $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                ->join('personas','materias.idpersona','=','personas.id')
            ->select('materias.id','materias.idcurso','materias.nombre',
            'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
            'personas.nombre as nombre_persona','materias.condicion')
                ->where('materias.idpersona','=',$user)
                ->orderBy('materias.id', 'desc')->paginate(10);
            }
            else{
                $materias = Materia::join('cursos','materias.idcurso','=','cursos.id')
                ->join('personas','materias.idpersona','=','personas.id')
            ->select('materias.id','materias.idcurso','materias.nombre',
            'cursos.nombre as nombre_curso','materias.descripcion','materias.idpersona',
            'personas.nombre as nombre_persona','materias.condicion')
                ->where('materias.idpersona','=',$user) 
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('materias.id', 'desc')->paginate(10);
            }
        }
        

        return ['materias' => $materias];
    }    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materia = new Materia();
        $materia->idcurso = $request->idcurso;
        $materia->idpersona = $request->idpersona;
        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        $materia->condicion = '1';
        $materia->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materia = Materia::findOrFail($request->id);
        $materia->idcurso = $request->idcurso;
        $materia->idpersona = $request->idpersona;
        $materia->nombre = $request->nombre;
        $materia->descripcion = $request->descripcion;
        $materia->condicion = '1';
        $materia->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materia = Materia::findOrFail($request->id);
        $materia->condicion = '0';
        $materia->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $materia = Materia::findOrFail($request->id);
        $materia->delete('cascade');
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $materia = Materia::findOrFail($request->id);
        $materia->condicion = '1';
        $materia->save();
    }

}
