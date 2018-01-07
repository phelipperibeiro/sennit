var elixir = require('laravel-elixir');
var livereload = require('gulp-livereload');
var clean = require('rimraf');
var gulp = require('gulp');

var config = {
    assets_resource: './resources/assets',
    assets_public: './public/assets'
};

config.assets_public_js = config.assets_public + '/js';
config.assets_resource_js = config.assets_resource + '/js';

config.assets_public_app = config.assets_public + '/app';
config.assets_resource_app = config.assets_resource + '/app';

config.assets_public_css = config.assets_public + '/css';
config.assets_resource_css = config.assets_resource + '/css';

gulp.task('copy-scripts', function(){
    gulp.src([
        config.assets_resource_js + '/**/*.js' // ** indica que e para procurar em todas as pastas
    ])
    .pipe(gulp.dest(config.assets_public_js)) //destinho
    .pipe(livereload()); // imprime status no bash
});

gulp.task('copy-styles', function(){
    gulp.src([
        config.assets_resource_css + '/**/*.css' 
    ])
    .pipe(gulp.dest(config.assets_public_css))
    .pipe(livereload());
});


gulp.task('copy-app', function(){
    gulp.src([
        config.assets_resource_app + '/**/*.js'
    ])
    .pipe(gulp.dest(config.assets_public_app))
    .pipe(livereload());
}); 

gulp.task('clear-public-folder', function(){
    clean.sync(config.assets_public);
});

gulp.task('copy',['clear-public-folder'], function(){
    gulp.start('copy-styles','copy-scripts', 'copy-app');
});

gulp.task('default',['clear-public-folder','copy-scripts'], function(){
    
    elixir(function (mix) {
        mix.styles(config.assets_resource_css + '/**/*.css', 'public/assets/css/all.css');
        
        mix.scripts(config.assets_resource_app + '/**/*.js', 'public/assets/js/app_all.js');
   
    });
     
});

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

//elixir(function (mix) {
//    mix.sass('app.scss');
//});
