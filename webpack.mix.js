const mix = require('laravel-mix');
// mix.postCss('src/app.css', 'dist');
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
mix.js('resources/js/app.js', 'public/js')
    .vue()
    // .postCss('resources/css/app.css', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');

// //css bundle
mix.styles([
    'public/front/css/bootstrap.min.css',
    'public/front/css/owl.carousel.min.css',
    // '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
    'public/front/css/font-awesome.min.css',
    // '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
    'public/front/css/flaticon.css',
    'public/front/css/corner-popup.min.css',
    'public/front/css/jquery-ui.css',
    'public/front/css/metisMenu.min.css',
    'public/front/css/selectsearch.css',
    'public/front/css/swiper.min.css',
    'public/front/css/styles.css',
    'public/front/css/responsive.css',
], 'public/app.css');


// //js bundle
mix.scripts([

    'public/front/js/vendor/modernizr-2.8.3.min.js',
    'public/front/js/vendor/jquery-2.2.4.min.js',
    'public/front/js/bootstrap.min.js',
    'public/front/js/owl.carousel.min.js',
    'public/front/js/scrollup.js',
    'public/front/js/isotope.pkgd.min.js',
    'public/front/js/imagesloaded.pkgd.min.js',
    'public/front/js/jquery.zoom.min.js',
    'public/front/js/countdown.js',
    'public/front/js/swiper.min.js',
    '//cdn.jsdelivr.net/npm/sweetalert2@11',
    'public/front/js/metisMenu.min.js',
    'public/front/js/mailchimp.js',
    'public/front/js/jquery-ui.min.js',
    'public/front/js/corner-popup.min.js',
    '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
    '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
    'public/front/js/selectsearch.js',
    'public/front/js/scripts.js',
], 'public/app.js');

//             ], 'public/css');
// require('resources/css/bootstrap-rtl.min.css'),

// mix.js(['resources/js/app.js',

//     ], 'public/js')
//     .vue()
//     .postCss('resources/css/app.css', 'public/css', [
//             require('postcss-custom-properties')
//             .sass(['resources/sass/app.scss',

//             ], 'public/css');