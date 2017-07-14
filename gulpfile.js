process.env.DISABLE_NOTIFIER = true;
const elixir = require('laravel-elixir');
require('laravel-elixir-vue');

var gulp = require('gulp');
var watch = require('gulp-watch');

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
        .sass(['app.scss','global.scss','color.scss','animate.scss'])
        .webpack('app.js');

    /*mix
        .copy('vendor/materialize/fonts', 'public/build/fonts');*/

     // mix   
     //    .styles(['global.scss','css/app.css'], 'public/css/app.css');

    mix
        .version(['css/app.css', 'js/app.js']);
});

gulp.task('callback', function () {
    // Callback mode, useful if any plugin in the pipeline depends on the `end`/`flush` event 
    return watch(['resources/**/*.vue','resources/**/*.sass'], function () {
        gulp.src(['resources/**/*.vue','resources/**/*.sass']).pipe(gulp.dest('build'));
    });
});
