const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix
        .styles(
            [
                'slick-carousel/slick/slick.css',
                'slick-carousel/slick/slick-theme.css',
                'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
            ],
            'public/css/bower.css',
            './resources/assets/bower_components/'
        )
        .styles(
            [
                '*.css',
            ],
            'public/css/all.css'
        );
    mix
        .scripts(
            [
                'jquery/dist/jquery.min.js',
                'slick-carousel/slick/slick.min.js',
                'angular-slick-carousel/dist/angular-slick.min.js',
                'moment/min/moment.min.js',
                'eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            ],
            'public/js/bower.js',
            './resources/assets/bower_components/'
        )
        .scripts(
            [
                'angular/common/filters.js',
                'angular/common/directives/directives.js',
                'angular/common/services/user-service.js',
                'angular/common/services/fast-service.js',
                'angular/common/services/news-service.js',
                'angular/account/register.js',
                'angular/soon/coming-soon.js',
                'angular/about/about.js',
                'angular/home/welcome.js',
                'angular/home/new-fast.js',
                'angular/nav/nav.js',
                'angular/nav/sidebar.js',
                'angular/app.js',
            ],
            'public/js/all.js'
        );

    mix.version([
        'css/bower.css',
        'css/all.css',
        'js/bower.js',
        'js/all.js'
    ]);
});
