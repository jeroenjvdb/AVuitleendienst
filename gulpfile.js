var gulp				= require('gulp'),
		sourcemaps		= require('gulp-sourcemaps'),
		autoprefixer	= require('gulp-autoprefixer'),
		sass			= require('gulp-sass');

gulp.task('sass', function () {
	return gulp.src('./sass/main.scss')
		.pipe(sourcemaps.init())
			.pipe(sass({
				outputStyle: 'compressed'
			}).on('error', sass.logError))
			.pipe(autoprefixer({
				browsers: ['last 2 versions'],
				cascade: false
			}))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./public/css'));
});

gulp.task('default', function() {
    gulp.start('watch');
});

gulp.task('watch', function () {

	gulp.watch('./sass/**/*.scss', ['sass']);

});