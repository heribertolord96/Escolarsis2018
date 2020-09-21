
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//window.Vue = require('vue-router');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Components admin
    Vue.component('categoria', require('./components/Categoria.vue'));
    Vue.component('materia', require('./components/Materia.vue'));
    Vue.component('curso', require('./components/Curso.vue'));
    Vue.component('grupo', require('./components/Grupo.vue'));
    Vue.component('alumno', require('./components/Alumno.vue'));
    Vue.component('sesion', require('./components/Sesion.vue'));
    Vue.component('periodo', require('./components/Periodo.vue'));
    Vue.component('promedio', require('./components/Promedio.vue'));
    Vue.component('promcurso', require('./components/Promcurso.vue'));
    Vue.component('matricula', require('./components/Matricula.vue'));
    Vue.component('reporte', require('./components/Reporte.vue'));
    Vue.component('reporteal', require('./components/ReporteAl.vue'));
    Vue.component('cargaac', require('./components/Cargaac.vue'));
    Vue.component('horario', require('./components/Horario.vue'));
    Vue.component('rol', require('./components/Rol.vue'));
    Vue.component('user', require('./components/User.vue'));
    Vue.component('welcome', require('./components/Welcome.vue'));
    Vue.component('cliente', require('./components/Cliente.vue'));
//Components admin
//Components maestro
    Vue.component('categoriamaster', require('./components/Categoriamaster.vue'));
    Vue.component('horarioam', require('./components/Horarioam.vue'));
    Vue.component('usermaster', require('./components/Usermaster.vue'));
//Components maestro
//Components alumno
    Vue.component('sesional', require('./components/SesionAl.vue'));
    Vue.component('periodoal', require('./components/PeriodoAl.vue'));
    Vue.component('cursoal', require('./components/CursoAl.vue'));
    Vue.component('materiaal', require('./components/MateriaAl.vue'));
    Vue.component('sesional', require('./components/SesionAl.vue'));
    Vue.component('useral', require('./components/UserAl.vue'));
//Components alumno

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
        //ruta : 'http://http://192.168.1.81/escolarsis/public'
    }
});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Alumno from './components/Alumno.vue'
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: './components/Alumno.vue',
            name: 'alumno',
            component: Alumno
        },
    ],
});*/