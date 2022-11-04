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

mix
    .js('resources/js/libs/bootstrap', 'public/dist/js/libs')
    
    .js('resources/js/app.js', 'public/dist/js')
    
    .js('resources/js/admin/admin-app.js', 'public/dist/admin/js')
    .js('resources/js/admin/inquiries.js', 'public/dist/admin/js')

    .copy('resources/fonts', 'public/dist/fonts')
    .copy('resources/images', 'public/dist/images')

    .sass('resources/sass/bootstrap.scss', 'public/dist/css/libs')

    .sass('resources/sass/bootstrap-icons.scss', 'public/dist/css')
    .sass('resources/sass/app.scss', 'public/dist/css')
    .sass('resources/sass/home.scss', 'public/dist/css')
    .sass('resources/sass/packages.scss', 'public/dist/css')
    .sass('resources/sass/blog.scss', 'public/dist/css')
    .sass('resources/sass/information.scss', 'public/dist/css')

    .sass('resources/sass/admin/admin-app.scss', 'public/dist/admin/css')
    .sass('resources/sass/admin/signin.scss', 'public/dist/admin/css')

    .sourceMaps();
