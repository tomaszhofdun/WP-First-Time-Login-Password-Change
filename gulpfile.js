// var gulp = require('gulp');
// var notify = require('gulp-notify');
// var wpPot = require('gulp-wp-pot');

// var textDomain = 'first-time-login-password-change';
// var potFile = 'first-time-login-password-change.pot';
// var translationDestination = './App/lang';
// var packageName = 'first-time-login-password-change';
// var phpFiles = './App/**/*.php'; // Path to all PHP files.


// function pot() {
//   return gulp.src(phpFiles)
//     .pipe(wpPot({
//       domain: textDomain,
//       package: packageName,
//     }))
//     .pipe(gulp.dest(translationDestination + '/' + potFile))
//     .pipe(notify({ message: 'TASK: "pot" Completed! 💯', onLast: true }))
// };


// exports.pot = pot;

/* USE WP-CLI INSTEAD AS IT COVERS BOTH TYPES OF FILES (JS, PHP) */