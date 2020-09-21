<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Carga Academica
                       <!-- <button type="button" @click="abrirModal('matricula','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>    -->                    
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="alumnos.nombre">Alumno</option>
                                      <option value="cursos.nombre">Curso</option>
                                      <option value="grupos.nombre">Grupo</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarMatricula(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMatricula(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div style="overflow-x:auto; border:solid ; min-width:80%" >
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>                               
                                    <th>Alumno</th>
                                    <th>Grupo</th>
                                    <th>Curso</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                           
                                <tr v-for="alumno in arrayAlumno" :key="alumno.id">                                                                                                    
                                    <td v-text="alumno.nombre_alumno"></td>
                                    <td v-text="alumno.nombre_grupo"></td>
                                    <td v-text="alumno.nombre_curso"></td>
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
            listarMatricula (page,buscar,criterio){
                let me=this;
                var url=  '/matricula?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayAlumno = respuesta.alumnos.data;
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
                me.listarMatricula(page,buscar,criterio);
            }
        },
        mounted() {
            this.listarMatricula(1,this.buscar,this.criterio);
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
