var elixir = require('laravel-elixir');
var gulpLivereload = require('gulp-livereload');
var clean = require('rimraf');
var gulp = require('gulp');

var config = {
    assets_resource: './resources/assets',
    assets_public: './public/assets'
};

config.bower_path = config.assets_resource + '/../bower_components';

config.assets_public_js = config.assets_public + '/js';
config.assets_resource_js = config.assets_resource + '/js';

config.assets_public_css = config.assets_public + '/css';
config.assets_resource_css = config.assets_resource + '/css';

config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css',
];

config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js'
];

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

elixir(function (mix) {
    mix.sass('app.scss');
});
