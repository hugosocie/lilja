<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lilja
 */

get_header(); ?>

    <div
        id="banner"
        is="banner"
        inline-template
        class="valign-container"
        :palette.sync="palette"
        :palettes="palettes"
        :timer.sync="bannerTimer"
        :paletteindex.sync="paletteindex">

        <?php if( have_rows( 'slider' ) ):
            $i = 1;
            while ( have_rows( 'slider' ) ) : the_row(); ?>
                <div
                    class="picture picture-<?= $i ?>"
                    v-bind:class="{ current : <?= $i ?> === current }"
                    style="background-image: url( '<?php the_sub_field( 'slider_picture' ); ?>' );"?>
                </div>
            <?php $i++;
            endwhile;
        endif; ?>

        <div class="layer"></div>

        <h1 class="valign-item">
            <?php
                echo '<span class="dest-01">' . get_field( 'destination_01' ) . '</span>';
                echo '<span class="and">&</span><br/>';
                echo '<span class="dest-02">' . get_field( 'destination_02' ) . '</span>';
            ?>
        </h1>

    </div>

    <section id="posts">
        <?php $c = $s = 0;
        $larges = array( 1, 3, 8 );

        $news = new WP_Query( array( 
            'post_type' => 'post',
            'orderby' => 'date',
            'order' => 'DESC'
        ) );

        foreach ( $news->posts as $post ): setup_postdata( $post ); ?>

            <article
                class="<?= in_array( $s, $larges ) ? 'large' : '' ?> link"
                is="posts"
                inline-template
                :palette="palette"
                :loading="loading"
                :articleindex.sync="index"
                index="<?= $c; ?>">

                <div
                    class="fake-link"
                    v-on:click="loadArticle( '<?php the_permalink(); ?>', <?= $c ?> )">

                    <header
                        v-bind:style="{ backgroundColor: color }">
                        <h2>
                            <a href="<?php the_permalink(); ?>"
                                v-on:click.prevent>
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        <p class="date"><?= date( 'd/m/Y', strtotime( $post->post_date ) ); ?></p>
                    </header>

                    <?php if ( has_post_thumbnail() ):
                        $img = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
                    else:
                        $img = catch_that_image();
                    endif; ?>

                    <div
                        class="picture"
                        v-el:picture
                        style="background-image: url( '<?= $img ?>' )">
                        <img v-if="false" src="<?= $img ?>">
                    </div>

                    <div class="layer"
                        v-bind:class="{ 'is-loading': isLoading }">

                        <svg
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" 
                            x="0px" y="0px"
                            width="60px" height="60px"
                            viewBox="0 0 50 50"
                            xml:space="preserve">
                            <path
                                v-bind:style="{ fill: isLoading ? color : 'transparent' }"
                                d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z" transform="rotate(300.026 25 25)">
                                <animateTransform
                                    attributeType="xml"
                                    attributeName="transform"
                                    type="rotate"
                                    from="0 25 25"
                                    to="360 25 25"
                                    dur="1s"
                                    repeatCount="indefinite">
                                </animateTransform>
                            </path>
                        </svg>
                    </div>
                </div>
            </article>

            <?php $c++; $s++;
            if( $c >= 5 ) $c = 0;
            if( $s >= 9 ) $s = 0;

            wp_reset_postdata();
        endforeach;

        $l = $s > 3 ? $s - 3 : $s;
        for( $i = 0; $i < 3 - $l ; $i++ ): ?>

            <article
                class="<?= in_array( $s, $larges ) ? 'large' : '' ?> empty"
                is="posts"
                inline-template
                :palette="palette"
                index="<?= $c; ?>">
                <div
                    class="empty"
                    v-bind:style="{ backgroundColor: color }">
                </div>
            </article>

            <?php $c++; $s++;
            if( $c >= 5 ) $c = 0;
            if( $s >= 9 ) $s = 0;

        endfor;
        ?>

    </section>

<?php get_footer();
