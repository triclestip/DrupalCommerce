'use strict';

// Initialize BrowserSync and Watch compile CSS from SCSS,
// and regenerate styleguide.

var config      = require('../config');
var gulp        = require('gulp');
var path        = require('path');
var config      = require('../config');
var browserSync = require('browser-sync').create('bs');
var sass        = require('gulp-sass');


// Check for required config settings
if(!config.tasks.css){return;}
if(!config.tasks.browserSync){return;}


var scssSrc           = config.tasks.css.pattern;
var browserSyncConfig = config.tasks.browserSync;

var sassConfig = config.tasks.css.sassConfig;

// Watch Tasks

gulp.task('watch', ['css'], function() {

  gulp.watch(scssSrc, ['css:devBrowserSync']); // Compile SCSS to CSS
  // watch twig templates for chages
  gulp.watch("./templates/**/*.html.twig").on('change', browserSync.reload);

});







