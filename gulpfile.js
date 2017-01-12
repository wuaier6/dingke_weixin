var elixir = require('laravel-elixir');

/**
 * 拷贝任何需要的文件
 *
 * Do a 'gulp copyfiles' after bower updates
 */
gulp.task("copyfiles", function() {

    gulp.src("vendor/bower_dl/jquery/dist/jquery.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/less/**")
        .pipe(gulp.dest("resources/assets/less/bootstrap"));

    gulp.src("vendor/bower_dl/bootstrap/dist/js/bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("vendor/bower_dl/bootstrap/dist/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

    gulp.src("vendor/bower_dl/font-awesome/less/**")
        .pipe(gulp.dest("resources/assets/less/fontawesome"));

    gulp.src("vendor/bower_dl/font-awesome/fonts/**")
        .pipe(gulp.dest("public/assets/fonts"));

});

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

    // 合并 scripts
    mix.scripts(['js/jquery.js','js/bootstrap.js'],
        'public/assets/js/admin.js',
        'resources/assets'
    );
    //// 编译 Less
    mix.less('admin.less', 'public/assets/css/admin.css');
    //mix.less('wxwall.less', 'public/assets/css/wxwall.css');
    mix.version(
        [
            'public/assets/css/admin.css',
            'public/assets/js/admin.js',
        ]);
});