//
// Watch task
// ==========================================================================

var Config = require( './_config' ),
    Helpers = require( './_helpers' );

module.exports = function( gulp, plugins, paths, files ) {

    Helpers.pushToWatch( files.html, plugins.browserSync.reload );

    return function(){

        plugins.browserSync.init({
            port: 1337,
            files: [ '{lib,templates}/**/*.php', '*.php' ],
            proxy: 'http://lilja.dev',
            snippetOptions: {
                whitelist: [ '/wp-admin/admin-ajax.php' ],
                blacklist: [ '/wp-admin/**' ]
            }
        });

        for( var w = 0; w < Config.watch.length; w++ ) {
            var tsk = Config.watch[ w ];
            gulp.watch( tsk.path, tsk.script );
        }

    };

};