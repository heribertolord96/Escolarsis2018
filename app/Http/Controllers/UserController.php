<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Persona;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $userid = Auth::user()->id1; 
        //$userid2 = Auth::user()->id2; 
        //$php_variable = 'string';

        
        
        $rolid = Auth::user()->idrol;   
            if($rolid==1){
                    if ($buscar==''){
                        $personas = User::join('personas','users.id1','=','personas.id')
                        ->join('roles','users.idrol','=','roles.id')
                        ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento',
                        'personas.direccion','personas.telefono',
                        'personas.email','users.usuario','users.password','users.condicion','personas.cargo',
                        'users.idrol','roles.nombre as rol')
                        ->where('users.idrol','!=','3')
                        ->orderBy('personas.id', 'desc')->paginate(10);         
                        
                    }
                    else{
                        $personas = User::join('personas','users.id1','=','personas.id')
                        ->join('roles','users.idrol','=','roles.id')
                        ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento',
                        'personas.direccion','personas.telefono','personas.email','users.usuario','users.password','users.condicion',
                        'personas.cargo',
                        'users.idrol','roles.nombre as rol')
                        ->where('users.idrol','!=','3')
                        ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
                        ->orderBy('id', 'desc')->paginate(10);
                    }
                }else if($rolid==2){
                    if ($buscar==''){
                        $personas = User::join('personas','users.id1','=','personas.id')
                        ->join('roles','users.idrol','=','roles.id')
                        ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento',
                        'personas.direccion','personas.telefono',
                        'personas.email','users.usuario','users.password','users.condicion','personas.cargo',
                        'users.idrol','roles.nombre as rol')
                        ->where('users.id1','=',$userid)
                        ->where('users.idrol','!=','3')
                        ->orderBy('personas.id', 'desc')->paginate(10);         
                        
                    }
                    else{
                        $personas = User::join('personas','users.id1','=','personas.id')
                        ->join('roles','users.idrol','=','roles.id')
                        ->select('personas.id','personas.nombre','personas.tipo_documento','personas.num_documento',
                        'personas.direccion','personas.telefono','personas.email','users.usuario','users.password',
                        'users.condicion','personas.cargo',
                        'users.idrol','roles.nombre as rol')
                        ->where('users.id1','=',$userid)
                        ->where('users.idrol','!=','3')
                        ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
                        ->orderBy('id', 'desc')->paginate(10);
                    }
            }
       
        if($rolid!=3){
            return [
                'pagination' => [
                    'total'        => $personas->total(),
                    'current_page' => $personas->currentPage(),
                    'per_page'     => $personas->perPage(),
                    'last_page'    => $personas->lastPage(),
                    'from'         => $personas->firstItem(),
                    'to'           => $personas->lastItem(),
                ],
                'personas' => $personas,
                
            ];
        }else{
            return [
                'pagination' => [
                    'total'        => $alumnos->total(),
                    'current_page' => $alumnos->currentPage(),
                    'per_page'     => $alumnos->perPage(),
                    'last_page'    => $alumnos->lastPage(),
                    'from'         => $alumnos->firstItem(),
                    'to'           => $alumnos->lastItem(),
                ],
                'alumnos' => $alumnos,                
            ];
        }
        
    
    
    }

    public function selectPersona(Request $request){
        $userid = Auth::user()->id1; 
        $rolid = Auth::user()->idrol;     
            if($rolid==1){
        if (!$request->ajax()) return redirect('/');        
        $personas = User::join('roles','users.idrol','=','roles.id')
        ->join('personas','users.id1','=','personas.id')
        ->where('idrol','!=','3')
        ->select('personas.id','personas.nombre as nombre')->orderBy('personas.nombre', 'asc')->get();
        return ['personas' => $personas];
    }else{
        if (!$request->ajax()) return redirect('/');        
        $personas = User::join('roles','users.idrol','=','roles.id')
        ->join('personas','users.id1','=','personas.id')
        ->where('idrol','!=','3')
        ->where('users.id1','=',$userid)
        ->select('personas.id','personas.nombre as nombre')->orderBy('personas.nombre', 'asc')->get();
        return ['personas' => $personas];
    }
}

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->id = ($persona->id*2);
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->cargo = $request->cargo;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $user = new User();
            $user->id = $persona->id;
            $user->id1 = $persona->id;
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
            $persona=Persona::find($request->id);    
            $persona->nombre = $request->nombre;
            $persona->tipo_documento = $request->tipo_documento;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();
                        
            $user = User::find($request->id);  
            //$user->id1 = $persona->id;
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();
             DB::commit();
            } catch (Exception $e){
                DB::rollBack();
            }
    }
    public function updateuser(Request $request){
        $user = User::findOrFail($request->id);
        $user->usuario = $request->usuario;
        $user->password = bcrypt( $request->password);
        $user->condicion = '1';
        $user->idrol = $request->idrol;
        $user->save();
    }
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->projects = Auth::user()->id1;
            return $next($request);
        });
    }
}
