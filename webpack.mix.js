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
    "public/adminlte/css/bootstrap.min.css",
    "public/adminlte/css/font-awesome.min.css",
    "public/adminlte/css/ionicons.min.css",
    "public/adminlte/css/dataTables.bootstrap.min.css",
    "public/adminlte/css/AdminLTE.min.css",
    "public/adminlte/css/_all-skins.min.css",
    "public/adminlte/css/blue.css"
],'public/css/app.css');
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
mix.combine([
    'public/adminlte/js/jquery.min.js',
    'public/adminlte/js/bootstrap.min.js',
    'public/adminlte/js/jquery.dataTables.min.js',
    'public/adminlte/js/dataTables.bootstrap.min.js',
    'public/adminlte/js/jquery.validate.min.js',
    'public/adminlte/js/jquery.slimscroll.min.js',
    // 'public/adminlte/js/fastclick.js',
    'public/adminlte/js/adminlte.min.js',
    'public/adminlte/js/demo.js',
    // 'public/adminlte/js/myjs.js',
],'public/js/app.js');

mix.combine([
    'public/adminlte/js/myjs.js',
],'public/js/app2.js');

mix.combine([
    'public/adminlte/js/show.js',
],'public/js/show.js');


mix.combine([
    'public/adminlte/js/ticket.js',
],'public/js/ticket.js');

mix.styles([
    "public/adminlte/css/my.css",
],'public/css/show.css');

mix.styles([
    "public/adminlte/css/ticket.css",
],'public/css/ticket.css');

mix.copy('node_modules/font-awesome/fonts/*', 'public/fonts');
mix.copy('node_modules/admin-lte/node_modules/bootstrap/fonts/*', 'public/fonts');
// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
