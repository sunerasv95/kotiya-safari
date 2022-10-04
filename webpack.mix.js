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
    .js('resources/js/app.js', 'public/dist/js')
        // .minify('resources/js/app.js', 'public/dist/js/app.js')

    .js('resources/js/admin/admin-app.js', 'public/dist/admin/js')
        // .minify('resources/js/admin/admin-app.js', 'public/dist/admin/js/admin-app.js')

    .js('resources/js/admin/reservations.js', 'public/dist/admin/js')

    .copy('resources/fonts', 'public/dist/fonts')

    .sass('resources/sass/app.scss', 'public/dist/css')
    .sass('resources/sass/home.scss', 'public/dist/css')
    .sass('resources/sass/packages.scss', 'public/dist/css')
    .sass('resources/sass/blog.scss', 'public/dist/css')

    .sass('resources/sass/admin/admin-app.scss', 'public/dist/admin/css')
    .sass('resources/sass/admin/signin.scss', 'public/dist/admin/css')
    .sourceMaps();

// mix.browserSync({
//         watch: true,
//         files: [
//           'public/dist/js/**/*',
//           'public/dist/css/**/*',
//           'public/dist/fonts/**/*',
//           'public/**/*.+(html|php)',
//           'resources/views/**/*.php'
//         ],
//         open: "http://kotiyasafari.test/",
//         reloadDelay: 1000,
//         proxy: {
//           target: "http://kotiyasafari.test/",
//           ws: true,
//         },
//       });
