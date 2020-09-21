<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Reportes
                        <button type="button" @click="abrirModal('reporte','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="alumnos.nombre">Nombre</option>
                                      <option value="reportes.nombre">Asunto</option>
                                      <option value="reportes.fecha">Fecha</option>
                                      <option value="reportes.descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarReporte(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarReporte(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Alumno</th>
                                    <th>Asunto</th><!--nombre caso-->
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reporte in arrayReporte" :key="reporte.id">
                                    <td>
                                        <button type="button" @click="abrirModal('reporte','actualizar',reporte)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="reporte.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarReporte(reporte.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarReporte(reporte.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="reporte.nombre_alumno"></td>
                                    <td v-text="reporte.nombre"></td>
                                    <td v-text="reporte.fecha"></td>
                                    <td v-html="reporte.descripcion"></td>
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
                                  <div style="width:100%;">
                        <div class="flex-container">
                           <div>
                              <label class="col-md-3  form-control-label" for="text-input">Curso</label>
                              <select class="form-control" @change="curso"   v-model="state.curso" >
                                 <option value="0" disabled>Seleccione</option>
                                 <option v-for="curso in arrayCurso" :key="curso.id" :value="curso.id" v-text="curso.nombre">
                                 </option>
                              </select>
                           </div>
                           <div >
                              <label class="col-md-3  form-control-label" for="text-input">Alumno</label>
                              <select  v-model="idalumno" id="al1" class="form-control" >
                                 <option value="0" disabled>Seleccione</option>
                                 <option v-for="alumno in arrayAlumno" :key="alumno.id" :value="alumno.id" v-text="alumno.apaterno+' '+alumno.amaterno+' '+alumno.nombre">
                                 </option>
                              </select>
                           </div>
                        </div> </div>     </br> 
                                    <!---->                             
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Asunto</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Informatica 2A">                                        
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha</label>
                                     <div >
                                 <input type="date" v-model="fecha" class="form-control" placeholder="05/11/0000">
                              </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                                    <div class="col-md-9">
                                        <textarea rows="5" maxlength="900" v-model="descripcion" class="form-control" placeholder="Detalles del reporte...">
                                        </textarea>
                                         <a href="https://wordtohtml.net/">Word to html online editor</a>
                                    </div>
                                </div>
                               
                                
                                <div v-show="errorReporte" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjReporte" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarReporte()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarReporte()">Actualizar</button>
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
                reporte_id: 0,
                idalumno : 0,
                nombre_alumno : '',
                nombre : '',
                descripcion : '',
                arrayReporte : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorReporte : 0,
                arrayCurso :[],
                 state: {       
                  grupo:'',           
                  curso : '',
                  materia : '',
                  alumno : '',
                  periodo : ''
                    },
                     fecha : '',
                errorMostrarMsjReporte : [],
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
                arrayAlumno :[]
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
            listarReporte (page,buscar,criterio){
                let me=this;
                var url=  '/reporte?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayReporte = respuesta.reportes.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },
            curso(){
                  this.state.materia = '';
                  //this.state.alumno = '';
                      // set params
                      const params = {
                          curso: this.state.curso
                      }
                      // url /location/regency?curso=xxx
                      axios.get('chained/materia', {params}).then(response => {                                
                          this.arrayMateria =response.data;
                      }).catch(error => console.table(error));
                     axios.get('chained/alumno', {params}).then(response => {                                
                          this.arrayAlumno = response.data;
                      }).catch(error => console.table(error));
                  },                   
                 

            /*selectAlumno(){
                let me=this;
                var url= '/alumno/selectAlumno';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayAlumno = respuesta.alumnos;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },*/
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarReporte(page,buscar,criterio);
            },
            registrarReporte(){
                if (this.validarReporte()){
                    return;
                }
                
                let me = this;
                axios.post('/reporte/registrar',{
                   'idalumno': this.idalumno,
                    'nombre': this.nombre,
                    'fecha': this.fecha,
                    'descripcion': this.descripcion
                    
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarReporte(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                });
            },
            actualizarReporte(){
               if (this.validarReporte()){
                    return;
                }
                
                let me = this;

                axios.put('/reporte/actualizar',{
                    'idalumno': this.idalumno,
                    'nombre': this.nombre,
                    'fecha': this.fecha,
                    'descripcion': this.descripcion,
                   'id': this.reporte_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarReporte(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                }); 
            },
            desactivarReporte(id){
               swal({
                title: 'Esta seguro de eliminar este reporte?',
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

                    axios.put('/reporte/destroy',{
                        'id': id
                    }).then(function (response) {
                        me.listarReporte(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        swal(
                        'Denegado!',
                        'Se eliminarian todas las materias de este reporte, solo puede eliminar reportes sin materias',
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
            activarReporte(id){
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

                    axios.put('/reporte/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarReporte(1,'','nombre');
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
            validarReporte(){
                this.errorReporte=0;
                this.errorMostrarMsjReporte =[];

                if (this.idalumno==0) this.errorMostrarMsjReporte.push("Seleccione el alumno");
                if (!this.nombre) this.errorMostrarMsjReporte.push("El nombre  no puede estar vacío.");
                if (!this.fecha) this.errorMostrarMsjSesion.push("Seleccione fecha del evento.");
                if (this.errorMostrarMsjReporte.length) this.errorReporte = 1;

                return this.errorReporte;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idalumno= 0;
                this.nombre_alumno = '';
              
                this.nombre = '';
              
                this.descripcion = '';
                this.errorReporte=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "reporte":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Reporte';
                                this.idalumno=0;
                                this.nombre_alumno='';
                                this.nombre= '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Reporte';
                                this.tipoAccion=2;
                                this.reporte_id=data['id'];
                                this.idalumno=data['idalumno'];
                                this.nombre = data['nombre'];
                                this.descripcion= data['descripcion'];
                                
                                break;
                            }
                        }
                    }
                }
                //this.selectAlumno();
            }
        },
        mounted() {
            this.listarReporte(1,this.buscar,this.criterio);
             axios.get('chained/curso').then(response => {
          this.arrayCurso = response.data;
           }).catch(error => console.table(error));
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
<style>
    .flex-container {
    display: flex;
    flex-wrap: wrap;
    background-color: #67a0be;
    }
    .flex-alumno {
    display: flex;
    flex-wrap: wrap;
    background-color: #67a0be;
    }
    .flex-notas {
    display: flex;
    flex-wrap: wrap;
    background-color: #67a0be;
    }
    .flex-container > div {
    background-color: #f1f1f1;
    width: 40%;
    min-width: 100px;
    margin-left: 5%;
    margin-top: 1%;
    margin-bottom: 1%;
    text-align: center;
    border-radius:5px;
    box-shadow:5px; 
    }
    .flex-alumno > div {
    background-color: #f1f1f1;
    width: 95%;
    min-width: 100px;
    margin-left: 2%;
    margin-right: 2%;
    margin-top: 1%;
    margin-bottom: 1%;
    text-align: center;
    border-radius:5px;
    box-shadow:5px;
    }
    .flex-notas > div {
    background-color: #f1f1f1;
    width: 30%;
    min-width: 100px;
    margin-left: 1%;
    margin-right: 1%;
    margin-top: 1%;
    margin-bottom: 1%;
    text-align: center;
    border-radius:5px;
    box-shadow:5px;
    }
    .flex-container > select {
    background-color: #ebebe0;
    width: 97%;  
    margin: 3%;
    text-align: center;
    }
    .flex-container > input {
    background-color: #ebebe0;
    width: auto;  
    margin: 5px;
    text-align: center;
    }
</style>