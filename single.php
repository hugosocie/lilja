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
            :index="index">

            <div class="content">
                <h1><?php the_title(); ?></h1>
                <p class="date"><?php the_date( 'd/m/Y' ); ?></p>
                <hr/>

                <div class="body">
                    <?php the_content(); ?>
                </div>
            </div>

            <style>
                .post h1 { color : {{ color }}; }
                .post hr { border-bottom-color : {{ color }}; }
                .post .body img { box-shadow : 0 10px 0 {{ color }}; }
            </style>

        </div>
    <?php endwhile; endif; ?>

<?php


get_footer();
