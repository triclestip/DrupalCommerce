'use strict';
// ******************************** //
// *** Required Config Settings *** //
// ******************************** //

// BrowserSync Proxy URL
var localUrl = 'http://belgrade.dev:8888/'; // EG 'localhost', 'mysite.dev'


// ******************************** //
// *** Optional Config Settings *** //
// ******************************** //
// Only need to change if your use a non-default
// mainspring folder structure.

/////////////
// Sass & CSS Settings
// Watch sass files to compile to css
var scssPattern = ['./assets/scss/**/*.scss'];
var maxCssSize = 70000; // Warn if compiled css < 70kb (uncompressed)
var maxCssGzippedSize = 40000; // Warn if compiled css < 40kb (compressed)

/////////////
// Linters

// JS Linting these files. (Default is no minified or /vendor files)
var jsLintPattern = [
  'js/**/*.js',
  '!js/**/*.min.js', // Ignore minified files
  '!js/**/vendor/*.js']; // Ignore /vendor sub-folders

// Config Array used by gulp.js tasks
module.exports = {

  tasks: {

    browserSync: {
      // See http://www.browsersync.io/docs/options/ for options
      proxy: localUrl,
      port: 3333,
      ui:{
        port: 3334
      },
      ghostMode: {
        clicks: true,
        forms: true,
        scroll: true
      }

    },

    // Compile CSS from SCSS and optimize
    css: {
      pattern: scssPattern,
      dest: './assets/css',
      autoprefixer: {
        browsers: [
        'ie >= 9',
        'ie_mob >= 10',
        'ff >= 30',
        'chrome >= 34',
        'safari >= 7',
        'opera >= 23',
        'ios >= 6',
        'android >= 4.2',
        'bb >= 10'
        ]

      },
      sassConfig: {
        // Node Sass Settings - https://github.com/sass/node-sass
        indentedSyntax: false, // Enable .sass syntax
        precision: 10, // Google Starter kit's default
        errLogToConsole: true
      },
      sourceMaps: './maps', // Source Maps Folder
      sizeReport: {
        enabled: true,
        settings: {
          gzip: true, // Gzip for size reporting
          '*': {
            'maxSize': maxCssSize,
            'maxGzippedSize': maxCssGzippedSize // Max Size in Bytes after gzip
          }
        }
      }
    },

    // Compress Static Bitmaps
    images: {
      src: 'img-src',
      dest: 'img',
      extensions: ['jpg', 'png'], // No gif, PNG-8 is better
      settings: {
        progressive: true, // Progressive JPG
        optimizationLevel: 4, //PNG compression level
      },
      sizeReport: {
        enabled: true,
        settings: {
          gzip: true, // Gzip for size reporting
          '*': {
            'maxGzippedSize': 50000 // Max Size in Bytes after gzip
          }
        }
      }
    },
  }

};
