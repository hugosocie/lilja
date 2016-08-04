<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lilja
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments"
	is="comments"
	inline-template>

	<h2 class="title">
		<?= get_comments_number() ?>
		<?= get_comments_number() > 1 ? 'Commentaires' : 'Commentaire' ?>
	</h2>

	<?php if ( comments_open() ) : ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 50,
					'callback' => custom_comments
				) );
			?>

    		<li id="comment-pending"
    			v-for="message in waiting">

        		<div class="comment-header">
	           		<div class="picture"></div>
		            <div class="text">
		                <p class="user-name">{{ message.name }}</p>
		                <div class="comment-meta commentmetadata">À l'instant</div>
		            </div>
	            </div>

	            <p class="comment-waiting">En attente de validation.</p>

		        <div class="comment-body">
		            {{{ message.content }}}
		        </div>
    		</li>

			<li id="comment-error"
				v-if="status === 'error'">
		        <div class="comment-body">
		            <p>{{ message }}</p>
		        </div>
    		</li>

		</ol><!-- .comment-list -->

	<?php endif; // Check for have_comments().


	comment_form( array(
		'title_reply' => null,
		'fields' => array(
			'author' =>
			    '<input id="author"
			    	placeholder="Pseudonyme"
			    	name="author"
			    	type="text"
			    	value="' . esc_attr( $commenter[ 'comment_author' ] ) . '"
			    	' . $aria_req . ' />',

			  'email' =>
			    '<input id="email"
			    	placeholder="Email"
			    	name="email" 
			    	type="text"
			    	value="' . esc_attr(  $commenter[ 'comment_author_email' ] ) . '"
			    	' . $aria_req . ' />'
		),
		'comment_field' => '<textarea placeholder="Commentaire" id="comment" name="comment" aria-required="true"></textarea>',
		'comment_notes_before' => null,
		'comment_notes_after' => '<p class="comment-notes">' .
    		'Votre adresse email ne sera pas publiée.<br/>Tous les commentaires requiert une validation de notre part pour être affichés afin d\'éviter tous propos déplacés.' .
    	'</p>',
	) );
	?>

</div><!-- #comments -->
