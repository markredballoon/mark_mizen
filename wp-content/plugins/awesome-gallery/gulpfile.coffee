pkg			= require('./package.json')
argv		= require('minimist')(process.argv.slice(2))

gulp		= require('gulp')
util		= require('gulp-util')
coffee		= require('gulp-coffee')
header		= require('gulp-header')
concat		= require('gulp-concat')
uglify		= require('gulp-uglify')
watch		= require('gulp-watch')
wrap		= require('gulp-wrap')
sourcemaps	= require('gulp-sourcemaps')
beautify 	= require('gulp-jsbeautifier')
sass 		= require 'gulp-sass'
autoprefixer= require 'gulp-autoprefixer'
beautifyCSS = require 'gulp-cssbeautify'
minifyCSS	= require('gulp-minify-css')
gutil		= require('gulp-util')
rename		= require('gulp-rename')
fs			= require('fs')
templateCompile = require('gulp-template-compile')
merge = require('gulp-merge')

banner = ()-> [
	'// Uberbox.js',
	'// version: ' + pkg.version,
	'// author: ' + pkg.author,
	'// license: ' + pkg.licenses[0].type
	].join('\n') + '\n'


gallerySources = [
	'helpers',
	'animation-queue',
	'filters',
	'sliding-element',
	'image-caption',
	'image-overlay',
	'layout-strategy',
	'horizontal-flow',
	'vertical-flow',
	'grid-strategy',
	'gallery-image',
	'lightbox-adapter',
	'adapters/foobox',
	'adapters/ilightbox',
	'adapters/jetpack',
	'adapters/magnific-popup',
	'adapters/prettyphoto',
	'adapters/swipebox',
	'adapters/uberbox',
	'gallery'
].map((file)-> "assets/js/#{file}.coffee")
editorSources =  [
	'models',
	'fonts',
	'image-selector',
	'layout-selector',
	'cell-editor-section',
	'cell-editor-base',
	'sections',
	'manual-editor',
	'automatic-editor',
	'tabs',
	'publish',
	'editor'

].map((file)-> "assets/admin/js/#{file}.coffee")


handleError = (error)->
	util.log
	@emit 'end'
	

gulp.task 'js', ->
	sourcesStream = gulp.src(gallerySources)
	.pipe(coffee(bare: true).on('error', (-> gutil.log(arguments); @emit('end'))))
	.pipe(concat('awesome-gallery.js')).pipe(wrap({ src: 'assets/js/init.js'}))
	.pipe(gulp.dest('assets/js')).on('error', handleError)

	gulp.src("assets/admin/js/*.coffee").pipe(coffee(bare: true).on('error', (-> gutil.log(arguments); @emit('end'))))
	.pipe(gulp.dest('assets/admin/js')).on('error', handleError)
	
gulp.task 'css', ->
	css = gulp.src('assets/css/*.sass')
	.pipe(sourcemaps.init())
	.pipe(sass(indentedSyntax: true, errLogToConsole: true).on('error', -> @emit('end')))
	.pipe(autoprefixer('last 2 version', 'safari 5', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
	css = css.pipe(beautifyCSS())
	.pipe(sourcemaps.write("assets/css"))
	.pipe(gulp.dest('assets/css')).on('error', handleError)
	.pipe(sourcemaps.write("."))
	.pipe(gulp.dest('dist')).on('error', handleError)
	
gulp.task 'build', ['js', 'css']
gulp.task 'watch', -> 
	gulp.watch(['assets/js/*.coffee', 'assets/js/adapters/*.coffee'], ['js'])
	gulp.watch(['assets/css/*.sass'], ['css'])
	gulp.watch(['assets/admin/js/*.coffee'], ['js'])
gulp.task 'default', ['build', 'watch']




