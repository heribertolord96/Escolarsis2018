<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Colegio Universitario de Yahualica</title>
      <!-- Bootstrap CSS -->
      <link href="css/plantillalandin.css" rel="stylesheet">
      <link href="css/plantilla.css" rel="stylesheet">
   </head>
   <body>
      <!-- Header Area wrapper Starts -->
      <header id="header-wrap">
         <!--new nav-->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <style>
            body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            }
            .topnav {
            display: block;
            overflow: hidden;
            background-color: #333;
           position:fixed;
           z-index:3;
           width:100%;
            }
            .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            
            }
            .topnav a:hover {
            background-color: #ddd;
            color: black;
            }
            .active {
            background-color: #4CAF50;
            color: white;
            }
            .topnav .icon {
            display: none;
            }
            @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
            float: right;
            display: block;
            }
            }
            @media screen and (max-width: 600px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
            }
            .topnav.responsive a {
               
            float: none;
            display: block;
            text-align: left;
            }
            }
         </style>
         <script>
            function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
             x.className += " responsive";
            } else {
             x.className = "topnav";
            }
            }
            function loadmodal() {
            var x = document.getElementById("#myModal");
            if (x.className === "topnav") {
             x.className += " responsive";
            } else {
             x.className = "topnav";
            }
            }
         </script>
         <div class="topnav" id="myTopnav">
            <a href="#hero-area" class="active">
            <img src="img/avatars/logo9.png" alt="" width="30" height="30">
            </a>
            <a href="#hero-area">Bienvenidos!</a>
            <a href="#about">La universidad</a>
            <a href="#services">Aspirantes</a>
            <a href="#resume">Oferta academica</a>
            <a href="#portfolios"> Vinculacion</a>
            <a href="#contact"> Contacto</a>
            <a href="myModal" data-toggle="modal" data-target="#myModal">
            <img src="img/favicon.png" alt="" width="30" height="30">
            Plataforma SCMS
            </a> 
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
            </a>
         </div>
         <!--new nav-->
         <!--modal-->
         <div class="container">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            <!-- Button to Open the Modal 
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                 Open modal
               </button>-->
            <!-- The Modal -->
            <div class="modal" id="myModal">
               <div class="modal-dialog">
                  <div class="modal-content" style="background-image: url('../img/backcampus.jpg');  
                  background-size: cover; position: relative;">
                     <!-- Modal Header -->
                     <div class="modal-header" style="background-image: url('../img/logo.png');  
                     background-size: 85% 85px; background-position: center top; width:auto;
                     background-color: rgba(28, 78, 35, 0.582);height:90px; background-repeat: no-repeat;">
                        <h4 class="modal-title" style="position:center bottom;">
                                                </h4>SCMS
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <!-- Modal body -->
                     <div class="modal-body">
                        <div class="card p-4" style=" background-color: #18b1b162;
                           background-clip: border-box;
                           border-radius:5px 0px 0px 5px; box-shadow: 0px 0px 15px 15px #2344da88;">
                           <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
                              {{ csrf_field() }}
                              <div class="card-body">
                                 <h1>Acceder</h1>
                                 <p class="text-muted"><b>Control de acceso al sistema</b></p>
                                 <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                                    <span class="input-group-addon"><i class="icon-user"></i></span>
                                    <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                                    {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                                 </div>
                                 <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                                    <span class="input-group-addon"><i class="icon-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                                 </div>
                                 <div class="row">
                                    <div class="col-6">
                                       <center>
                                          <button type="submit" class="btn btn-success px-4">Acceder</button>
                                       </center>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <!-- Modal footer -->
                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--modal-->
         <!-- Hero Area Start -->
         <div id="hero-area" class="hero-area-bg">
            <div class="overlay"></div>
            <div class="container">
               <div class="row">
                  <div class="col-md-12 col-sm-12 text-center">
                     <div class="contents">
                        <h5 class="script-font wow fadeInUp" data-wow-delay="0.2s">Bienvenido</h5>
                        <h2 class="head-title wow fadeInUp" data-wow-delay="0.4s">Colegio universitario de yahualica</h2>
                        <p class="script-font wow fadeInUp" data-wow-delay="0.6s">Campus san francisco del rincon Gto.</p>
                        <ul class="social-icon wow fadeInUp" data-wow-delay="0.8s">
                           <li>
                              <a class="facebook" href="https://www.facebook.com/ColegioUniversitarioDeYahualica/">
                              <i class="icon-social-facebook"></i></a>
                           </li>
                           <li>
                              <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                           </li>
                           <li>
                              <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
                           </li>
                           <li>
                              <a class="linkedin" href="#"><i class="icon-social-linkedin"></i></a>
                           </li>
                           <li>
                              <a class="google" href="#"><i class="icon-social-google"></i></a>
                           </li>
                        </ul>
                        <!--div class="header-button wow fadeInUp" data-wow-delay="1s">
                           <a href="#" class="btn btn-common">Get a Free Quote</a>
                           </div-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Hero Area End -->
      </header>
      <!-- Header Area wrapper End -->
      <!-- About Section Start -->
      <section id="about" class="section-padding" style="background-color:#000000">
         <div class="container" >
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
    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="row" >
            <div class="col-md-3">
              <div class="flex-container">
              <h3>Mision</h3>
              
              </div>
          </div>
           <div class="col-md-3">
              <div class="flex-container">
              <h3>Vision</h3>
              </div>
          </div>
           <div class="col-md-3">
              <div class="flex-container">
              <h3>Valores</h3>
              </div>
          </div>
          </div>
      </div>
    </section>
        </main>
         </div>
      </section>
      <!-- About Section End -->
      <!-- Services Section Start -->
      <center>
         <section id="services" class="services section-padding">
            <h2 class="section-title wow flipInX" data-wow-delay="0.4s">Aspirantes</h2>
            <div class="container">
               <div class="row">
                  <!-- Services item -->
                  <div class="col-md-6 col-lg-3 col-xs-12">
                     <div class="services-item wow fadeInDown" data-wow-delay="0.3s">
                        <div class="icon">
                           <i class="icon-grid"></i>
                        </div>
                        <div class="services-content">
                           <h3><a href="#">Maestria</a></h3>
                           <p>Requisitos para inscribirte a una maestria</p>
                        </div>
                     </div>
                  </div>
                  <!-- Services item -->
                  <div class="col-md-6 col-lg-3 col-xs-12">
                     <div class="services-item wow fadeInDown" data-wow-delay="0.6s">
                        <div class="icon">
                           <i class="icon-layers"></i>
                        </div>
                        <div class="services-content">
                           <h3><a href="#">Licenciatura o ingenieria</a></h3>
                           <p>Requisitos pata insribirse a una licenciatura o ingenieria</p>
                        </div>
                     </div>
                  </div>
                  <!-- Services item -->
                  <div class="col-md-6 col-lg-3 col-xs-12">
                     <div class="services-item wow fadeInDown" data-wow-delay="0.9s">
                        <div class="icon">
                           <i class="icon-briefcase"></i>
                        </div>
                        <div class="services-content">
                           <h3><a href="#">Preparatoria</a></h3>
                           <p>Requisitos pata insribirse a preparatoria</p>
                        </div>
                     </div>
                  </div>
                  <!-- Services item -->
                  <!--div class="col-md-6 col-lg-3 col-xs-12">
                     <div class="services-item wow fadeInDown" data-wow-delay="1.2s">
                        <div class="icon">
                           <i class="icon-bubbles"></i>
                        </div>
                        <div class="services-content">
                           <h3><a href="#">Consultancy</a></h3>
                           <p>Requisitos pata insribirse a una licenciatura o ingenieria</p>
                        </div>
                     </div>
                     </div-->
               </div>
            </div>
         </section>
      </center>
      <!-- Services Section End -->
      <!-- Resume Section Start -->
      <div id="resume" class="section-padding">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="education wow fadeInRight" data-wow-delay="0.3s">
                     <ul class="timeline">
                        <li>
                           <i class="icon-graduation"></i>
                           <h2 class="timelin-title">Educacion superior</h2>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Licenciaturas</h3>
                              <span>3 años</span>
                              <p class="line-text">loremipsum dolor sit amet</p>
                           </div>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Ingenierias</h3>
                              <span>3 años</span>
                              <p class="line-text">lorem ipsum dolor sit amet.</p>
                           </div>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Maestrias</h3>
                              <span>4 años</span>
                              <p class="line-text">lorem ipsum dolor sit amet.</p>
                           </div>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Doctorados</h3>
                              <span>5 años</span>
                              <p class="line-text">lorem ipsum dolor sit amet.</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="experience wow fadeInRight" data-wow-delay="0.6s">
                     <ul class="timeline">
                        <li>
                           <i class="icon-graduation"></i>
                           <h2 class="timelin-title">Educacion media</h2>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Preparatoria</h3>
                              <span>2 años</span>
                              <p class="line-text">lorem ipsum dolor sit amet.</p>
                           </div>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Bachillerato</h3>
                              <span>2 años</span>
                              <p class="line-text">lorem ipsum dolor sit amet.</p>
                           </div>
                        </li>
                        <li>
                           <div class="content-text">
                              <h3 class="line-title">Secundaria</h3>
                              <span>1 año</span>
                              <p class="line-text">lorem ipsum dolor sit amet.</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Resume Section End -->
      <!-- Portfolio Section -->
      <section id="portfolios" class="section-padding">
         <!-- Container Starts -->
         <div class="container">
            <h2 class="section-title wow flipInX" data-wow-delay="0.4s">Vinculacion</h2>
            <div class="row">
               <div class="col-md-12">
                  <!-- Portfolio Controller/Buttons -->
                  <div class="controls text-center">
                     <a class="filter active btn btn-common" data-filter="all">
                     Todos 
                     </a>
                     <a class="filter btn btn-common" data-filter=".design">
                     Actividades 
                     </a>
                     <a class="filter btn btn-common" data-filter=".development">
                     Eventos
                     </a>
                     <a class="filter btn btn-common" data-filter=".print">
                     Servicio social
                     </a>
                  </div>
                  <!-- Portfolio Controller/Buttons Ends-->
               </div>
               <!-- Portfolio Recent Projects -->
               <div id="portfolio" class="row wow fadeInDown" data-wow-delay="0.4s">
                  <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development print">
                     <div class="portfolio-item">
                        <div class="shot-item">
                           <img src="img/gallery/img-1.jpg" alt="" />  
                           <div class="overlay">
                              <div class="icons">
                                 <a class="lightbox preview" href="img/gallery/img-1.jpg">
                                 <i class="icon-eye"></i>
                                 </a>
                                 <a class="link" href="#">
                                 <i class="icon-link"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix design print">
                     <div class="portfolio-item">
                        <div class="shot-item">
                           <img src="img/gallery/img-2.jpg" alt=""/> 
                           <div class="overlay">
                              <div class="icons">
                                 <a class="lightbox preview" href="img/gallery/img-2.jpg">
                                 <i class="icon-eye"></i>
                                 </a>
                                 <a class="link" href="#">
                                 <i class="icon-link"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development">
                     <div class="portfolio-item">
                        <div class="shot-item">
                           <img src="img/gallery/img-3.jpg" alt=""/> 
                           <div class="overlay">
                              <div class="icons">
                                 <a class="lightbox preview" href="img/gallery/img-3.jpg">
                                 <i class="icon-eye"></i>
                                 </a>
                                 <a class="link" href="#">
                                 <i class="icon-link"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development design">
                     <div class="portfolio-item">
                        <div class="shot-item">
                           <img src="img/gallery/img-4.jpg" alt="" /> 
                           <div class="overlay">
                              <div class="icons">
                                 <a class="lightbox preview" href="img/gallery/img-4.jpg">
                                 <i class="icon-eye"></i>
                                 </a>
                                 <a class="link" href="#">
                                 <i class="icon-link"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development">
                     <div class="portfolio-item">
                        <div class="shot-item">
                           <img src="img/gallery/img-5.jpg" alt="" /> 
                           <div class="overlay">
                              <div class="icons">
                                 <a class="lightbox preview" href="img/gallery/img-5.jpg">
                                 <i class="icon-eye"></i>
                                 </a>
                                 <a class="link" href="#">
                                 <i class="icon-link"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix print design">
                     <div class="portfolio-item">
                        <div class="shot-item">
                           <img src="img/gallery/img-6.jpg" alt=""/>
                           <div class="overlay">
                              <div class="icons">
                                 <a class="lightbox preview" href="img/gallery/img-6.jpg">
                                 <i class="icon-eye"></i>
                                 </a>
                                 <a class="link" href="#">
                                 <i class="icon-link"></i>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Container Ends -->
      </section>
      <!-- Portfolio Section Ends --> 
      <!-- Counter Area Start-->
      <section class="counter-section section-padding">
         <div class="container">
            <div class="row">
               <!-- Counter Item -->
               <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                  <div class="counter wow fadeInDown" data-wow-delay="0.3s">
                     <div class="icon"><i class="icon-briefcase"></i></div>
                     <div class="counterUp">90</div>
                     <p>Maestros </p>
                  </div>
               </div>
               <!-- Counter Item -->
               <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                  <div class="counter wow fadeInDown" data-wow-delay="0.6s">
                     <div class="icon"><i class="icon-check"></i></div>
                     <div class="counterUp">950</div>
                     <p>Egresados</p>
                  </div>
               </div>
               <!-- Counter Item -->
               <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                  <div class="counter wow fadeInDown" data-wow-delay="0.9s">
                     <div class="icon"><i class="icon-diamond"></i></div>
                     <div class="counterUp">945</div>
                     <p>Titulados</p>
                  </div>
               </div>
               <!-- Counter Item -->
               <div class="col-md-3 col-sm-6 work-counter-widget text-center">
                  <div class="counter wow fadeInDown" data-wow-delay="1.2s">
                     <div class="icon"><i class="icon-bulb"></i></div>
                     <div class="counterUp">3299</div>
                     <p>Matricula actual</p>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Counter Area End-->
      <!-- Contact Section Start -->
      <section id="contact" class="section-padding">
         <div class="contact-form">
            <div class="container">
               <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.4s">
                  <div class="col-md-6 col-lg-6 col-sm-12">
                     <div class="contact-block">
                        <h2>Redes sociales</h2>
                        <form id="contactForm">
                           <div class="row">
                           <section class="lazy-load-box effect-fade" data-delay="400" data-speed="800" style="-webkit-transition: all 800ms ease; -moz-transition: all 800ms ease; -ms-transition: all 800ms ease; -o-transition: all 800ms ease; transition: all 800ms ease;">

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/ColegioUniversitarioDeYahualica/" data-tabs="timeline" data-width="340" data-height="35 0" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=370&amp;height=500&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FColegioUniversitarioDeYahualica%2F&amp;locale=es_LA&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline&amp;width=340"><span style="vertical-align: bottom; width: 340px; height: 500px;"><iframe name="f376e360bbac9ac" width="340px" height="500px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" title="fb:page Facebook Social Plugin" src="https://www.facebook.com/v2.5/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2Fj-GHT1gpo6-.js%3Fversion%3D43%23cb%3Df21decbbc40512c%26domain%3Dwww.colegiodeyahualica.edu.mx%26origin%3Dhttp%253A%252F%252Fwww.colegiodeyahualica.edu.mx%252Ff2749bb3d6fc6ec%26relation%3Dparent.parent&amp;container_width=370&amp;height=500&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FColegioUniversitarioDeYahualica%2F&amp;locale=es_LA&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline&amp;width=340" style="border: none; visibility: visible; width: 340px; height: 500px;" class=""></iframe></span></div>
<br>
<br>
<div class="linea"></div>   

</section>
                           </div>
                        </form>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-sm-12">
                     <div class="footer-right-area wow fadeIn">
                        <h2>Direccion de contacto</h2>
                        <div class="footer-right-contact">
                           <div class="single-contact">
                              <div class="contact-icon">
                                 <i class="fa fa-map-marker"></i>
                              </div>
                              <p>San Francisco, CA</p>
                           </div>
                           <div class="single-contact">
                              <div class="contact-icon">
                                 <i class="fa fa-envelope"></i>
                              </div>                             
                              <p><a href="mailto:heribertolord@gmail.com">informes@colegiodeyahualica.edu.mx</a></p>
                           </div>
                           <div class="single-contact">
                              <div class="contact-icon">
                                 <i class="fa fa-phone"></i>
                              </div>
                              <p><a href="#">+ (00) 123 456 789</a></p>
                              <p><a href="#">+ (00) 123 344 789</a></p>
                           </div>
                        </div>
                     </div>
                     
                  </div>
                  
                  <div class="col-md-12">
                     <object style="border:0; height: 450px; width: 100%;" 
                     data="https://www.google.com/maps/embed/v1/place?q=colegio%20universitario%20de%20yahualica&key=AIzaSyAntrfChO69hXRPmRDJRuuMcthDxbsVHLc"></object>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Contact Section End -->
      <!-- Footer Section Start -->
      <footer class="footer-area section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="footer-text text-center wow fadeInDown" data-wow-delay="0.3s">
                     <ul class="social-icon">
                        <li>
                           <a class="facebook" href="https://www.facebook.com/ColegioUniversitarioDeYahualica/">
                           <i class="icon-social-facebook"></i></a>
                        </li>
                        <li>
                           <a class="twitter" href="#"><i class="icon-social-twitter"></i></a>
                        </li>
                        <li>
                           <a class="instagram" href="#"><i class="icon-social-instagram"></i></a>
                        </li>
                        <li>
                           <a class="instagram" href="#"><i class="icon-social-linkedin"></i></a>
                        </li>
                        <li>
                           <a class="instagram" href="#"><i class="icon-social-google"></i></a>
                        </li>
                     </ul>
                     <p>Copyright ©  Colegio Universitario de yahualica SCMS 2018  All Right Reserved</p>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer Section End -->
      <!-- Go to Top Link -->
      <a href="#" class="back-to-top">
      <i class="icon-arrow-up"></i>
      </a>
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/plantillalandin.js"></script>  
      <script src="js/plantilla.js"></script>      
   </body>
</html>