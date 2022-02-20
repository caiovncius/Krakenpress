"use strict";

const gulp  = require( 'gulp' );
const concat = require( 'gulp-concat' );
const uglify = require( 'gulp-uglify' );
const sass = require('gulp-sass')(require('sass'));
var rename = require( 'gulp-rename' );

const js_public_src_files = 'public/assets/js/**/*.js';
const js_admin_src_files = 'admin/assets/js/**/*.js';
const js_dest_files = 'dist/js/';
const js_public_includes = []
const js_admin_includes = []

const sass_public_file = 'public/assets/scss/style.scss';
const sass_admin_file = 'admin/assets/scss/style.scss';
const sass_dest_files = 'dist/css/';

function build_public_scripts() {
    return gulp.src( [...js_public_includes, js_public_src_files] )
        .pipe( concat( 'scripts.js' ) )
        .pipe( uglify() )
        .pipe( gulp.dest( js_dest_files ) );
}

function build_admin_scripts() {
    return gulp.src( [...js_admin_includes, js_admin_src_files ] )
        .pipe( concat( 'admin-scripts.js' ) )
        .pipe( uglify() )
        .pipe( gulp.dest( js_dest_files ) );
}

function build_public_sass() {
    return gulp.src( sass_public_file )
        .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
        .pipe( gulp.dest( sass_dest_files ) );
}

function build_admin_sass() {
    return gulp.src( sass_admin_file )
        .pipe( sass( { outputStyle: 'compressed' } ).on( 'error', sass.logError ) )
        .pipe( rename( 'admin-styles.css' ) )
        .pipe( gulp.dest( sass_dest_files ) );
}

function watch_public_sass() {
    gulp.watch( sass_public_file, build_public_sass );
}

function watch_admin_sass() {
    gulp.watch( sass_admin_file, build_admin_sass );
}

function watch_public_scripts() {
    gulp.watch( js_public_src_files, build_public_scripts );
}

function watch_admin_scripts() {
    gulp.watch( js_admin_src_files, build_admin_scripts );
}

function watch() {
    gulp.watch( sass_public_file, build_public_sass );
    gulp.watch( sass_admin_file, build_admin_sass );
    gulp.watch( js_public_src_files, build_public_scripts );
    gulp.watch( js_admin_src_files, build_admin_scripts );
}

exports.build_public_styles = build_public_sass;
exports.build_public_scripts = build_public_scripts;
exports.build_admin_styles = build_admin_sass;
exports.build_admin_scripts = build_admin_scripts;
exports.watch_public_sass = watch_public_sass;
exports.watch_admin_sass = watch_admin_sass;
exports.watch_public_scripts = watch_public_scripts;
exports.watch_admin_scripts = watch_admin_scripts;

exports.build_scripts = gulp.series( build_public_scripts, build_admin_scripts );
exports.build_styles = gulp.series( build_public_sass, build_admin_sass );

exports.watch_styles = gulp.series( watch_public_sass, watch_admin_sass );
exports.watch_scripts = gulp.series( watch_public_scripts, watch_admin_scripts );
exports.watch = watch;
