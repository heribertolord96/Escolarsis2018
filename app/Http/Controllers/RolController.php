<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rol;

class RolController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $roles = Rol::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $roles = Rol::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page'     => $roles->perPage(),
                'last_page'    => $roles->lastPage(),
                'from'         => $roles->firstItem(),
                'to'           => $roles->lastItem(),
            ],
            'roles' => $roles
        ];
    }
    public function selectRol(Request $request)
    {
        $userid = Auth::user()->id1; 
        $userid2 = Auth::user()->id2; 
        $rolid = Auth::user()->idrol;     
            if($rolid==1){
        $roles = Rol::where('condicion', '=', '1')
        ->select('id','nombre')
        ->where('id','!=','3')
        ->orderBy('nombre', 'asc')->get();
        return ['roles' => $roles];
            }
            else if($rolid==2){
                $roles = Rol::where('id','=','2')
                            //->where('roles.id','=','2')
                ->select('id','nombre')
                ->where('id','!=','3')
                ->orderBy('nombre', 'asc')->get();
                return ['roles' => $roles];
            }
            else if($rolid==3){
                $roles = Rol::where('id','=','3')
                //->where('roles.id','=','3')
    ->select('id','nombre')
    ->where('id','!=','3')
    ->orderBy('nombre', 'asc')->get();
    return ['roles' => $roles];
            }

    } 
}
