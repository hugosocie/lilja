<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lilja
 */

if( !isAjax() ): ?>


        </div><!-- #content -->

        <?php wp_footer(); ?>

    </body>
</html>
<?php else: ?>
    </div><!-- #content-ajax -->
<?php endif; ?>