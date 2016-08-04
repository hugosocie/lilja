var abc = 'aàâbcdeéèêfghijklmnopqrstuüvwxyz1234567890&?/%$*¥,;.+:!^()[]{}';

var results = [
    'erreur',
    '404',
    '!'
];

var timers = [
    null,
    null,
    null
];


module.exports = {

    replace : false,

    data : function(){
        return {
            dest_01 : null,
            dest_02 : null,
            and : null
        }
    },

    computed : {},

    props : [],

    ready : function(){

        var _this = this;

        setTimeout( function(){
            timers[ 0 ] = setInterval( function(){
                _this.randomize( 'dest_01', results[ 0 ], timers[ 0 ], abc );
            }, 25 );
            timers[ 0 ] = setInterval( function(){
                _this.randomize( 'dest_02', results[ 1 ], timers[ 1 ], abc );
            }, 25 );
            timers[ 0 ] = setInterval( function(){
                _this.randomize( 'and', results[ 2 ], timers[ 2 ], abc );
            }, 25 );
        }, 1000 );
        
    },

    methods : {

        randomize : function( dest, result, timer, txt ){

            var _this = this;

            if( _this[ dest ] == result ) {
                clearInterval( timer );
                return;
            }

            var r = Math.round( Math.random() * ( _this[ dest ].length - 1 ) ),
                n = Math.round( Math.random() * ( txt.length - 1 ) );   

            if( result.charAt( r ) == '' ) {

                var dice = Math.random();

                if( dice > 0.9 ) {
                    _this[ dest ] = _this[ dest ].substr( 0, r ) + _this[ dest ].substr( r + 1 );
                }
                
                return;
            }

            if( _this[ dest ].charAt( r ) == result.charAt( r ) ) {
                _this.randomize( dest, result, timer, txt );
                return;
            }

            _this[ dest ] = _this[ dest ].substr( 0, r ) + txt.charAt( n ) + _this[ dest ].substr( r + 1 );
        }
    }

}