<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Unidades
                        <button type="button" @click="abrirModal('periodo','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="periodos.nump">Unidad</option>
                                      <option value="materias.nombre">Materia</option>
                                       <option value="cursos.nombre">Curso</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPeriodo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPeriodo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                     <th>Unidad</th>
                                     </tr>                                
                            </thead>
                            <tbody>
                                <tr v-for="periodo in arrayPeriodo" :key="periodo.id">
                                    <td>
                                        <button type="button" @click="abrirModal('periodo','actualizar',periodo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="periodo.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarPeriodo(periodo.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarPeriodo(periodo.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>    
                                    <td v-text="periodo.nombre_curso"></td>                                                                                                   
                                    <td v-text="periodo.nombre_materia"></td>
                                    <!--td v-text="periodo.nperiodo"></td--> 
                                    <td v-text="periodo.nump"></td> 
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
                            <div class="form-group col">    
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Materia</label>
                                     <div class="col-md-9">
                                        <select class="form-control" v-model="idmateria">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="materia in arrayMateria" :key="materia.id" :value="materia.id" v-text="materia.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div> 
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nump" class="form-control" placeholder="Unit 1">                                        
                                    </div>
                                </div>     
                                <!--div class="form-group row" v-if="tipoAccion==2">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nperiodo" class="form-control" placeholder="Unit 2">                                        
                                    </div>
                                </div-->                           
                                </div>
                             <div v-show="errorPeriodo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPeriodo" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPeriodo()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPeriodo()">Actualizar</button>
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
                periodo_id: 0,
                idalumno : 0,
                idmateria : 0,
                idcurso:0,
                nombre_curso : '',
                nombre_materia : '',
                //nperiodo : '',
                nump : '',
                arrayPeriodo : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPeriodo : 0,
               
                errorMostrarMsjPeriodo : [],
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
                arrayAlumno :[],
               arrayMateria :[]
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
            listarPeriodo (page,buscar,criterio){
                let me=this;
                var url=  '/periodo?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPeriodo = respuesta.periodos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },
           
           selectMateria(){
                let me=this;
                var url=  '/materia/selectMateria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayMateria = respuesta.materias;
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
                me.listarPeriodo(page,buscar,criterio);
            },
            registrarPeriodo(){
                if (this.validarPeriodo()){
                    return;
                }
                
                let me = this;

                axios.post('/periodo/registrar',{              
                    'idmateria': this.idmateria,                    
                    'nump': this.nump
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPeriodo(1,' ','nump');
                }).catch(function (error) {
                    console.table(error);
                });
            },
            actualizarPeriodo(){
               if (this.validarPeriodo()){
                    return;
                }
                let me = this;

                axios.put('/periodo/actualizar',{                    
                     'idmateria': this.idmateria,
                       'nump': this.nump,
                       //'nperiodo': this.nperiodo,
                   'id': this.periodo_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPeriodo(1,'','nump');
                }).catch(function (error) {
                    console.table(error);
                }); 
            },
            desactivarPeriodo(id){
               swal({
                title: 'Esta seguro de eliminar este periodo?',
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

                    axios.put('/periodo/destroy',{
                        'id': id
                    }).then(function (response) {
                        me.listarPeriodo(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
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
            activarPeriodo(id){
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

                    axios.put('/periodo/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPeriodo(1,'','fecha');
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
            validarPeriodo(){
                this.errorPeriodo=0;
                this.errorMostrarMsjPeriodo =[];                               
                if (!this.idmateria) this.errorMostrarMsjPeriodo.push("Seleccione materia."); 
                if (!this.nump) this.errorMostrarMsjPeriodo.push("Seleccione Este campo no puede estar vacio.");              
                if (this.errorMostrarMsjPeriodo.length) this.errorPeriodo = 1;                
                return this.errorPeriodo;               
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';                
                this.idmateria= 0;
                this.nombre_alumno = '';
                this.nump = '';
                //this.nperiodo = '';
                this.nombre_materia = '';                
                this.fecha = '';
                this.errorPeriodo=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "periodo":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar periodo';                               
                                this.idmateria=0;                               
                                this.nombre_materia='';
                                //this.nperiodo= '';
                                this.nump='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Periodo';
                                this.tipoAccion=2;
                                this.periodo_id=data['id'];
                                this.idmateria=data['idmateria'];
                                //this.nperiodo = data['nperiodo'];
                                this.nump=data['nump'];
                                break;
                            }
                        }
                    }
                }
                this.selectMateria();
            }
        },
        mounted() {
            this.listarPeriodo(1,this.buscar,this.criterio);
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
