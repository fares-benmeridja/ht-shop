const mix = require('laravel-mix');

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
// mix.browserSync('http://127.0.0.1');
//
mix.js('resources/js/master.js', 'public/js')
    .sass('resources/sass/master.scss', 'public/css')
    .js('resources/js/admin.js', 'public/js')
    .sass('resources/sass/invoice.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css');
