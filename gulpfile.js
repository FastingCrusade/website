const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
const gulp = require('gulp');
const templateCache = require('gulp-angular-templatecache');
const Task = elixir.Task;

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
elixir.extend('templates', function () {
    new Task('templates', function () {
        return gulp.src('./resources/angular/**/*.html')
            .pipe(templateCache('templates.js', {standalone: true, module: 'templates.app'}))
            .pipe(gulp.dest('public/js'));
    });
});

elixir(function (mix) {
    mix
        .templates()
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
                '**/*.css',
            ],
            'public/css/all.css',
            '.resources/angular/'
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
                '**/*.js'
            ],
            'public/js/all.js',
            './resources/angular/'
        );

    mix.version([
        'css/bower.css',
        'css/all.css',
        'js/templates.js',
        'js/bower.js',
        'js/all.js'
    ]);
});
