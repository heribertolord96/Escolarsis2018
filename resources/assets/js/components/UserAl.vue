<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Alumnos
                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="alumnos.nombre">Nombre</option>
                                      <option value="alumnos.apaterno">A. Paterno</option>
                                      <option value="alumnos.num_ide">Curp</option>
                                      <option value="alumnos.birthday">Nacimiento</option>
                                      <option value="grupos.nombre">Grupo</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarAlumno(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarAlumno(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>A. Paterno</th>
                                    <th>A. Materno</th>
                                    <th>Nombre</th>                                   
                                    <th>Grupo</th>                               
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="alumno in arrayAlumno" :key="alumno.id">
                                    <td>
                                        <button type="button" @click="abrirModal('alumno','actualizar',alumno)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;                                        
                                    </td>
                                    
                                    <td v-text="alumno.apaterno"></td>
                                    <td v-text="alumno.amaterno"></td>
                                    <td v-text="alumno.nombre"></td>
                                    <td v-text="alumno.nombre_grupo"></td>
                                   
<!--
                                    <td v-text="alumno.num_ide"></td>
                                    <td v-text="alumno.direccion"></td>
                                    <td v-text="alumno.telefono"></td>
                                    <td v-text="alumno.email"></td>
                                    <td v-text="alumno.birthday"></td>
                                    <td v-text="alumno.sexo"></td>
                                    <td v-text="alumno.usuario"></td>
                                    
                                    -->
                                    <td>
                                        <div v-if="alumno.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <!--nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav-->
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Grupo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idgrupo">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="grupo in arrayGrupo" :key="grupo.id" :value="grupo.id" v-text="grupo.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control" placeholder="Nombre del usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">password</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="password del usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">A. Paterno</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apaterno" class="form-control" placeholder="Gallo">                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">A .Materno</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="amaterno" class="form-control" placeholder="Rosas">                                        
                                    </div>
                                </div>
                                
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Informatica 2A">                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Nacimiento</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="birthday" class="form-control" placeholder="23/02/1996">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">CURP</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="num_ide" class="form-control" placeholder="HETH966223hjcrrr">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Los Santos City">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" class="form-control" placeholder="000.000.0000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="carlj@jizzymail.ls">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Sexo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="sexo" class="form-control" placeholder="H/M">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Edad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="edad" class="form-control" placeholder="0">
                                    </div>
                                </div>
                               
                                
                                <div v-show="errorAlumno" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjAlumno" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarAlumno()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarAlumno()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
        </main>
</template>

<script>
    export default {      
        data (){
            return {
                alumno_id: 0,
                idcurso : 0,
                idgrupo : 0,
                nombre_curso : '',
                nombre : '',
                apaterno :'',
                amaterno :'',
                num_alumno :'',
                birthday :'',
                num_ide :'',
                direccion :'',
                telefono :'',
                email :'',
                sexo :'',
                edad :'',
                usuario: '',
                password:'',
                idrol: '',               
                arrayAlumno : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorAlumno : 0,
                errorMostrarMsjAlumno : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayCurso :[],
                arrayGrupo :[]
            }
        },
    
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarAlumno (page,buscar,criterio){
                let me=this;
                var url=  '/alumno?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayAlumno = respuesta.alumnos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },
            selectCurso(){
                let me=this;
                var url=  '/alumno/selectGrupo';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayGrupo = respuesta.grupos;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             selectRol(){
                let me=this;
                var url=  '/rol/selectRol';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarAlumno(page,buscar,criterio);
            },
            registrarAlumno(){
                if (this.validarAlumno()){
                    return;
                }
                
                let me = this;

                axios.post('/alumno/registrar',{
                    'idgrupo': this.idgrupo,
                    'nombre': this.nombre,
                    'apaterno': this.apaterno,
                    'amaterno': this.amaterno,
                    'num_alumno': this.num_alumno,
                    'birthday': this.birthday,
                    'num_ide': this.num_ide,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                    'email': this.email,
                    'sexo': this.sexo,
                    'edad': this.edad,
                    'idrol' : 3,
                    'usuario': this.usuario,
                    'password': this.password
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAlumno(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                });
            },
            actualizarAlumno(){
               if (this.validarAlumno()){
                    return;
                }
                
                let me = this;

                axios.put('/alumno/actualizar',{
                    'idgrupo': this.idgrupo,
                    'nombre': this.nombre,
                    'apaterno': this.apaterno,
                    'amaterno': this.amaterno,
                    'num_alumno': this.num_alumno,
                    'birthday': this.birthday,
                    'num_ide': this.num_ide,
                    'direccion': this.direccion,
                    'telefono': this.telefono,
                    'email': this.email,
                    'sexo': this.sexo,
                    'edad': this.edad,
                    'idrol' : 3,
                    'usuario': this.usuario,
                    'password': this.password,                    
                   'id': this.alumno_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarAlumno(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                }); 
            },
            desactivarAlumno(id){
               swal({
                title: 'Esta seguro de desactivar este artículo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/alumno/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarAlumno(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                        
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarAlumno(id){
               swal({
                title: 'Esta seguro de activar este artículo?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/alumno/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarAlumno(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarAlumno(){
                this.errorAlumno=0;
                this.errorMostrarMsjAlumno =[];

                if (this.idgrupo==0) this.errorMostrarMsjAlumno.push("Seleccione un grupo.");
                if (this.password==0) this.errorMostrarMsjAlumno.push("Ingrese contraseña.");
                if (!this.nombre) this.errorMostrarMsjAlumno.push("El nombre  no puede estar vacío.");
            
                if (this.errorMostrarMsjAlumno.length) this.errorAlumno = 1;

                return this.errorAlumno;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idgrupo= 0;
                this.nombre_curso = '';
              this.nombre='';
                this.apaterno='';
                this.amaterno='';
                this.num_alumno='';
                this.birthday='';
                this.num_ide='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.sexo='';
                this.edad='';
                this.usuario='';
                this.password='';
                this.idrol=3;
                this.errorAlumno=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "alumno":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Alumno';
                                this.idgrupo=0;
                                this.nombre_curso='';
                                
                                this.nombre='';
                                this.apaterno='';
                                this.amaterno='';
                                this.num_alumno='';
                                this.birthday='';
                                this.num_ide='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.sexo='';
                                this.edad='';
                                 this.usuario='';
                                this.password='';
                                this.idrol=3;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Alumno';
                                this.tipoAccion=2;
                                this.alumno_id=data['id'];
                                this.idgrupo=data['idgrupo'];
                                this.nombre=data['nombre'];
                                this.apaterno=data['apaterno'];
                                this.amaterno=data['amaterno'];
                                this.num_alumno=data['num_alumno'];
                                this.birthday=data['birthday'];
                                this.num_ide=data['num_ide'];
                                this.direccion=data['direccion'];
                                this.telefono=data['telefono'];
                                this.email=data['email'];
                                this.usuario = data['usuario'];
                                this.password=data['password'];
                                this.idrol=3;
                                this.sexo=data['sexo'];
                                this.edad=data['edad'];
                                
                                break;
                            }
                        }
                    }
                }
                this.selectCurso();
            }
        },
        mounted() {
            this.listarAlumno(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
