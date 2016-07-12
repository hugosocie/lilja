//
// Clean task
// ==========================================================================

var Config = require( './_config' ),
    Helpers = require( './_helpers' );

module.exports = function( gulp, plugins, paths ) {

    Helpers.pushToClean( paths.dist );

    return function(){
        plugins.del( Config.clean );
    };

};