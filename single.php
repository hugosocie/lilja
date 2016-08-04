<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package lilja
 */

get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div
            class="post"
            is="post"
            inline-template
            :palette="palette"
            :index.sync="index"
            :loading.sync="loading">

            <button
                class="close"
                v-on:click.prevent="loadArticle( '/' )">
            </button>

            <div class="content">

                <h1><?php the_title(); ?></h1>
                <p class="date"><?php the_date( 'd/m/Y' ); ?></p>
                <hr/>

                <div class="body">
                    <?php the_content(); ?>
                </div>

                <ul class="nav">
                    <li class="prev">
                        <?php $adj = get_adjacent_post( '', '', true );
                        if( !empty( $adj ) ): ?>
                            <a href="<?php the_permalink( $adj->ID ); ?>"
                                v-on:click.prevent="loadArticle( '<?php the_permalink( $adj->ID ); ?>' )">
                                <span><?= $adj ->post_title ?></span>
                            </a>
                        <?php else: ?>
                            <a href="/" v-on:click.prevent="loadArticle( '/' )">
                                <span>Retour</span>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li class="next">
                        <?php $adj = get_adjacent_post( '', '', false );
                        if( !empty( $adj ) ): ?>
                            <a href="<?php the_permalink( $adj->ID ); ?>"
                                v-on:click.prevent="loadArticle( '<?php the_permalink( $adj->ID ); ?>' )">
                                <span><?= $adj ->post_title ?></span>
                            </a>
                        <?php else: ?>
                            <a href="/" v-on:click.prevent="loadArticle( '/' )">
                                <span>Retour</span>
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>

                <?php if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif; ?>
            </div>

            <style>
                .post .close:hover:before, .post .close:hover:after,
                .comments .comment-header .picture { background : {{ color }}; }

                .post h1,
                .comments .title { color : {{ color }}; }

                .post hr { border-bottom-color : {{ color }}; }

                .post .body img { box-shadow : 0 10px 0 {{ color }}; }


                .comments .comment-form #author:focus,
                .comments .comment-form #email:focus,
                .comments .comment-form textarea:focus { border-color: {{ color }}; }

                .comments .comment-form #submit { background: {{ color }}; }

                .comments .comment-list li#comment-error,
                .comments .comment-list li#comment-pending { box-shadow: -10px 0 0 {{ color }}; }
            </style>

        </div>
    <?php endwhile; endif; ?>

<?php


get_footer();
