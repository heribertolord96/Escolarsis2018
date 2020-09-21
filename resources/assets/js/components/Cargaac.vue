<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Cursos
                        <button type="button" @click="abrirModal('matricula','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="cursos.nombre">Curso</option>
                                      <option value="grupos.nombre">Grupo</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCarga(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCarga(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        
               <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                <th>Opciones</th>
                                    <th>Grupo</th>
                                    <th>Curso</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                           
                                <tr v-for="matricula in arrayMatricula" :key="matricula.id"> 
                                <td>
                                        <button type="button" @click="abrirModal('matricula','actualizar',matricula)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template >
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarMatricula(matricula.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        
                                    </td>
                                    <td v-text="matricula.nombre_grupo"></td>
                                    <td v-text="matricula.nombre_curso"></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Grupo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idgrupo">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="grupo in arrayGrupo" :key="grupo.id" :value="grupo.id" v-text="grupo.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Curso</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idcurso">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="curso in arrayCurso" :key="curso.id" :value="curso.id" v-text="curso.nombre"></option>
                                        </select>                                        
                                    </div>
                                </div>                           
                                <div v-show="errorMatricula" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMatricula" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                                </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarMatricula()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMatricula()">Actualizar</button>
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
                matricula_id: 0,
                idalumno : 0,
                idmatricula : 0,
                idcurso:0,
                idgrupo:0,
                nombre_alumno : '',
                nombre_curso : '',
                nombre_grupo : '',
                arrayAlumno :[],
                arrayGrupo :[],
                arrayCurso :[],
                arrayMatricula : [], 
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorMatricula : 0,               
                errorMostrarMsjMatricula : [],
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
                buscar : ''
               
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
            listarCarga (page,buscar,criterio){
                let me=this;
                var url= '/carga?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMatricula = respuesta.cargas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },
            /*selectMatricula(){
                let me=this;
                var url= '/carga/selectMatricula';
                axios.get(url).then(function (response) {
                    //console.table(response);
                    var respuesta= response.data;
                    me.arrayMatricula = respuesta.matriculas;
                })
                .catch(function (error) {
                    console.table(error);
                });
            },*/
            selectGrupo(){
                let me=this;
                var url= '/alumno/selectGrupo';
                axios.get(url).then(function (response) {
                    //console.table(response);
                    var respuesta= response.data;
                    me.arrayGrupo = respuesta.grupos;
                })
                .catch(function (error) {
                    console.table(error);
                });
            },
            selectCurso(){
                let me=this;
                var url= '/curso/selectCurso';
                axios.get(url).then(function (response) {
                    //console.table(response);
                    var respuesta= response.data;
                    me.arrayCurso = respuesta.cursos;
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
                me.listarCarga(page,buscar,criterio);
            },
            registrarMatricula(){
                if (this.validarMatricula()){
                    return;
                }                
                let me = this;
                axios.post('/matricula/registrar',{
                    'idcurso': this.idcurso,
                    'idgrupo': this.idgrupo                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCarga(1,'','curso');
                }).catch(function (error) {
                    swal(
                        'Error!',
                        'Probablemente, esta entrada ya existe, intente otra',
                        'error'
                        )
                    console.table(error);
                });
            },
            actualizarMatricula(){
               if (this.validarMatricula()){
                    return;
                }                
                let me = this;
                axios.put('/matricula/actualizar',{
                    'idcurso': this.idcurso,
                    'idgrupo': this.idgrupo,
                   'id': this.matricula_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCarga(1,'','nombre');
                }).catch(function (error) {
                    swal(
                        'Error!',
                        'Probablemente, esta entrada ya existe, intente otra',
                        'error'
                        )
                    console.table(error);
                }); 
            },
            desactivarMatricula(id){
               swal({
                title: 'Esta seguro de eliminar todos los alumnos de este curso?',
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
                    axios.put('/matricula/destroy',{
                        'id': id
                    }).then(function (response) {
                        me.listarCarga(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        swal(
                        'Denegado!',
                        'se ha producido un error, otros objetos equieren este.',
                        'error'
                        )
                        console.table(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) { 
                }
                }) 
            },
            
            activarMatricula(id){
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

                    axios.put('/curso/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCarga(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
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
            validarMatricula(){
                this.errorMatricula=0;
                this.errorMostrarMsjMatricula =[];
                if (this.idgrupo==0) this.errorMostrarMsjMatricula.push("Seleccione El grupo que desea inscribir.");
                if (this.idcurso==0) this.errorMostrarMsjMatricula.push("Seleccione el curso al que desea inscribir");
                if (this.errorMostrarMsjMatricula.length) this.errorMatricula = 1;
                return this.errorMatricula;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idcurso= 0;
                this.nombre_curso = '';
                this.idgrupo= 0;
                this.nombre_grupo = '';
                this.errorMatricula=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "matricula":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Matricula';
                                this.idgrupo=0;
                                this.nombre_grupo='';
                                this.idcurso=0;
                                this.nombre_curso='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                console.table(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Matricula';
                                this.tipoAccion=2;
                                this.matricula_id=data['id'];
                                this.idgrupo=data['idgrupo'];
                                this.idcurso=data['idcurso'];                                
                                break;
                            }
                        }
                    }
                }
                this.selectGrupo();
                //this.selectMatricula();
                this.selectCurso();
            }
        },
        mounted() {
            this.listarCarga(1,this.buscar,this.criterio);
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
