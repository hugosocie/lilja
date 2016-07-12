//
// Import main depdendencies
// ==========================================================================

var gulp            = require( 'gulp' ),
    gulpLoadPlugins = require( 'gulp-load-plugins' );



//
// Import all depdendencies with "gulpLoadPlugins"
// You need to update "pattern" for all dependencies
// that are not prefixed with "gulp-" or "gulp."
// ==========================================================================

var plugins = gulpLoadPlugins({
    pattern: [
        'gulp-*', 'gulp.*',
        'webpack-stream',
        'browser-sync',
        'main-bower-files',
        'del'
    ]
});



//
// Define folders path
// ==========================================================================

var paths = {
    dist : 'dist',
    src  : 'src'
};



//
// Define files path and files extensions
// ==========================================================================

var files = {
    fonts   : [ paths.src + '/fonts/**/*.{eot,svg,ttf,woff,woff2}' ],
    html    : [ '**/*.html' ],
    images  : [ paths.src + '/img/**/*.{jpg,png,gif,svg}' ],
    scripts : [ paths.src + '/js/**/*.{js,vue}' ],
    styles  : [ paths.src + '/sass/**/*.scss' ],
    svg     : [ paths.src + '/svg/**/*.svg' ]
};



//
// Define all tasks names by sequence
// Tasks name must be the same that the task file name in "gulp-tasks" folder
// ==========================================================================

var tasks = [

    // Main tasks
    [
        'bower',
        'fonts',
        'images',
        'scripts',
        'styles',
        'svg'
    ],
    [ 'watch' ],

    // other tasks
    [ 'clean' ]
];



//
// Load tasks
// ==========================================================================

var loadTasks = function() {
    for( var t = 0; t < tasks.length; t++ ) {
        var _tasks = tasks[ t ];
        for( var i = 0; i < _tasks.length; i++ ) {
            var name = _tasks[ i ],
                path = './gulp-tasks/' + name;
            gulp.task( name, require( path )( gulp, plugins, paths, files ) );
        }
    }
}();



//
// Build task
// ==========================================================================

gulp.task( 'build', function( e ){
    return plugins.sequence( tasks[ 0 ], e );
});



//
// Default task : watch
// ==========================================================================

gulp.task( 'default', function( e ){
    return plugins.sequence( 'build', tasks[ 1 ], e );
});