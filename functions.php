<?php
/**
 * lilja functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lilja
 */

if ( ! function_exists( 'lilja_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lilja_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on lilja, use a find and replace
     * to change 'lilja' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'lilja', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'lilja' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'lilja_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );
}
endif;
add_action( 'after_setup_theme', 'lilja_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lilja_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'lilja_content_width', 640 );
}
add_action( 'after_setup_theme', 'lilja_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lilja_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'lilja' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'lilja' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'lilja_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lilja_scripts() {
    wp_enqueue_style(
        'lilja-style',
        get_template_directory_uri() . '/dist/css/main.css'
    );

    wp_enqueue_script(
        'lilja-libs',
        get_template_directory_uri() . '/dist/js/libs.js',
        array(), '20160707', true
    );

    wp_enqueue_script(
        'lilja-main',
        get_template_directory_uri() . '/dist/js/main.js',
        array(), '20160707', true
    );
}
add_action( 'wp_enqueue_scripts', 'lilja_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';




/**
 * Ajax function Helper => return true if Ajax
 */
function isAjax(){
    if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
        return true;
    } else { return false; }
};


function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    return $first_img;
}


function custom_comments($comment, $args, $depth) {
    $tag= 'li';

    if( $comment->comment_approved === '1' ): ?>

    <<?php echo $tag ?> id="comment-<?php comment_ID() ?>">

        <div class="comment-header">
            <div class="picture">
                <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
            </div>
            <div class="text">
                <p class="user-name"><?= get_comment_author() ?></p>
                <div class="comment-meta commentmetadata">
                    <?php printf( __('%1$s'), get_comment_date(), get_comment_time() ); ?>
                </div>
            </div>

            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
                <br />
            <?php endif; ?>
        </div>

        <div class="comment-body">
            <?php comment_text(); ?>
        </div>

    </<?php echo $tag ?>>

    <?php endif;
}

function wpb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields[ 'comment' ];
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;

    return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );