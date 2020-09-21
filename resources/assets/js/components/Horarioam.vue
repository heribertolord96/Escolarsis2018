<template>
   <main class="main">
      <!-- Breadcrumb -->
      <ol class="breadcrumb">
      </ol>
      <div class="container-fluid">
         <!-- Ejemplo de tabla Listado -->
         <div class="card">
            <div class="card-header">
               <i class="fa fa-align-justify"></i> Horarios
               
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <div class="col-md-6">
                     <div class="input-group">
                        <select class="form-control col-md-3" v-model="criterio">
                           <option value="horarios.nombre">Nombre</option>
                           <option value="horarios.descripcion">Descripción</option>
                           <option value="cursos.nombre">Curso</option>
                        </select>
                        <input type="text" v-model="buscar" @keyup.enter="listarHorario(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                        <button type="submit" @click="listarHorario(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="card"  v-for="horario in arrayHorario" :key="horario.id" style="border: 5px solid black; overflow-x:auto; border:solid ; min-width:80%">
                     <div class="card-header">
                        
                        <td v-text ="horario.nombre" style="float: right;"></td>
                     </div>
                     <div class="card-body" v-html ="horario.descripcion"></div>
                     <div class="card-footer" v-text="horario.nombre_curso" style="float: right;"></div>
                  </div>
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
               horario_id: 0,
               idcurso : 0,
               //idpersona : 0,
               idhorario : 0,
               nombre_curso : '',
               //nombre_persona : '',
               nombre : '',
               descripcion : '',
               arrayHorario : [],
               modal : 0,
               tituloModal : '',
               tipoAccion : 0,
               errorHorario : 0,
              
               errorMostrarMsjHorario : [],
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
               arrayCurso :[]
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
           listarHorario (page,buscar,criterio){
               let me=this;
               var url= '/horario?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
               axios.get(url).then(function (response) {
                   var respuesta = response.data;
                   me.arrayHorario = respuesta.horarios.data;
                   me.pagination = respuesta.pagination;
               })
               .catch(function (error) {
                  console.table(error);
               });
           },
           cargarHorario(){
                     window.open('http://localhost:8000/Horario/horariospdf','_blank');
                 },  
           
           cambiarPagina(page,buscar,criterio){
               let me = this;
               //Actualiza la página actual
               me.pagination.current_page = page;
               //Envia la petición para visualizar la data de esa página
               me.listarHorario(page,buscar,criterio);
           },
           
       },
       mounted() {
           this.listarHorario(1,this.buscar,this.criterio);
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