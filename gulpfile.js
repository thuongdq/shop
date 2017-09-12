var gulp = require('gulp');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-csso');
var concat = require('gulp-concat');
var pump = require('pump');

gulp.task('js', function (cb) {
    pump([
            gulp.src([
                'public/frontend/default/assets/js/jquery-1.10.2.min.js',
                'public/frontend/default/assets/js/jquery-migrate-1.2.1.js',
                'public/frontend/default/assets/js/bootstrap.min.js',
                'public/frontend/default/assets/js/bootstrap-hover-dropdown.min.js',
                'public/frontend/default/assets/js/owl.carousel.min.js',
                'public/frontend/default/assets/js/css_browser_selector.min.js',
                'public/frontend/default/assets/js/echo.min.js',
                'public/frontend/default/assets/js/jquery.easing-1.3.min.js',
                'public/frontend/default/assets/js/bootstrap-slider.min.js',
                'public/frontend/default/assets/js/jquery.raty.min.js',
                'public/frontend/default/assets/js/jquery.prettyPhoto.min.js',
                'public/frontend/default/assets/js/jquery.customSelect.min.js',
                'public/frontend/default/assets/js/wow.min.js',
                'public/frontend/default/assets/js/scripts.js',
                'public/backend/global/plugins/vue-js/vue.js',
                'public/backend/global/plugins/axios/dist/axios.min.js',
            ]),
            concat('app.js'),
            uglify(),
            gulp.dest('public/asset')
        ],
        cb
    );
});

gulp.task('css', function(cb){
    pump([
            gulp.src([
                'public/frontend/default/assets/css/main.css',
                'public/frontend/default/assets/css/blue.css',
                'public/frontend/default/assets/css/owl.carousel.css',
                'public/frontend/default/assets/css/owl.transitions.css',
                'public/frontend/default/assets/css/animate.min.css',
                'public/frontend/default/assets/css/custom.css',
                'public/frontend/default/assets/css/font-awesome.min.css',
            ]),
            concat('app.css'),
            minifyCSS(),
            gulp.dest('public/asset')
        ],
        cb
    );
});

gulp.task('default', [ 'js', 'css' ]);