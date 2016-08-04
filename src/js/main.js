// Register Directives
// ==========================================================================

Vue.directive( 'data', require( './directives/v-data.js' ) );



// Register Global components
// ==========================================================================

//Vue.component( 'example-02', require( './components/example-02.vue' ) );



// Main Vue App
// ==========================================================================

new Vue({

    el: '#app',

    data : {
        palettes : null,
        palette  : null,
        paletteindex : null,
        index    : null,
        loading  : true,
        bannerTimer : 0
    },

    computed : {},

    created : function(){},

    ready : function(){
        this.loading = false;
        u( this.$el ).removeClass( 'not-ready' );

        var _this = this;

        // Add setTimeout to avoid Safari to launch "onpopstate" on load
        setTimeout(function() {
            window.onpopstate = function( event ) {
                _this.loadContent( document.location.href );
            };
        }, 300);
    },

    methods : {

        vajax : function( url, params, callback ){
            var _this = this;

            ajax( url, params, function( err, data ){
                if( typeof callback !== 'function' ) return;

                callback( err, data );

                _this.loading = false;
                _this.$compile( _this.$el );

                if( typeof window.history.pushState === 'function' ) {
                    window.history.pushState( {}, 'lilja', url );
                }

                if( window.innerWidth <= 768 ) {
                    u( 'body' ).scroll();
                }

            }, function(){
                _this.loading = true;
            });
        },

        loadContent : function( url ){

            if( typeof url !== 'string' ) return;
            if( this.loading === true ) return;

            var _this = this;
            this.loading = true;

            this.vajax( url, {}, function( err, data ){
                if( err ) return;

                clearInterval( _this.bannerTimer );

                var $old = u( '#content' );

                $old.before( data );

                var $new = u( '#content-ajax' );

                setTimeout( function(){
                    $new.addClass( 'visible' );
                }, 15 );

                setTimeout( function(){
                    $old.remove();
                    $new.attr( 'id', 'content' );
                }, 600 );
            });
        }

    },

    components : {
        'banner' : require( './components/banner.js' ),
        'posts'  : require( './components/posts.js' ),
        'post'   : require( './components/post.js' )
    }

});