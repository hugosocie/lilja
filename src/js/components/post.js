module.exports = {

    replace : false,

    data : function(){
        return {
            'color' : null
        }
    },

    computed : {},

    props : [ 'palette', 'index' ],

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
        }
    }

}