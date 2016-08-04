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

        <?php if( have_rows( 'slider', 4 ) ):
            $i = 1;
            while ( have_rows( 'slider', 4 ) ) : the_row(); ?>
                <div
                    class="picture picture-<?= $i ?>"
                    v-bind:class="{ current : <?= $i ?> === current }"
                    style="background-image: url( '<?php the_sub_field( 'slider_picture' ); ?>' );"?>
                </div>
            <?php $i++;
            endwhile;
        endif; ?>

        <div class="layer"></div>

        <h1 class="valign-item"
            is="error"
            inline-template
            v-data data='{
                "dest_01" : "<?= get_field( 'destination_01' ) ?>",
                "dest_02" : "<?= get_field( 'destination_02' ) ?>",
                "and" : "&"
            }'>
            <?php
                echo '<span class="dest-01">{{ dest_01 }}</span>';
                echo '<span class="and">{{ and }}</span><br/>';
                echo '<span class="dest-02">{{ dest_02 }}</span>';
            ?>
        </h1>

        <div class="back-to-home">
            <a href="/">Retour à l'accueil</a>
        </div>
    </div>

<?php get_footer();
