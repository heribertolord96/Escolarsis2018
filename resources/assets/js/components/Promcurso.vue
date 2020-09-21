<template>
            <main class="main">
            <!-- Breadcrumb -->
           <ol class="breadcrumb">
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card"> 
                 <div class="card-header">
                        <i class="fa fa-align-justify"></i> Promedio / Curso
                        <button type="button" @click="cargarPdf()" class="btn btn-secondary">
                            <i class="icon-printer"></i>
                        </button>
                    </div>                   
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="alumnos.nombre">Nombre</option>
                                      <option value="cursos.nombre">Curso</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPromcurso(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPromcurso(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <!--th>Opciones</th-->
                                     <th>Alumno</th>
                                     <th>Curso</th>                                    
                                     <th>Calificacion</th>
                                     <th>Asistencias</th>
                                     <th>Conducta</th>
                                    <!--th>Estado</th-->
                                </tr>                                
                            </thead>
                            <tbody>
                                <tr v-for="sesion in arraySesion" :key="sesion.id">                                                                        
                                    <td v-text="sesion.alumno_nombre"></td>
                                    <td v-text="sesion.cursonombre"></td>                                                                
                                    <td v-text="sesion.promedio_calif"></td>
                                    <td v-text="sesion.t_asistencias"></td>
                                    <td v-text="sesion.prom_conducta"></td>
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
                sesion_id: 0,
                idalumno : 0,
                idperiodo : 0,
                idmateria : 0,
                idcurso:0,
                alumno_nombre : '',
                cursonombre : '',
                //materia_nombre : '',
                //crpromedio : '',                
                //nombre_periodo : '',
                arraySesion : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorSesion : 0,
               
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
                criterio : 'nombre',
                buscar : '',
                arrayAlumno :[],
               arrayMateria :[],
               arrayPeriodo :[]
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
            listarPromcurso (page,buscar,criterio){
                let me=this;
                var url=  '/promcurso?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraySesion = respuesta.sesions.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                   console.table(error);
                });
            },
                  cargarPdf(){
                     window.open('http://localhost:8000/promcurso/listarPdf','_blank');
                  },   
                    cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPromcurso(page,buscar,criterio);
            }, 
        },
         
        mounted() {
            this.listarPromcurso(1,this.buscar,this.criterio);
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
