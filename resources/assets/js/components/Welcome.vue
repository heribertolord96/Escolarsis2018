<template>
            <main class="main">
    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('../img/campus2.jpg')">

            <div class="carousel-caption d-none d-md-block">
              <h3>Areas recreativas</h3>
              <p>Mantengamos limpias las areas verdes.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('../img/qimlab.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Laboratorios </h3>
              <p>Instalaciones remodeladas.</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('../img/students.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Curso diseño web avanzdo</h3>
              <p>Curso diseño web avanzado, aierto para cualquier carrera.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="row" >
            <div class="col-md-3">
              <div class="flex-container">
              <h3>Noticias</h3>
              </div>
          </div>
           <div class="col-md-3">
              <div class="flex-container">
              <h3>Eventos</h3>
              </div>
          </div>
           <div class="col-md-3">
              <div class="flex-container">
              <h3>Actividades</h3>
              </div>
          </div>
          </div>
      </div>
    </section>
        </main>
        
</template>
  
 

<style>    
   .carousel-item {
  height: 100vh;
  min-height: 300px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.flex-container {
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
   
</style>

