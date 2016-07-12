//
// Bower task
// Import all Javascript dependencies from bower_components
// ==========================================================================

var Config = require( './_config' );

module.exports = function() {

    return {

        pushToWatch : function( path, script ) {
            Config.watch.push({
                path : path,
                script : script
            });
        },

        pushToClean : function( path ) {
            Config.clean.push( path );
        }

    };

}();