module.exports = {

    params : [ 'data' ],

    bind   : function(){},

    unbind : function(){},

    update : function(){

        var data = JSON.parse( this.params.data );

        for( var key in data ) {
            if( !data.hasOwnProperty( key ) ) continue;

            this.el.__vue__.$set(
                key,
                data[ key ]
            );
        }

    }

}