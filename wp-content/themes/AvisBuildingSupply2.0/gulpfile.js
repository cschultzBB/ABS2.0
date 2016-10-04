//Include gulp
var gulp = require('gulp');
var rename = require("gulp-rename");
var del = require('del');


//Include Our Plugins
var pug = require('gulp-pug');
var jshint = require('gulp-jshint');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
// Compile Our Sass
gulp.task('sass', function(){
    return gulp.src('css/*.sass')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(gulp.dest('css'));
});
// Compile Pug Files
gulp.task('pug', function(){
    gulp.src('pug/*.pug')
        .pipe( pug({
            extension: '.php'
        }))
        .pipe(gulp.dest(''));
});  
// Concantenate & minify JS
gulp.task('scripts', function(){
    return gulp.src('js/*.js')
        .pipe(concat('all.js'))
        .pipe(gulp.dest('dist'))
        .pipe(rename('all.min.js'))
        //.pipe(uglify())
        .pipe(gulp.dest('dist'));
});
gulp.task('default', function () {
	return gulp.src('src/flexbox.css')
		.pipe(autoprefixer())
		.pipe(gulp.dest('dist'));
});
// Watch Files For Changes
gulp.task('watch', function(){
    gulp.watch('css/*.sass', ['sass']);
});

//Default Task
gulp.task('run', ['sass', 'watch']);
