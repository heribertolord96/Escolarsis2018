<div class="sidebar"><!--maestro-->
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li  @click="menu=0" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                   
                    <li @click="menu=22" class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon-home"></i> Escuela</a>
                    </li>
               
               <li class="nav-item nav-dropdown">
                  <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i>Alumnos</a>
                  <ul class="nav-dropdown-items">
                     <!--li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-list"></i> Alumnos</a>
                     </li-->
                        <li @click="menu=17" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-list"></i> Matricula</a>                                
                     </li>
                  </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-graduation"></i> Cursos</a>
            <ul class="nav-dropdown-items">
            <li @click="menu=4" class="nav-item">
                  <a class="nav-link" href="#"><i class="icon-graduation"></i> Cursos</a>
               </li>
               <li @click="menu=3" class="nav-item">
                  <a class="nav-link" href="#"><i class="icon-notebook"></i> Materias</a>
               </li>
                              <li @click="menu=7" class="nav-item">
                  <a class="nav-link" href="#"><i class="icon-calendar"></i> Periodos</a>
               </li>
            </ul>
         </li>
         <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-cup"></i> Maestro</a>
            <ul class="nav-dropdown-items">
            <li @click="menu=21" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-note"></i> Reportes</a>                                
                     </li>
               <li @click="menu=5" class="nav-item">
                  <a class="nav-link" href="#"><i class="icon-note"></i> Sesion</a>
               </li>
               <li class="nav-item nav-dropdown">
                  <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-chart"></i> Promedios</a>
                  <ul class="nav-dropdown-items">
                     <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i>Materias</a><!--Promedio Materias-->
                     </li>
                     </button>
                     <li @click="menu=13" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-chart"></i>Cursos</a><!--Promedio Materias-->
                     </li>
                  </ul>
               </li>
            </ul>
         </li>
                    
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li @click="menu=8" class="nav-item">
                                <a class="nav-link" href="#"><i class="icon-user"></i> Usuario</a>
                            </li>                           
                        </ul>
                    </li>
                    <li @click="menu=18" class="nav-item">
            <a class="nav-link" href="#"><i class="icon-wallet"></i> Horarios <span class="badge badge-danger">00:00</span></a>
         </li>
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-book-open"></i> Ayuda <span class="badge badge-danger">PDF</span></a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>