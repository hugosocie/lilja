module.exports = {

    replace : false,

    data : function(){
        return {
            'isLoading' : false,
            'color' : null
        }
    },

    computed : {},

    props : [
        'palette',
        'index',
        'loading',
        'articleindex'
    ],

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

        loadArticle : function( url, index ){
            if( this.loading ) return;

            this.isLoading = true;
            this.$root.loadContent( url );
            this.articleindex = index;
        },

        updateColor : function(){
            this.color = '#' + this.palette[ this.index ];
        }

    }

}