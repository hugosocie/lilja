var translates = {
    'Please enter a valid email address.' : 'Merci de renseigner une adresse email valide.',
    'Please include all required arguments (name, email, content).' : 'Merci de renseigner tous les champs (pseudo, email, commentaire).'
};

module.exports = {

    replace : false,

    data : function(){
        return {
            'waiting' : [],
            'status'  : null,
            'message' : null
        }
    },

    computed : {},

    props : [],

    ready : function(){
        var _this = this;

        u( 'form' ).on( 'submit', function( e ){
            e.preventDefault();

            var $form = u( e.target );

            var url = document.location.origin,
                _params = $form.serialize();

            var post_id = $form.find( '#comment_post_ID' ).nodes[0].value,
                name    = $form.find( '#author' ).nodes[ 0 ].value,
                email   = $form.find( '#email' ).nodes[ 0 ].value,
                content = $form.find( '#comment' ).nodes[ 0 ].value;

            ajax( url, {
                'method' : 'POST',
                'body'   : {
                    'json'    : 'submit_comment',
                    'post_id' : post_id,
                    'name'    : name,
                    'email'   : email,
                    'content' : content

            } }, function( err, data ){
                var error_type = err + '';
                error_type = error_type.substring( 7, 10 );

                if( err ) {
                    _this.status = 'error';

                    if( error_type === '404' ) {
                        _this.message = translates[ data.error ];

                    } else if( error_type === '429' ) {
                        _this.message = 'Trop de spam, merci de patienter quelques instants...';

                    } else {
                        _this.message = 'Une erreur est survenue, merci de réessayer plus tard.';
                    }

                    return;
                }

                _this.status = data.status;
                _this.waiting.push( data );

            }, function( xhr ){
                xhr.responseType = 'json';
            });
        } )
    },

    methods : {

    }

}