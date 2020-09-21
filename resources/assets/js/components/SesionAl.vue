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
                        <i class="fa fa-align-justify"></i> Sesiones
                       
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
            },
               

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarSesion(page,buscar,criterio);
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
