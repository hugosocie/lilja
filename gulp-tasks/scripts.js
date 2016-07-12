//
// Scripts task
// ==========================================================================

var Helpers = require( './_helpers' );

module.exports = function( gulp, plugins, paths, files ) {

    Helpers.pushToWatch( files.scripts, [ 'scripts', plugins.browserSync.reload ] );

    return function(){
        gulp.src( paths.src + '/js/main.js' )
            .pipe( plugins.plumber() )
            .pipe( plugins.webpackStream({
                output: {
                    filename: '[name].js'
                },
                module: {
                    loaders: [
                        {
                            test: /\.vue?$/,
                            exclude: /(node_modules|bower_components)/,
                            loader: 'vue-loader'
                        }
                    ]
                }
            }) )
            .pipe( gulp.dest( paths.dist + '/js/' ) );
    };

};