let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/assets/plantilla/css/font-awesome.min.css',
    'resources/assets/plantilla/css/simple-line-icons.min.css',
    'resources/assets/plantilla/css/style.css'
], 'public/css/plantilla.css',)
mix.styles([
    'resources/assets/plantilla/css/bootstrap.min.css',
    'resources/assets/fonts/font-awesome.min.css',
    'resources/assets/fonts/simple-line-icons.css',
    'resources/assets/plantilla/css/slicknav.css',
    'resources/assets/plantilla/css/menu_sideslide.css',
    'resources/assets/plantilla/css/slide-style.css',
    'resources/assets/plantilla/css/nivo-lightbox.css',
    'resources/assets/plantilla/css/animate.css',
    'resources/assets/plantilla/css/main.css',
    'resources/assets/plantilla/css/responsive.css',
], 'public/css/plantillalandin.css',)
.scripts([
    'resources/assets/plantilla/js/jquery.min.js',
    'resources/assets/plantilla/js/popper.min.js',
    'resources/assets/plantilla/js/bootstrap.min.js',
    'resources/assets/plantilla/js/Chart.min.js',
    'resources/assets/plantilla/js/pace.min.js',
    'resources/assets/plantilla/js/template.js',
    'resources/assets/plantilla/js/sweetalert2.all.js'
], 'public/js/plantilla.js')

.scripts([
    'resources/assets/plantilla/js/jquery-min.js',
    'resources/assets/plantilla/js/popper.min.js',
    'resources/assets/plantilla/js/bootstrap.min.js',
    'resources/assets/plantilla/js/jquery.mixitup.js',
    'resources/assets/plantilla/js/jquery.counterup.min.js',
    'resources/assets/plantilla/js/waypoints.min.js',
    'resources/assets/plantilla/js/wow.js',
    'resources/assets/plantilla/js/jquery.nav.js',
    'resources/assets/plantilla/js/jquery.easing.min.js',  
    'resources/assets/plantilla/js/nivo-lightbox.js',
    'resources/assets/plantilla/js/jquery.slicknav.js',
    'resources/assets/plantilla/js/main.js',
    'resources/assets/plantilla/js/form-validator.min.js',
    'resources/assets/plantilla/js/contact-form-script.min.js',
    'resources/assets/plantilla/js/map.js'
], 'public/js/plantillalandin.js')
.js(['resources/assets/js/app.js'],
 'public/js/app.js');