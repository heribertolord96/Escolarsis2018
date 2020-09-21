@extends('auth.contenido')
@section('login')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card-group mb-0">
         <div class="card p-4" style=" background-color: #18b1b162;
            background-clip: border-box;
            border-radius:5px 0px 0px 5px; box-shadow: 0px 0px 15px 15px #2344da88;">
            <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
               {{ csrf_field() }}
               <div class="card-body">
                  <h1>Acceder</h1>
                  <p class="text-muted"><b>Control de acceso al sistema</b></p>
                  <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                     <span class="input-group-addon"><i class="icon-user"></i></span>
                     <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                     {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                  </div>
                  <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                     <span class="input-group-addon"><i class="icon-lock"></i></span>
                     <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                     {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                  </div>
                  <div class="row">
                     <div class="col-6">
                        <center>
                           <button type="submit" class="btn btn-success px-4">Acceder</button>
                        </center>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
               <div>
                  <h2>Sistema de Control escolar</h2>
                  <p>Sistema de control escolar, desarrollado en PHP utilizando el Framework Laravel y Vue Js, con el gestor de base de datos MariaDB.</p>
                  <img src="img/avatars/logo9.png" class="img-avatar" alt="admin@bootstrapmaster.com">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection