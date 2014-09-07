// Require all those npm-modules

var gulp            = require('gulp'),
    sass            = require('gulp-sass'),
    autoprefixer    = require('gulp-autoprefixer'),
    cssmin          = require('gulp-cssmin'),
    jshint          = require('gulp-jshint'),
    uglify          = require('gulp-uglify'),
    imagemin        = require('gulp-imagemin'),
    pngcrush        = require('imagemin-pngcrush'),
    rename          = require('gulp-rename'),
    del             = require('del'),
    concat          = require('gulp-concat'),
    notify          = require('gulp-notify'),
    cache           = require('gulp-cache'),
    livereload      = require('gulp-livereload'),
    plumber         = require('gulp-plumber');


// render scss
gulp.task('styles', function() {var onError = function(err) {
        notify.onError({
                    title:    "Gulp",
                    subtitle: "Failure!",
                    message:  "Error: <%= error.message %>",
                    sound:    "Submarine"
                })(err);

        this.emit('end');
    };
    gulp.src('./src/scss/main.scss')
        .pipe(plumber({errorHandler: onError}))
        .pipe(sass({ style: 'expanded' }))
        .pipe(autoprefixer('last 2 version', 'IE 9', 'safari 5', 'Firefox ESR', 'opera 12.1', 'ios 6', 'android 4', 'BlackBerry 10'))
        .pipe(gulp.dest('./css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssmin())
        .pipe(gulp.dest('./css'))
        .pipe(notify({ message: 'Styles task complete' }));
});


// compress images
gulp.task('images', function() {
    gulp.src('./src/img/*')
        .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
        .pipe(gulp.dest('./img/'))
        .pipe(notify({ message: 'Images task complete' }));
});


// do the javascript-dance
gulp.task('scripts', function() {
    gulp.src('./src/js/**/*.js')
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./js'))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('./js'))
        .pipe(notify({ message: 'Scripts task complete' }));
});


// watch it while working
gulp.task('watch', function() {
    // Watch .scss files
    gulp.watch('src/scss/**/*.scss', ['styles']);

    // Watch .js files
    gulp.watch('src/js/**/*.js', ['scripts']);

    // Watch image files
    gulp.watch('src/img/**/*', ['images']);
});


// clean the folders
gulp.task('clean', function(cb) {
    del(['./css/*', './js/*', './img/*'], cb)
});


// default: all of them! \o/
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts', 'images');
});
