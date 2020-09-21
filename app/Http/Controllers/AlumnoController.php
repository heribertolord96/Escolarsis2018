<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Alumno;use App\User;
use App\Grupo;

class AlumnoController extends Controller
{
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
                $alumnos = User::join('alumnos','users.id2','=','alumnos.id')
                //->join('roles','users.idrol','=','roles.id')
                ->join('grupos','alumnos.idgrupo','=','grupos.id')
                ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
                'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday','alumnos.num_ide',
                'alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo','alumnos.edad','users.usuario','alumnos.condicion')           
                //->where('users.idrol','=' ,'3')            
                ->orderBy('alumnos.apaterno', 'asc')->paginate(10);
            
            }
            else{
                $alumnos = User::join('alumnos','users.id2','=','alumnos.id')
                //->join('roles','users.idrol','=','roles.id')
                ->join('grupos','alumnos.idgrupo','=','grupos.id')
                ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
                'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday',
                'alumnos.num_ide','alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo',
                'alumnos.edad','users.usuario','alumnos.condicion')
                //->where('users.idrol','=' ,'3')
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('alumnos.apaterno', 'asc')->paginate(10);
            }
        }else if($rolid==2){
            if ($buscar==''){
                $alumnos = User::join('alumnos','grupos.id','=','alumnos.idgrupo')
                //->join('roles','users.idrol','=','roles.id')
                ->crossjoin('matriculas')
                ->join('grupos','matriculas.idgrupo','=','grupos.id')
                ->join('cursos','matriculas.idcurso','=','cursos.id')
                ->join('materias','materias.idcurso', '=', 'cursos.id')
                ->join('personas','materias.idpersona','=','personas.id')
                ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
                'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday','alumnos.num_ide',
                'alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo','alumnos.edad','users.usuario','alumnos.condicion')           
                //->where('users.idrol','=' ,'3')
                ->where('materias.idpersona','=',$user)
                ->orderBy('alumnos.apaterno', 'asc')->paginate(10);
            
            }
            else{
                $alumnos = User::join('alumnos','users.id2','=','alumnos.id')
                ->join('roles','users.idrol','=','roles.id')
                ->join('grupos','alumnos.idgrupo','=','grupos.id')
                ->join('materias','grupos.id', '=', 'materias.idgrupo')
                ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
                'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday',
                'alumnos.num_ide','alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo',
                'materias.nombre as nombre_materia','grupos.nombre as nombre_grupo',
                'alumnos.edad','users.usuario','alumnos.condicion')
                //->where('users.idrol','=' ,'3')             
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('alumnos.apaterno', 'asc')->paginate(10);
            }
        }else if($rolid==3){
            if ($buscar==''){
                $alumnos = User::join('alumnos','users.id2','=','alumnos.id')
                //->join('roles','users.idrol','=','roles.id')
                ->join('grupos','alumnos.idgrupo','=','grupos.id')
                ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
                'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday','alumnos.num_ide',
                'alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo','alumnos.edad','users.usuario','alumnos.condicion')           
            
                ->where('alumnos.id','=',$user2) 
                ->orderBy('alumnos.apaterno', 'asc')->paginate(10);
            
            }
            else{$alumnos = User::join('alumnos','users.id2','=','alumnos.id')
                //->join('roles','users.idrol','=','roles.id')
                ->join('grupos','alumnos.idgrupo','=','grupos.id')
                ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
                'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday','alumnos.num_ide',
                'alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo','alumnos.edad','users.usuario','alumnos.condicion')           
            
                ->where('alumnos.id','=',$user2)           
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('alumnos.apaterno', 'asc')->paginate(10);
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

    public function selectAlumno(Request $request){
        if (!$request->ajax()) return redirect('/');
        $alumnos = Alumno::where('condicion','=','1')
        ->select('id','nombre','apaterno','amaterno')->orderBy('apaterno', 'asc')
        ->get();
        return ['alumnos' => $alumnos];
    }
    public function selectGrupo(Request $request){
        if (!$request->ajax()) return redirect('/');
        $grupos = Grupo::where('condicion','=','1')
        ->select('id','nombre')->orderBy('nombre', 'asc')->get();
        return ['grupos' => $grupos];
    }

    public function destroy(Request $request){
        $id=$request->id;
        if (!$request->ajax()) return redirect('/');
        $alumno = Alumno::findOrFail($request->id);        
        $alumno->delete('cascade');   
        $user = User::findOrFail($id);
        $user->delete('cascade');   
    }

    public function listarAlumno(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        //falta alumnos.condicion
        if ($buscar==''){
            $alumnos = User::join('alumnos','users.id2','=','alumnos.id')
            ->join('roles','users.idrol','=','roles.id')
            ->join('grupos','alumnos.idgrupo','=','grupos.id')
            ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
            'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday','alumnos.num_ide',
            'alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo','alumnos.edad','users.usuario','alumnos.condicion')
            //->where('users.idrol','=' ,'3')
            ->orderBy('alumnos.id', 'desc')->paginate(10);
        }
        else{
            $alumnos = User::join('alumnos','users.id2','=','alumnos.id')
            ->join('roles','users.idrol','=','roles.id')
            ->join('grupos','alumnos.idgrupo','=','grupos.id')
            ->select('alumnos.id','alumnos.idgrupo','alumnos.nombre','grupos.nombre as nombre_grupo',
            'alumnos.apaterno','alumnos.amaterno','alumnos.num_alumno','alumnos.birthday','alumnos.num_ide',
            'alumnos.direccion','alumnos.telefono','alumnos.email','alumnos.sexo','alumnos.edad','users.usuario','alumnos.condicion')
            ->where('alumnos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('alumnos.id', 'desc')->paginate(10);
        }
        

        return ['alumnos' => $alumnos];
    }
    
         public function store(Request $request)
    {
       
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
        $alumno = new Alumno();
        $alumno->id = ($alumno->id*3);
        $alumno->idgrupo = $request->idgrupo;        
        $alumno->nombre = $request->nombre;
        $alumno->apaterno = $request->apaterno;
        $alumno->amaterno = $request->amaterno;
        $alumno->num_alumno = $request->num_alumno;
        $alumno->birthday = $request->birthday;
        $alumno->num_ide = $request->num_ide;
        $alumno->direccion = $request->direccion;
        $alumno->telefono = $request->telefono;
        $alumno->email = $request->email;
        $alumno->sexo = $request->sexo;
        $alumno->edad = $request->edad;       //
        $alumno->condicion = '1';
        $alumno->save();        
        $user = new User();
        $user->id = $alumno->id;
            $user->id2 = $alumno->id;
            $user->idrol = $request->idrol;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';            
            $user->save();
        DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $id2 = User::find($request->id2);
            $alumno=Alumno::find($request->id);
            $user = User::find($request->id);           
        
        $alumno->idgrupo = $request->idgrupo;
        $alumno->idgrupo = $request->idgrupo;
        $alumno->nombre = $request->nombre;
        $alumno->apaterno = $request->apaterno;
        $alumno->amaterno = $request->amaterno;
        $alumno->num_alumno = $request->num_alumno;
        $alumno->birthday = $request->birthday;
        $alumno->num_ide = $request->num_ide;
        $alumno->direccion = $request->direccion;
        $alumno->telefono = $request->telefono;
        $alumno->email = $request->email;
        $alumno->sexo = $request->sexo;
        $alumno->edad = $request->edad;
        $alumno->condicion = '1';
        $alumno->save();
        
       //
                
       $user->usuario = $request->usuario;
            $user->id2 = $alumno->id;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();

            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '0';
        $alumno->save();
    }
    
    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $alumno = Alumno::findOrFail($request->id);
        $alumno->condicion = '1';
        $alumno->save();
    }
}
