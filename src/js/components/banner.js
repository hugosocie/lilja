module.exports = {

    replace : false,

    data : function(){
        return {
            'current' : null
        }
    },

    computed : {
        total : function(){
            return u( '#banner .picture' ).length;
        }
    },

    props : [ 'palettes', 'palette', 'timer', 'paletteindex' ],

    ready : function(){
        this.current = this.paletteindex;
        this.timer = setInterval( this.loop, 10000 );
    },

    methods : {
        loop : function(){
            this.current = this.current >= this.total ? 1 : this.current + 1;
            this.palette = this.palettes[ this.current ];
            this.paletteindex = this.current;
        }
    }

}