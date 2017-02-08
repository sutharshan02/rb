var gulp = require('gulp'),
		concat = require('gulp-concat'),
		plumber = require('gulp-plumber');


gulp.task('js', function(){
	gulp.src(
		[
		'./dist/js/app/util.js',
		// './dist/js/services/*.js',
		'./dist/js/controllers/app.js',
		'./dist/js/controllers/resume.js',
		'./dist/js/controllers/work.js',
		'./dist/js/controllers/skill.js',
		'./dist/js/controllers/education.js',
		'./dist/js/controllers/save.js',
		'./dist/js/controllers/template.js'

		])
		.pipe(plumber())
		.pipe(concat('bundle.js'))
		.pipe(gulp.dest('./dist/js/'));

});


gulp.task('ctrl', function(){
	gulp.src(
		[
		'./dist/js/controllers/*.js'
		])
		.pipe(plumber())
		.pipe(concat('bundle_ctrl.js'))
		.pipe(gulp.dest('./dist/js/'));

});

gulp.task('services', function(){
	gulp.src(
		[

		'./dist/js/services/*.js',


		])
		.pipe(plumber())
		.pipe(concat('bundle_services.js'))
		.pipe(gulp.dest('./dist/js/'));

});


gulp.task('default', ['ctrl', 'services'], function(){
	gulp.watch('dist/js/controllers/*.js', ['ctrl']);
	gulp.watch('dist/js/services/*.js', ['services']);
});