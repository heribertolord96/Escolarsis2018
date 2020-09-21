<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@loadlandin');
    //Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Maestro']], function () {
         //categoria
         Route::get('/categoria', 'CategoriaController@index');
     //categoria
     //materia
         Route::get('/materia', 'MateriaController@index');
         Route::post('/materia/registrar', 'MateriaController@store');
         Route::put('/materia/actualizar', 'MateriaController@update');
         Route::put('/materia/desactivar', 'MateriaController@desactivar');
         Route::put('/materia/activar', 'MateriaController@activar');
         Route::get('/materia/buscarMateria', 'MateriaController@buscarMateria');
         Route::get('/materia/listarMateria', 'MateriaController@listarMateria');
         Route::get('/materia/selectMateria', 'MateriaController@selectMateria');
         Route::put('/materia/destroy', 'MateriaController@destroy');            
     //materia
     //curso
         Route::get('/curso', 'CursoController@index');
         Route::post('/curso/registrar', 'CursoController@store');
         Route::put('/curso/actualizar', 'CursoController@update');
         Route::put('/curso/desactivar', 'CursoController@desactivar');
         Route::put('/curso/activar', 'CursoController@activar');
         Route::get('/curso/buscarCurso', 'MateriaController@buscarCurso');
         Route::get('/curso/listarCurso', 'CursoController@listarCurso');
         Route::get('/curso/selectCurso', 'CursoController@selectCurso');
         Route::put('/curso/destroy', 'CursoController@destroy');           
     //curso
     //Grupo
         Route::get('/grupo', 'GrupoController@index');
         Route::post('/grupo/registrar', 'GrupoController@store');
         Route::put('/grupo/actualizar', 'GrupoController@update');
         Route::put('/grupo/desactivar', 'GrupoController@desactivar');
         Route::put('/grupo/activar', 'GrupoController@activar');            
         Route::get('/grupo/listarCurso', 'GrupoController@listarCurso');
         Route::get('/grupo/selectCurso', 'GrupoController@selectCurso');
         Route::put('/grupo/destroy', 'GrupoController@destroy');           
     //Grupo
     //Reporte
         Route::get('/reporte', 'ReporteController@index');
         Route::post('/reporte/registrar', 'ReporteController@store');
         Route::put('/reporte/actualizar', 'ReporteController@update');
         Route::put('/reporte/desactivar', 'ReporteController@desactivar');
         Route::put('/reporte/activar', 'ReporteController@activar');            
         Route::get('/reporte/listarCurso', 'ReporteController@listarCurso');
         Route::get('/reporte/selectCurso', 'ReporteController@selectCurso');
         Route::put('/reporte/destroy', 'ReporteController@destroy');           
     //Reporte
    
     //sesion
         Route::get('/sesion', 'SesionController@index');
         Route::post('/sesion/registrar', 'SesionController@store');
         Route::put('/sesion/actualizar', 'SesionController@update');
         Route::put('/sesion/desactivar', 'SesionController@desactivar');     
         Route::put('/sesion/destroy', 'SesionController@destroy');
         Route::put('/sesion/activar', 'SesionController@activar');      
         Route::get('/sesion/listarAlumno', 'SesionController@listarAlumno');
         
     //sesion
     //periodo
         Route::get('/periodo', 'PeriodoController@index');
         Route::post('/periodo/registrar', 'PeriodoController@store');
         Route::put('/periodo/actualizar', 'PeriodoController@update');
         Route::put('/periodo/desactivar', 'PeriodoController@desactivar');     
         Route::put('/periodo/destroy', 'PeriodoController@destroy');
         Route::put('/periodo/activar', 'PeriodoController@activar');     
         Route::get('/periodo/selectMateria', 'PeriodoController@selectMateria');
         Route::get('/periodo/selectPeriodo', 'PeriodoController@selectPeriodo');
         
     //periodo
     //Promedio
        Route::get('/promedio', 'PromedioController@index');
        Route::get('/promedio/listarPromedio', 'promedioController@listarPromedio');
        Route::get('/promedio/listarPdf', 'promedioController@listarPdf')->name('promedios_pdf');

         Route::get('/promcurso', 'PromcursoController@index');
         Route::get('/promcurso/listarPromcurso', 'PromcursoController@listarPromcurso');
         Route::get('/promcurso/listarPdf', 'PromcursoController@listarPdf')->name('promcursos_pdf');
         Route::get('/dashboard', 'DashboardController@__invoke');
     //Promedio
     //Chained dropdown
        Route::get('/chained/curso', 'ChainedController@curso');
        Route::get('/chained/materia', 'ChainedController@materia');
        Route::get('/chained/periodo', 'ChainedController@periodo');
        Route::get('/chained/alumno', 'ChainedController@alumno');
     //Chained dropdown
     //Matricula
         Route::get('/matricula', 'MatriculaController@index');
         Route::post('/matricula/registrar', 'MatriculaController@store');
         Route::put('/matricula/actualizar', 'MatriculaController@update');
         Route::put('/matricula/desactivar', 'MatriculaController@desactivar');
         Route::put('/matricula/activar', 'MatriculaController@activar');            
         Route::get('/matricula/listarMatricula', 'MatriculaController@listarMatricula');
         Route::put('/matricula/destroy', 'MatriculaController@destroy');
         Route::get('/matricula/selectMatricula', 'MatriculaController@selectMatricula');
     //Matricula
     //Carga
         Route::get('/carga', 'CargaController@index');
         //Route::post('/carga/registrar', 'CargaController@store');
         //Route::put('/carga/actualizar', 'CargaController@update');
         //Route::put('/carga/desactivar', 'CargaController@desactivar');
         //Route::put('/carga/activar', 'CargaController@activar');            
         Route::get('/carga/listarCarga', 'CargaController@listarCarga');
         Route::put('/carga/destroy', 'CargaController@destroy');
         Route::get('/carga/selectMatricula', 'CargaController@selectMatricula');
     //Carga
     //horario
         Route::get('/horario', 'HorarioController@index');
         Route::post('/horario/registrar', 'HorarioController@store');
         Route::put('/horario/actualizar', 'HorarioController@update');
         Route::put('/horario/desactivar', 'HorarioController@desactivar');
         Route::put('/horario/activar', 'HorarioController@activar');
         Route::get('/horario/buscarHorario', 'HorarioController@buscarHorario');
         Route::get('/horario/listarHorario', 'HorarioController@listarHorario');
         Route::get('/horario/listarHorariopdf', 'HorarioController@listarHorariopdf')->name('horarios_pdf');
         Route::get('/horario/selectHorario', 'HorarioController@selectHorario');
         Route::put('/horario/destroy', 'HorarioController@destroy');
     //horario
    
    });
    Route::group(['middleware' => ['Alumno']], function () {
         //categoria
         Route::get('/categoria', 'CategoriaController@index');
     //categoria
     //materia
         Route::get('/materia', 'MateriaController@index');
         Route::post('/materia/registrar', 'MateriaController@store');
         Route::put('/materia/actualizar', 'MateriaController@update');
         Route::put('/materia/desactivar', 'MateriaController@desactivar');
         Route::put('/materia/activar', 'MateriaController@activar');
         Route::get('/materia/buscarMateria', 'MateriaController@buscarMateria');
         Route::get('/materia/listarMateria', 'MateriaController@listarMateria');
         Route::get('/materia/selectMateria', 'MateriaController@selectMateria');
         Route::put('/materia/destroy', 'MateriaController@destroy');            
     //materia
     //curso
         Route::get('/curso', 'CursoController@index');
         Route::post('/curso/registrar', 'CursoController@store');
         Route::put('/curso/actualizar', 'CursoController@update');
         Route::put('/curso/desactivar', 'CursoController@desactivar');
         Route::put('/curso/activar', 'CursoController@activar');
         Route::get('/curso/buscarCurso', 'MateriaController@buscarCurso');
         Route::get('/curso/listarCurso', 'CursoController@listarCurso');
         Route::get('/curso/selectCurso', 'CursoController@selectCurso');
         Route::put('/curso/destroy', 'CursoController@destroy');           
     //curso
     //Grupo
         Route::get('/grupo', 'GrupoController@index');
         Route::post('/grupo/registrar', 'GrupoController@store');
         Route::put('/grupo/actualizar', 'GrupoController@update');
         Route::put('/grupo/desactivar', 'GrupoController@desactivar');
         Route::put('/grupo/activar', 'GrupoController@activar');            
         Route::get('/grupo/listarCurso', 'GrupoController@listarCurso');
         Route::get('/grupo/selectCurso', 'GrupoController@selectCurso');
         Route::put('/grupo/destroy', 'GrupoController@destroy');           
     //Grupo
     //Reporte
         Route::get('/reporte', 'ReporteController@index');
         Route::post('/reporte/registrar', 'ReporteController@store');
         Route::put('/reporte/actualizar', 'ReporteController@update');
         Route::put('/reporte/desactivar', 'ReporteController@desactivar');
         Route::put('/reporte/activar', 'ReporteController@activar');            
         Route::get('/reporte/listarCurso', 'ReporteController@listarCurso');
         Route::get('/reporte/selectCurso', 'ReporteController@selectCurso');
         Route::put('/reporte/destroy', 'ReporteController@destroy');           
     //Reporte
    
     //sesion
         Route::get('/sesion', 'SesionController@index');
         Route::post('/sesion/registrar', 'SesionController@store');
         Route::put('/sesion/actualizar', 'SesionController@update');
         Route::put('/sesion/desactivar', 'SesionController@desactivar');     
         Route::put('/sesion/destroy', 'SesionController@destroy');
         Route::put('/sesion/activar', 'SesionController@activar');      
         Route::get('/sesion/listarAlumno', 'SesionController@listarAlumno');
         
     //sesion
     //periodo
         Route::get('/periodo', 'PeriodoController@index');
         Route::post('/periodo/registrar', 'PeriodoController@store');
         Route::put('/periodo/actualizar', 'PeriodoController@update');
         Route::put('/periodo/desactivar', 'PeriodoController@desactivar');     
         Route::put('/periodo/destroy', 'PeriodoController@destroy');
         Route::put('/periodo/activar', 'PeriodoController@activar');     
         Route::get('/periodo/selectMateria', 'PeriodoController@selectMateria');
         Route::get('/periodo/selectPeriodo', 'PeriodoController@selectPeriodo');
         
     //periodo
     //Promedio
        Route::get('/promedio', 'PromedioController@index');
        Route::get('/promedio/listarPromedio', 'promedioController@listarPromedio');
        Route::get('/promedio/listarPdf', 'promedioController@listarPdf')->name('promedios_pdf');

         Route::get('/promcurso', 'PromcursoController@index');
         Route::get('/promcurso/listarPromcurso', 'PromcursoController@listarPromcurso');
         Route::get('/promcurso/listarPdf', 'PromcursoController@listarPdf')->name('promcursos_pdf');
         Route::get('/dashboard', 'DashboardController@__invoke');
     //Promedio
     //Chained dropdown
        Route::get('/chained/curso', 'ChainedController@curso');
        Route::get('/chained/materia', 'ChainedController@materia');
        Route::get('/chained/periodo', 'ChainedController@periodo');
        Route::get('/chained/alumno', 'ChainedController@alumno');
     //Chained dropdown
     //Matricula
         Route::get('/matricula', 'MatriculaController@index');
         Route::post('/matricula/registrar', 'MatriculaController@store');
         Route::put('/matricula/actualizar', 'MatriculaController@update');
         Route::put('/matricula/desactivar', 'MatriculaController@desactivar');
         Route::put('/matricula/activar', 'MatriculaController@activar');            
         Route::get('/matricula/listarMatricula', 'MatriculaController@listarMatricula');
         Route::put('/matricula/destroy', 'MatriculaController@destroy');
         Route::get('/matricula/selectMatricula', 'MatriculaController@selectMatricula');
     //Matricula
     //Carga
         Route::get('/carga', 'CargaController@index');
         //Route::post('/carga/registrar', 'CargaController@store');
         //Route::put('/carga/actualizar', 'CargaController@update');
         //Route::put('/carga/desactivar', 'CargaController@desactivar');
         //Route::put('/carga/activar', 'CargaController@activar');            
         Route::get('/carga/listarCarga', 'CargaController@listarCarga');
         Route::put('/carga/destroy', 'CargaController@destroy');
         Route::get('/carga/selectMatricula', 'CargaController@selectMatricula');
     //Carga
     //horario
         Route::get('/horario', 'HorarioController@index');
         Route::post('/horario/registrar', 'HorarioController@store');
         Route::put('/horario/actualizar', 'HorarioController@update');
         Route::put('/horario/desactivar', 'HorarioController@desactivar');
         Route::put('/horario/activar', 'HorarioController@activar');
         Route::get('/horario/buscarHorario', 'HorarioController@buscarHorario');
         Route::get('/horario/listarHorario', 'HorarioController@listarHorario');
         Route::get('/horario/listarHorariopdf', 'HorarioController@listarHorariopdf')->name('horarios_pdf');
         Route::get('/horario/selectHorario', 'HorarioController@selectHorario');
         Route::put('/horario/destroy', 'HorarioController@destroy');
     //horario
    });

    Route::group(['middleware' => ['Administrador']], function () {
        //categoria
            Route::get('/categoria', 'CategoriaController@index');
            Route::post('/categoria/registrar', 'CategoriaController@store');
            Route::put('/categoria/actualizar', 'CategoriaController@update');
            Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
            Route::put('/categoria/activar', 'CategoriaController@activar');
            Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        //categoria
        //materia
            Route::get('/materia', 'MateriaController@index');
            Route::post('/materia/registrar', 'MateriaController@store');
            Route::put('/materia/actualizar', 'MateriaController@update');
            Route::put('/materia/desactivar', 'MateriaController@desactivar');
            Route::put('/materia/activar', 'MateriaController@activar');
            Route::get('/materia/buscarMateria', 'MateriaController@buscarMateria');
            Route::get('/materia/listarMateria', 'MateriaController@listarMateria');
            Route::get('/materia/selectMateria', 'MateriaController@selectMateria');
            Route::put('/materia/destroy', 'MateriaController@destroy');            
        //materia
        //curso
            Route::get('/curso', 'CursoController@index');
            Route::post('/curso/registrar', 'CursoController@store');
            Route::put('/curso/actualizar', 'CursoController@update');
            Route::put('/curso/desactivar', 'CursoController@desactivar');
            Route::put('/curso/activar', 'CursoController@activar');
            Route::get('/curso/buscarCurso', 'MateriaController@buscarCurso');
            Route::get('/curso/listarCurso', 'CursoController@listarCurso');
            Route::get('/curso/selectCurso', 'CursoController@selectCurso');
            Route::put('/curso/destroy', 'CursoController@destroy');           
        //curso
        //Grupo
            Route::get('/grupo', 'GrupoController@index');
            Route::post('/grupo/registrar', 'GrupoController@store');
            Route::put('/grupo/actualizar', 'GrupoController@update');
            Route::put('/grupo/desactivar', 'GrupoController@desactivar');
            Route::put('/grupo/activar', 'GrupoController@activar');            
            Route::get('/grupo/listarCurso', 'GrupoController@listarCurso');
            Route::get('/grupo/selectCurso', 'GrupoController@selectCurso');
            Route::put('/grupo/destroy', 'GrupoController@destroy');           
        //Grupo
        //Reporte
            Route::get('/reporte', 'ReporteController@index');
            Route::post('/reporte/registrar', 'ReporteController@store');
            Route::put('/reporte/actualizar', 'ReporteController@update');
            Route::put('/reporte/desactivar', 'ReporteController@desactivar');
            Route::put('/reporte/activar', 'ReporteController@activar');            
            Route::get('/reporte/listarCurso', 'ReporteController@listarCurso');
            Route::get('/reporte/selectCurso', 'ReporteController@selectCurso');
            Route::put('/reporte/destroy', 'ReporteController@destroy');           
        //Reporte
        //alumno
            Route::get('/alumno', 'AlumnoController@index');
            Route::post('/alumno/registrar', 'AlumnoController@store');
            Route::put('/alumno/actualizar', 'AlumnoController@update');
            Route::put('/alumno/desactivar', 'AlumnoController@desactivar');
            Route::put('/alumno/activar', 'AlumnoController@activar');            
            Route::get('/alumno/listarAlumno', 'AlumnoController@listarAlumno');
            Route::get('/alumno/selectAlumno', 'AlumnoController@selectAlumno');
            Route::put('/alumno/destroy', 'AlumnoController@destroy');
            Route::get('/alumno/selectGrupo', 'AlumnoController@selectGrupo');
        //alumno
        //sesion
            Route::get('/sesion', 'SesionController@index');
            Route::post('/sesion/registrar', 'SesionController@store');
            Route::put('/sesion/actualizar', 'SesionController@update');
            Route::put('/sesion/desactivar', 'SesionController@desactivar');     
            Route::put('/sesion/destroy', 'SesionController@destroy');
            Route::put('/sesion/activar', 'SesionController@activar');      
            Route::get('/sesion/listarAlumno', 'SesionController@listarAlumno');
            
        //sesion
        //periodo
            Route::get('/periodo', 'PeriodoController@index');
            Route::post('/periodo/registrar', 'PeriodoController@store');
            Route::put('/periodo/actualizar', 'PeriodoController@update');
            Route::put('/periodo/desactivar', 'PeriodoController@desactivar');     
            Route::put('/periodo/destroy', 'PeriodoController@destroy');
            Route::put('/periodo/activar', 'PeriodoController@activar');     
            Route::get('/periodo/selectMateria', 'PeriodoController@selectMateria');
            Route::get('/periodo/selectPeriodo', 'PeriodoController@selectPeriodo');
            
        //periodo
        //Promedio
           Route::get('/promedio', 'PromedioController@index');
           Route::get('/promedio/listarPromedio', 'promedioController@listarPromedio');
           Route::get('/promedio/listarPdf', 'promedioController@listarPdf')->name('promedios_pdf');

            Route::get('/promcurso', 'PromcursoController@index');
            Route::get('/promcurso/listarPromcurso', 'PromcursoController@listarPromcurso');
            Route::get('/promcurso/listarPdf', 'PromcursoController@listarPdf')->name('promcursos_pdf');
            Route::get('/dashboard', 'DashboardController@__invoke');
        //Promedio
        //Chained dropdown
           Route::get('/chained/curso', 'ChainedController@curso');
           Route::get('/chained/materia', 'ChainedController@materia');
           Route::get('/chained/periodo', 'ChainedController@periodo');
           Route::get('/chained/alumno', 'ChainedController@alumno');
        //Chained dropdown
        //Matricula
            Route::get('/matricula', 'MatriculaController@index');
            Route::post('/matricula/registrar', 'MatriculaController@store');
            Route::put('/matricula/actualizar', 'MatriculaController@update');
            Route::put('/matricula/desactivar', 'MatriculaController@desactivar');
            Route::put('/matricula/activar', 'MatriculaController@activar');            
            Route::get('/matricula/listarMatricula', 'MatriculaController@listarMatricula');
            Route::put('/matricula/destroy', 'MatriculaController@destroy');
            Route::get('/matricula/selectMatricula', 'MatriculaController@selectMatricula');
        //Matricula
        //Carga
            Route::get('/carga', 'CargaController@index');
            //Route::post('/carga/registrar', 'CargaController@store');
            //Route::put('/carga/actualizar', 'CargaController@update');
            //Route::put('/carga/desactivar', 'CargaController@desactivar');
            //Route::put('/carga/activar', 'CargaController@activar');            
            Route::get('/carga/listarCarga', 'CargaController@listarCarga');
            Route::put('/carga/destroy', 'CargaController@destroy');
            Route::get('/carga/selectMatricula', 'CargaController@selectMatricula');
        //Carga
        //horario
            Route::get('/horario', 'HorarioController@index');
            Route::post('/horario/registrar', 'HorarioController@store');
            Route::put('/horario/actualizar', 'HorarioController@update');
            Route::put('/horario/desactivar', 'HorarioController@desactivar');
            Route::put('/horario/activar', 'HorarioController@activar');
            Route::get('/horario/buscarHorario', 'HorarioController@buscarHorario');
            Route::get('/horario/listarHorario', 'HorarioController@listarHorario');
            Route::get('/horario/listarHorariopdf', 'HorarioController@listarHorariopdf')->name('horarios_pdf');
            Route::get('/horario/selectHorario', 'HorarioController@selectHorario');
            Route::put('/horario/destroy', 'HorarioController@destroy');
        //horario
        //rol
            Route::get('/rol', 'RolController@index');
            Route::get('/rol/selectRol', 'RolController@selectRol');
            Route::get('/user', 'UserController@index');
            Route::post('/user/registrar', 'UserController@store');
            Route::put('/user/actualizar', 'UserController@update');
            Route::put('/user/actualizaruser', 'UserController@updateuser');
            Route::put('/user/desactivar', 'UserController@desactivar');
            Route::put('/user/activar', 'UserController@activar');        
            Route::get('/user/selectPersona', 'UserController@selectPersona');
        //rol
    });

});
