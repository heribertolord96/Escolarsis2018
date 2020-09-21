<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Materias
                        <button type="button" @click="abrirModal('materia','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="materias.nombre">Nombre</option>
                                      <option value="materias.descripcion">Descripción</option>
                                      <option value="cursos.nombre">Curso</option>
                                      <option value="personas.nombre">Maestro</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarMateria(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMateria(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Curso</th>
                                    <th>Materia</th>
                                    <th>Descripción</th>                                    
                                    <th>Maestro</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="materia in arrayMateria" :key="materia.id">
                                    <td>
                                        <button type="button" @click="abrirModal('materia','actualizar', materia)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="materia.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMateria(materia.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarMateria(materia.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    
                                    <td v-text="materia.nombre_curso"></td>
                                    <td v-text="materia.nombre"></td>
                                    <td  v-html ="materia.descripcion"> </td>
                                    <td v-text="materia.nombre_persona"></td>
                                    
                                   
                                </tr>                                
                            </tbody>
                        </table>
                        </div>
                        <nav>
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
                        </nav>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Curso</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idcurso">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="curso in arrayCurso" :key="curso.id" :value="curso.id" v-text="curso.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Maestro</label>
                                     <div class="col-md-9">
                                        <select class="form-control" v-model="idpersona">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Historia I">                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <textarea rows="5" maxlength="900" v-model="descripcion" class="form-control" placeholder="Detalles del materia...">
                                        </textarea>
                                         <a href="https://wordtohtml.net/">Word to html online editor</a>
                                    </div>
                                </div>
                               
                                
                                <div v-show="errorMateria" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMateria" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                               

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMateria()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMateria()">Actualizar</button>
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
                materia_id: 0,
                idcurso : 0,
                idpersona : 0,
                idmateria : 0,
                nombre_curso : '',
                nombre_persona : '',
                nombre : '',
                descripcion : '',
                arrayMateria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMateria : 0,
               
                errorMostrarMsjMateria : [],
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
               arrayPersona :[]
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
            listarMateria (page,buscar,criterio){
                let me=this;
                var url=  '/materia?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMateria = respuesta.materias.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },
            selectCurso(){
                let me=this;
                var url=  '/curso/selectCurso';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCurso = respuesta.cursos;
                })
                .catch(function (error) {
                    //console.log(error);
                    console.table(error);
                });
            },
           selectPersona(){
                let me=this;
                var url=  '/user/selectPersona';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas;
                })
                .catch(function (error) {
                    console.table(error);
                });
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarMateria(page,buscar,criterio);
            },
            registrarMateria(){
                if (this.validarMateria()){
                    return;
                }
                
                let me = this;

                axios.post('/materia/registrar',{
                    'idcurso': this.idcurso,
                   'idpersona': this.idpersona,
                    'nombre': this.nombre,
                    'descripcion': this.descripcion
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMateria(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                });
            },
            actualizarMateria(){
               if (this.validarMateria()){
                    return;
                }
                
                let me = this;

                axios.put('/materia/actualizar',{
                    'idcurso': this.idcurso,
                     'idpersona': this.idpersona,
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                   'id': this.materia_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarMateria(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                     swal(
                        'Error!',
                        'El registro ha sido eliminado con éxito.',
                        'error'
                        )
                }); 
            },
            desactivarMateria(id){
               swal({
                title: 'Esta seguro de eliminar definitivamente esta materia?',
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

                    axios.put('/materia/destroy',{
                        'id': id
                    }).then(function (response) {
                        me.listarMateria(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.table(error);
                        
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarMateria(id){
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

                    axios.put('/materia/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarMateria(1,'','nombre');
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
            validarMateria(){
                this.errorMateria=0;
                this.errorMostrarMsjMateria =[];
                //this.errorPersona=0;
                //this.errorMostrarMsjPersona =[];

                if (this.idcurso==0) this.errorMostrarMsjMateria.push("Seleccione curso para esta materia");
                if (this.idpersona==0) this.errorMostrarMsjMateria.push("Seleccione persona para esta materia");
                if (!this.nombre) this.errorMostrarMsjMateria.push("El nombre  no puede estar vacío.");              
                if (this.errorMostrarMsjMateria.length) this.errorMateria = 1;
                return this.errorMateria;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idcurso= 0;
                this.idpersona = 0;
                this.nombre_curso = '';
              this.nombre_persona = '';
                this.nombre = '';
              
                this.descripcion = '';
                this.errorMateria=0;
                //this.errorPersona=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "materia":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar materia';
                                this.idcurso=0;
                                this.idpersona=0;
                                this.nombre_curso='';
                                this.nombre_persona='';
                                this.nombre= '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Materia';
                                this.tipoAccion=2;
                                this.materia_id= data['id'];
                                this.idcurso=data['idcurso'];
                                this.idpersona=data['idpersona'];
                                this.nombre = data['nombre'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
                this.selectCurso();
                this.selectPersona();
            }
        },
        mounted() {
            this.listarMateria(1,this.buscar,this.criterio);
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
