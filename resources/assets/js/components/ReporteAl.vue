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
                                    <th>Alumno</th>
                                    <th>Asunto</th><!--nombre caso-->
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="reporte in arrayReporte" :key="reporte.id">
                                    
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
                 

            
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarReporte(page,buscar,criterio);
            },
           
            validarReporte(){
                this.errorReporte=0;
                this.errorMostrarMsjReporte =[];

                if (this.idalumno==0) this.errorMostrarMsjReporte.push("Seleccione el alumno");
                if (!this.nombre) this.errorMostrarMsjReporte.push("El nombre  no puede estar vacío.");
                if (!this.fecha) this.errorMostrarMsjSesion.push("Seleccione fecha del evento.");
                if (this.errorMostrarMsjReporte.length) this.errorReporte = 1;

                return this.errorReporte;
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
