<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lilja
 */

if( !isAjax() ):
    ?><!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
    	<meta charset="<?php bloginfo( 'charset' ); ?>">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="profile" href="http://gmpg.org/xfn/11">
    	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    	<?php wp_head(); ?>
    </head>

    <?php
        $i = 1;
        $palettes = array();
        while ( have_rows( 'slider', 4 ) ) : the_row();
            $palettes[ $i ] = array();
            while ( have_rows( 'slider_colors', 4 ) ) : the_row();
                array_push( $palettes[ $i ], get_sub_field( 'color' ) );
            endwhile;
            $i++;
        endwhile;

        $j = rand( 1, count( get_field( 'slider', 4 ) ) );
    ?>

    <body
        <?php body_class(); ?>
        id="app"
        v-data data='{
            "palettes" : <?= json_encode( $palettes ) ?>,
            "palette"  : <?= json_encode( $palettes[ $j ] ) ?>,
            "paletteindex" : <?= $j ?>
        }'>

        <div id="content">
<?php else: ?>
    <div id="content-ajax">
<?php endif; ?>