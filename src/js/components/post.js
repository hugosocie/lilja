module.exports = {

    replace : false,

    data : function(){
        return {
            'color' : null
        }
    },

    computed : {},

    props : [ 'palette', 'index', 'loading' ],

    watch : {
        palette : function(){
            this.updateColor();
        }
    },

    created : function(){},

    ready : function(){
        this.updateColor();
    },

    methods : {

        updateColor : function(){
            var i = this.index !== null ?
                this.index : 
                Math.round( Math.random() * 4 );

            this.color = '#' + this.palette[ i ];
            this.index = null;
        },

        loadArticle : function( url ){
            if( this.loading ) return;

            this.$root.loadContent( url );
        },
    },

    components : {
        'comments' : require( './comments.js' )
    }

}