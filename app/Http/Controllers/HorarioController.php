<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;
use App\Curso;
use App\Persona;use App\Periodo;
use App\Horario;
use Illuminate\Support\Facades\Auth;
class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
            //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
            ->orderBy('horarios.id', 'desc')->paginate(10);
        }
        else{
            $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
            //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')            
             ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('horarios.id', 'desc')->paginate(10);
        }
        }else if($rolid==2){
            if ($buscar==''){
                $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
                ->join('materias','materias.idcurso','=','cursos.id')
                ->select('horarios.id','horarios.nombre',
                'cursos.nombre as nombre_curso','horarios.descripcion',
                'horarios.condicion')
                ->groupBy('horarios.id','horarios.nombre',
                'cursos.nombre','horarios.descripcion',
                'horarios.condicion')
                ->where('materias.idpersona','=',$user)
                ->orderBy('cursos.nombre', 'asc')->paginate(10);
            }
            else{
                $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
                ->join('materias','materias.idcurso','=','cursos.id')
                ->select('horarios.id','horarios.nombre',
                'cursos.nombre as nombre_curso','horarios.descripcion',
                'horarios.condicion')
                ->groupBy('horarios.id','horarios.nombre',
                'cursos.nombre','horarios.descripcion',
                'horarios.condicion')
                ->where('materias.idpersona','=',$user) 
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('cursos.nombre', 'asc')->paginate(10);
            }
        }
        else if($rolid==3){
        if ($buscar==''){
            $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
            ->join ('materias','materias.idcurso','=','cursos.id')
            ->join('matriculas','materias.idcurso','=','matriculas.idcurso')
            ->join('alumnos','matriculas.idgrupo','=','alumnos.idgrupo')
            ->select('horarios.id','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
            ->groupBy('horarios.id','horarios.nombre',
            'cursos.nombre','horarios.descripcion',
            'horarios.condicion')
            ->where('alumnos.id','=',$useral)
            ->orderBy('cursos.nombre', 'asc')->paginate(10);
        }
        else{
            $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
            ->join ('materias','materias.idcurso','=','cursos.id')
            ->join('matriculas','materias.idcurso','=','matriculas.idcurso')
            ->join('alumnos','matriculas.idgrupo','=','alumnos.idgrupo')
            ->select('horarios.id','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
            ->groupBy('horarios.id','horarios.nombre',
            'cursos.nombre','horarios.descripcion',
            'horarios.condicion')
            ->where('alumnos.id','=',$useral) 
            ->where($criterio, 'like', '%'. $buscar . '%')
            ->orderBy('cursos.nombre', 'asc')->paginate(10);
        }
    }
        

        return [
            'pagination' => [
                'total'        => $horarios->total(),
                'current_page' => $horarios->currentPage(),
                'per_page'     => $horarios->perPage(),
                'last_page'    => $horarios->lastPage(),
                'from'         => $horarios->firstItem(),
                'to'           => $horarios->lastItem(),
            ],
            'horarios' => $horarios
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = new Horario();
        $horario->idcurso = $request->idcurso;
        
        $horario->nombre = $request->nombre;
        $horario->descripcion = $request->descripcion;
       //
        $horario->condicion = '1';
        $horario->save();
    }
    public function listarHorario(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if($rolid==1){
            if ($buscar==''){
                $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
                //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
                ->orderBy('horarios.id', 'desc')->paginate(10);
            }
            else{
                $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
                //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
                 ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('horarios.id', 'desc')->paginate(10);
            }
        }else if($rolid==2){
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
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->idcurso = $request->idcurso;
        
        $horario->nombre = $request->nombre;
        $horario->descripcion = $request->descripcion;
       //
        $horario->condicion = '1';
        $horario->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->condicion = '0';
        $horario->save();
    }
    public function destroy(Request $request){
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->delete('cascade');
    }
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $horario = Horario::findOrFail($request->id);
        $horario->condicion = '1';
        $horario->save();
    }
    public function listarHorariopdf(){
        $user = Auth::user()->id1; 
        $rolid = Auth::user()->idrol; 
        $cont=Horario::count();
        if($rolid==1){
            $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
            //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
            ->get();
            $pdf =\PDF::loadView('pdf.horariospdf',['horarios'=>$horarios,'cont'=>$cont]);
            return $pdf->download('horarios.pdf');
        }else{
            $horarios = Horario::join('cursos','horarios.idcurso','=','cursos.id')
            //->join('personas','horarios.idpersona','=','personas.id')
            ->select('horarios.id','horarios.idcurso','horarios.nombre',
            'cursos.nombre as nombre_curso','horarios.descripcion',
            'horarios.condicion')
             ->get();

        }
    }
}
