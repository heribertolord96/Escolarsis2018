<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">  
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Sesiones
                        <button type="button" @click="abrirModal('sesion','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="alumnos.nombre">Nombre</option>
                                      <option value="sesions.fecha">Fecha</option>                                  
                                      <option value="materias.nombre">Materia</option>
                                      <option value="periodos.nump">Periodo</option>
                                      <option value="cursos.nombre">Curso</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarSesion(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarSesion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                     <th>Alumno</th>
                                     <th>Curso</th>
                                     <th>Materia</th>
                                     <th>Periodo</th>
                                     <th>Fecha</th>
                                     <th>Calificacion</th>
                                     <th>Asistencia</th>
                                     <th>Conducta</th>
                                </tr>                                
                            </thead>
                            <tbody>
                                <tr v-for="sesion in arraySesion" :key="sesion.id">
                                    <td>
                                        <button type="button" @click="abrirModal('sesion','actualizar',sesion)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="sesion.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarSesion(sesion.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarSesion(sesion.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                     
                                    <td v-text="sesion.nombre_alumno"></td>
                                     <td v-text="sesion.nombre_curso"></td>
                                     <td v-text="sesion.nombre_materia"></td>
                                     <td v-text="sesion.nperiodo"></td>
                                     <td v-text="sesion.fecha"></td>                                                                
                                    <td v-text="sesion.calificacion"></td>
                                    <td v-text="sesion.asistencia"></td>
                                    <td v-text="sesion.conducta"></td>
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
            <div  v-if="tipoAccion==1" class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
               
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
                            
                            <div>
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
                              <label class="col-md-3  form-control-label" for="text-input">Materia</label>
                              <select class="form-control" @change="materia" v-model="state.materia">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="materia in arrayMateria" :key="materia.id" :value="materia.id" v-text="materia.nombre"></option>
                                        </select>   
                           </div>
                        </div>
                        <div class="flex-container">
                           <div >
                              <label class="col-md-3  form-control-label" for="text-input">Periodo</label>
                              <select   v-model="idperiodo"  id="per1" class="form-control"  >
                                 <option value="0" disabled>Seleccione</option>
                                 <option v-for="periodo in arrayPeriodo" :key="periodo.id" :value="periodo.id" v-text="periodo.nump" ></option>
                                 
                              </select>
                           </div>
                           <div>
                              <label class="col-md-3 form-control-label" for="email-input">Fecha</label>
                              <div >
                                 <input type="date" v-model="fecha" class="form-control" placeholder="05/11/0000">
                              </div>
                           </div>
                        </div>
                        <!--________________________-->
                        <div class="flex-alumno">
                           <div >
                              <label class="col-md-3  form-control-label" for="text-input">Alumno</label>
                              <select  v-model="idalumno" id="al1" class="form-control" >
                                 <option value="0" disabled>Seleccione</option>
                                 <option v-for="alumno in arrayAlumno" :key="alumno.id" :value="alumno.id" v-text="alumno.apaterno+' '+alumno.amaterno+' '+alumno.nombre">
                                 </option>
                              </select>                              
                           </div>
                        </div>
                     </div><div class="flex-notas">
                        <div>
                           <label class="col-md-3 form-control-label" for="email-input">Calificacion</label>                                                                                                  
                           <input type="number" v-model="calificacion" class="form-control" v-text="100"  placeholder="Calificacion">                            
                        </div>
                        <div >
                           <label class="col-md-3 form-control-label" for="email-input">Asistencia</label> 
                           <input type="number" v-model="asistencia" class="form-control" v-text="1"  placeholder="Asistencia">
                        </div>
                        <div >
                           <label class="col-md-3 form-control-label" for="email-input">Conducta</label> 
                           <input type="number" v-model="conducta" class="form-control" v-text="100" placeholder="Conducta">
                        </div>
                     </div>
                     <div>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-success icon-energy" @click="registrarSesionFast()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-success icon-energy" @click="actualizarSesionFast()">Actualizar</button>
                     </div>
                     <div v-show="errorSesion" class="form-group row div-error">
                        <div class="text-center text-error">
                           <div v-for="error in errorMostrarMsjSesion" :key="error" v-text="error">
                           </div>
                        </div>
                     </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarSesion()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarSesion()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-------------->
            <div  v-if="tipoAccion==2" class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
               
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
                            
                            <div>
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
                              <label class="col-md-3  form-control-label" for="text-input">Materia</label>
                              <select class="form-control" @change="materia" v-model="state.materia">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="materia in arrayMateria" :key="materia.id" :value="materia.id" v-text="materia.nombre"></option>
                                        </select>   
                           </div>
                        </div>
                        <div class="flex-container">
                           <div >
                              <label class="col-md-3  form-control-label" for="text-input">Periodo</label>
                              <select   v-model="idperiodo"  id="per1" class="form-control"  >
                                 <option value="0" disabled>Seleccione</option>
                                 <option v-for="periodo in arrayPeriodo" :key="periodo.id" :value="periodo.id" v-text="periodo.nump" ></option>
                                 
                              </select>
                           </div>
                           <div>
                              <label class="col-md-3 form-control-label" for="email-input">Fecha</label>
                              <div >
                                 <input type="date" v-model="fecha" class="form-control" placeholder="05/11/0000">
                              </div>
                           </div>
                        </div>
                        <!--________________________-->
                        <div class="flex-alumno">
                           <div >
                              <label class="col-md-3  form-control-label" for="text-input">Alumno</label>
                              <select  v-model="idalumno" id="al1" class="form-control" >
                                 <option value="0" disabled>Seleccione</option>
                                 <option v-for="alumno in arrayAlumno" :key="alumno.id" :value="alumno.id" v-text="alumno.apaterno+' '+alumno.amaterno+' '+alumno.nombre">
                                 </option>
                              </select>                              
                           </div>
                        </div>
                     </div><div class="flex-notas">
                        <div>
                           <label class="col-md-3 form-control-label" for="email-input">Calificacion</label>                                                                                                  
                           <input type="number" v-model="calificacion" class="form-control" v-text="100"  placeholder="Calificacion">                            
                        </div>
                        <div >
                           <label class="col-md-3 form-control-label" for="email-input">Asistencia</label> 
                           <input type="number" v-model="asistencia" class="form-control" v-text="1"  placeholder="Asistencia">
                        </div>
                        <div >
                           <label class="col-md-3 form-control-label" for="email-input">Conducta</label> 
                           <input type="number" v-model="conducta" class="form-control" v-text="100" placeholder="Conducta">
                        </div>
                     </div>
                     <div v-show="errorSesion" class="form-group row div-error">
                        <div class="text-center text-error">
                           <div v-for="error in errorMostrarMsjSesion" :key="error" v-text="error">
                           </div>
                        </div>
                     </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarSesion()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarSesion()">Actualizar</button>
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
                sesion_id: 0,
                idalumno : 0,
                idperiodo : 0,
                idmateria : 0,
                idcurso :0,
                nombre_alumno : '',
                nombre_curso:'',
                apaterno_alumno : '',
                nombre_materia : '',
                mat_name : '',
                calificacion : '',
                asistencia : '',
                conducta : '',
                nperiodo : '',
                nump : '',
                fecha : '',
                arraySesion : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorSesion : 0,
                //cursoselect :0,
               
                errorMostrarMsjSesion : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'fecha',
                buscar : '',
                arrayAlumno :[],
               arrayMateria :[],
               arrayPeriodo :[],
                arrayCurso :[],
                state: {       
                   grupo:'',           
                   curso : '',
                   materia : '',
                   alumno : '',
                   periodo : ''
                     }
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

            listarSesion (page,buscar,criterio){
                let me=this;
                var url=  '/sesion?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraySesion = respuesta.sesions.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },/*
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
           },*/
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
                   materia(){
                  // this.state.periodo = '';
                       // set params
                       const params = {
                           materia: this.state.materia
                       }
                       // url /location/regency?curso=xxx
                       axios.get('chained/periodo', {params}).then(response => {
                           this.arrayPeriodo = response.data;
                       }).catch(error => console.table(error));
               },
               /*selectCurso(){                    
                let me=this;
                var url= '/curso/selectCurso';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCurso = respuesta.cursos;
                })
                .catch(function (error) {
                    console.table(error);
                });
                   
                },*/
                /*
            selectAlumno(){
                let me=this;
                var url= '/alumno/selectAlumno';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayAlumno = respuesta.alumnos;
                })
                .catch(function (error) {
                    //console.log(error);
                    console.table(error);
                });
            },*//*
                selectPeriodo(){
                let me=this;
                var url= '/periodo/selectPeriodo';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayPeriodo = respuesta.periodos;
                })
                .catch(function (error) {
                    console.table(error);
                });
                },*/

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarSesion(page,buscar,criterio);
            },
            registrarSesionFast(){
                 if (this.validarSesion()){
                    return;
                }                
                let me = this;
                axios.post('/sesion/registrar',{                
                    'idalumno': this.idalumno,
                   'idmateria': this.state.materia,
                   'idcurso': this.state.curso,
                   'idperiodo': this.idperiodo,
                    'calificacion': this.calificacion,
                    'asistencia': this.asistencia,
                    'conducta': this.conducta,                    
                    'fecha': this.fecha                    
                 }).then(function (response) {
                    me.LimpiarModal();
                    me.listarSesion(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                });
            },            
            actualizarSesionFast(){
                if (this.validarSesion()){
                    return;
                }                
                let me = this;
                axios.put('/sesion/actualizar',{
                    'idalumno': this.idalumno,
                   'idmateria': this.state.materia,
                   'idcurso': this.state.curso,
                   'idperiodo': this.idperiodo,
                    'calificacion': this.calificacion,
                    'asistencia': this.asistencia,
                    'conducta': this.conducta,                    
                    'fecha': this.fecha ,
                   'id': this.sesion_id
                }).then(function (response) {
                    me.LimpiarModal();
                }).catch(function (error) {
                    console.table(error);
                }); 

            },
            registrarSesion(){
                if (this.validarSesion()){
                    return;
                }
                
                let me = this;

                 axios.post('/sesion/registrar',{                
                    'idalumno': this.idalumno,
                   'idmateria': this.state.materia,
                   'idcurso': this.state.curso,
                   'idperiodo': this.idperiodo,
                    'calificacion': this.calificacion,
                    'asistencia': this.asistencia,
                    'conducta': this.conducta,                    
                    'fecha': this.fecha                    
                 }).then(function (response) {
                    me.cerrarModal();
                    me.listarSesion(1,'','nombre');
                }).catch(function (error) {
                    console.table(error);
                });
            },
            actualizarSesion(){
               if (this.validarSesion()){
                    return;
                }                
                let me = this;
                axios.put('/sesion/actualizar',{
                    'idalumno': this.idalumno,
                   'idmateria': this.state.materia,
                   'idcurso': this.state.curso,
                   'idperiodo': this.idperiodo,
                    'calificacion': this.calificacion,
                    'asistencia': this.asistencia,
                    'conducta': this.conducta,                    
                    'fecha': this.fecha ,
                   'id': this.sesion_id
                }).then(function (response) {
                    me.LimpiarModal();
                }).catch(function (error) {
                    console.table(error);
                }); 
            },
            desactivarSesion(id){
               swal({
                title: 'Esta seguro de eliminar esta sesion?',
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

                    axios.put('/sesion/destroy',{
                        'id': id
                    }).then(function (response) {
                        me.listarSesion(1,'','nombre');
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
            
            validarSesion(){
                this.errorSesion=0;                
                this.errorMostrarMsjSesion =[];                               
                if(this.idalumno==0) this.errorMostrarMsjSesion.push("Seleccione alumno para esta sesion");
                 if(this.idperiodo==0) this.errorMostrarMsjSesion.push("Seleccione periodo para esta sesion");
                if (!this.fecha) this.errorMostrarMsjSesion.push("Seleccione fecha de la clase");
                //if ( [this.idalumno && this.fecha && this.idmateria ]) this.errorMostrarMsjSesion.push("No se puede repetir esta sesion porque ya existe");
                //if (!this.idmateria) this.errorMostrarMsjSesion.push("Seleccione materia.");
                if (!this.state.materia) this.errorMostrarMsjSesion.push("Seleccione materia.");
                      if (this.errorMostrarMsjSesion.length) this.errorSesion = 1;
                
                return this.errorSesion;
               
            },
            LimpiarModal(){
               
                //this.idalumno= 0;
                this.nombre_alumno = '';                
                this.calificacion = '';              
                this.asistencia = '';
                this.conducta = '';                             
                this.errorSesion=0;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idalumno= 0;
                this.idcurso= 0;
                this.idmateria= 0;                
                this.idperiodo = 0;
                this.nombre_alumno = '';
                this.nombre_materia = '';
                this.calificacion = '';              
                this.asistencia = '';
                this.conducta = '';
                this.fecha = '';                
                this.errorSesion=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "sesion":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar sesion';
                                this.idalumno=0;
                                this.idmateria=0;
                                this.idcurso=0;
                                this.idperiodo = 0;
                                this.nombre_alumno='';
                                this.nombre_materia='';
                                this.calificacion= '';
                                this.asistencia = '';
                                this.conducta = '';
                                this.fecha = '';
                                this.tipoAccion = 1;
                                break;
                            }
                        /* case 'registrarFast':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar sesion';
                                this.idalumno=0;
                                this.idmateria=0;
                                this.idcurso=0;
                                this.idperiodo = 0;
                                this.nombre_alumno='';
                                this.nombre_materia='';
                                this.calificacion= '';
                                this.asistencia = '';
                                this.conducta = '';
                                this.fecha = '';
                                this.tipoAccion = 3;
                                break;
                            }
                        */
                            case 'actualizar':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Sesion';
                                this.tipoAccion=2;
                                this.sesion_id=data['id'];
                                this.idalumno=data['idalumno'];
                                this.state.materia=data['idmateria'];
                                this.state.curso=data['idcurso'];
                                this.idperiodo= data['idperiodo'];
                                this.calificacion = data['calificacion'];
                                this.asistencia= data['asistencia'];
                                this.conducta= data['conducta'];
                                this.fecha= data['fecha'];
                                break;
                            }
                             /*case 'actualizarFast':
                            {
                                console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Sesion';
                                this.tipoAccion=4;
                                this.sesion_id=data['id'];
                                this.idalumno=data['idalumno'];
                                this.idmateria=data['idmateria'];
                                this.idcurso=data['idcurso'];
                                this.idperiodo= data['idperiodo'];
                                this.calificacion = data['calificacion'];
                                this.asistencia= data['asistencia'];
                                this.conducta= data['conducta'];                                
                                this.fecha= data['fecha'];
                                break;
                            }*/
                        }
                    }
                }
                //this.selectAlumno();
                //this.selectMateria();
                //this.selectPeriodo();
                 //this.selectCurso();
            }
        },
        mounted() {
            this.listarSesion(1,this.buscar,this.criterio);
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