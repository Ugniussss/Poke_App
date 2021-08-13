/*!
 * gulp
 * $ npm install gulp gulp-data gulp-autoprefixer gulp-uglify gulp-notify gulp-sass gulp-concat gulp-ruby-sass gulp-css-rebase-urls gulp-add-src gulp-run gulp-csso gulp-rename 
 * $ npm install -g browserslist-useragent-regexp
*/

var gulp         = require('gulp');
var data         = require('gulp-data');
var uglify       = require('gulp-uglify');
var concat       = require('gulp-concat');
var addsrc       = require('gulp-add-src');
var sass         = require('gulp-sass');
var notify       = require('gulp-notify');
var rebaseUrls   = require('gulp-css-rebase-urls');
var autoprefixer = require('gulp-autoprefixer');
var run          = require('gulp-run');
var csso         = require('gulp-csso');
var rename       = require('gulp-rename');

gulp.task('app-css', function(){
    ret = gulp.src([
            './Style/styles.scss',
        ])
        .pipe(sass())
        .on('error', function (err) {
            console.log(err.toString());
            // notify('SCSS ERROR');
            this.emit('end');
        })
        .pipe(concat('./Style/min.css'))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('.'))
        .pipe(csso())
        // .pipe(rename({ extname: '.min.css' }))
        // .pipe(gulp.dest('./www/application/styles/'))
        .pipe(notify('css done'));

});

gulp.task('app-css-watch', function() {      
    gulp.watch(['./Style/styles.scss'], ['app-css']);
  
});

gulp.task('default', function() {
    console.log('hello gulp');
});