var gulp = require('gulp');
var gulpif = require('gulp-if');
var uglify = require('gulp-uglify');
var uglifycss = require('gulp-uglifycss');
var less = require('gulp-less');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var env = process.env.type;

gulp.task('js', function () {
    return gulp.src([
            'src/Tim/ExampleBundle/Resources/public/js/utils.js',
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/bootstrap/dist/js/bootstrap.min.js',
            // 'bower_components/highlight/src/highlight.js',
            // 'bower_components/highlight/src/languages/php.js',
            // 'bower_components/highlight/src/languages/sql.js',
            // 'src/Tim/CheatSheetBundle/Resources/public/js/**/*.js'])
            // 'src/Tim/CheatSheetBundle/Resources/public/js/highlight.min.js',
            'src/Tim/CheatSheetBundle/Resources/public/js/highlight.pack.js',
            'src/Tim/CheatSheetBundle/Resources/public/js/anchor.min.js',
            'src/Tim/CheatSheetBundle/Resources/public/js/site.js'])
        .pipe(concat('app.js'))
        // .pipe(gulpif(env === 'prod', uglify()))
        .pipe(uglify())
        // .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

gulp.task('chart.js', function () {
    return gulp.src([
        'bower_components/Chart.js/dist/Chart.min.js'
    ])
        .pipe(concat('chart.js'))
        // .pipe(gulpif(env === 'prod', uglify()))
        .pipe(uglify())
        // .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

gulp.task('symfony-collection.js', function () {
    return gulp.src([
        'bower_components/symfony-collection/jquery.collection.js'
    ])
        .pipe(concat('symfony-collection.min.js'))
        // .pipe(gulpif(env === 'prod', uglify()))
        .pipe(uglify())
        // .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('web/js'));
});

gulp.task('css', function () {
    return gulp.src([
            'bower_components/bootstrap/dist/css/bootstrap.css',
            'bower_components/font-awesome/css/font-awesome.min.css',
            'src/Tim/CheatSheetBundle/Resources/public/css/highlight.min.css',
            'bower_components/highlight/src/styles/github.css',
            'src/Tim/CheatSheetBundle/Resources/public/css/cosmo/bootstrap.min.css',
            // 'src/Tim/CheatSheetBundle/Resources/public/css/**/*.css'])
            'src/Tim/CheatSheetBundle/Resources/public/css/site.css'])
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('styles.css'))
        // .pipe(gulpif(env === 'prod', uglifycss()))
        // .pipe(sourcemaps.write('./'))
        .pipe(uglifycss())
        .pipe(gulp.dest('web/css'));
});

gulp.task('css', function () {
    return gulp.src(['src/Tim/ExampleBundle/Resources/public/css/table.css'])
        .pipe(gulpif(/[.]less/, less()))
        .pipe(concat('table.css'))
        // .pipe(gulpif(env === 'prod', uglifycss()))
        // .pipe(sourcemaps.write('./'))
        .pipe(uglifycss())
        .pipe(gulp.dest('web/css'));
});

gulp.task('img', function() {
    return gulp.src('src/Tim/CheatSheetBundle/Resources/public/images/**/*.*')
        .pipe(gulp.dest('web/img'));
});

gulp.task('fonts', function() {
    return gulp.src(['bower_components/bootstrap/dist/fonts/**/*.*',
        'bower_components/font-awesome/fonts/*.{otf,eot,ttf,woff,woff2,eof,svg}'])
        // 'bower_components/font-awesome/fonts/*.*'])
        // .pipe(flatten())
        .pipe(gulp.dest('web/fonts'));
});

//define executable tasks when running "gulp" command
gulp.task('default', ['js', 'css', 'img', 'fonts', 'chart.js', 'symfony-collection.js']);