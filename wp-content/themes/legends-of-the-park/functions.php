<?php
/**
 * Legends of the Park Theme functions and definitions.
 *
 * @package Legends_Of_The_Park
 */

define( 'LOP_THEME_VERSION', '1.0.0' );

define( 'LOP_THEME_DIR', get_template_directory() );
define( 'LOP_THEME_URI', get_template_directory_uri() );

require_once LOP_THEME_DIR . '/inc/gutenberg.php';

if ( ! function_exists( 'lop_theme_setup' ) ) {
/**
 * Theme setup.
 */
function lop_theme_setup() {
load_theme_textdomain( 'legends-of-the-park', LOP_THEME_DIR . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
add_theme_support( 'wp-block-styles' );
add_theme_support( 'editor-styles' );
add_editor_style( 'assets/css/main.css' );

register_nav_menus(
array(
'primary'   => __( 'Primary Menu', 'legends-of-the-park' ),
'community' => __( 'Community Menu', 'legends-of-the-park' ),
)
);
}
}
add_action( 'after_setup_theme', 'lop_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function lop_theme_scripts() {
wp_enqueue_style( 'lop-theme-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap', array(), null );
wp_enqueue_style( 'lop-theme-style', get_stylesheet_uri(), array( 'lop-theme-fonts' ), LOP_THEME_VERSION );
wp_enqueue_script( 'lop-theme-script', LOP_THEME_URI . '/assets/js/theme.js', array(), LOP_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'lop_theme_scripts' );

/**
 * Register widget areas.
 */
function lop_theme_widgets_init() {
register_sidebar(
array(
'name'          => __( 'Footer Widgets', 'legends-of-the-park' ),
'id'            => 'footer-1',
'description'   => __( 'Add Discord-styled widgets here to appear in your footer.', 'legends-of-the-park' ),
'before_widget' => '<div id="%1$s" class="widget %2$s discord-card">',
'after_widget'  => '</div>',
'before_title'  => '<h3 class="widget-title">',
'after_title'   => '</h3>',
)
);
}
add_action( 'widgets_init', 'lop_theme_widgets_init' );

/**
 * Add custom image sizes.
 */
function lop_theme_image_sizes() {
add_image_size( 'lop-hero', 1920, 1080, true );
add_image_size( 'lop-channel', 640, 360, true );
}
add_action( 'after_setup_theme', 'lop_theme_image_sizes' );

/**
 * Custom excerpt length.
 */
function lop_theme_excerpt_length( $length ) {
return 28;
}
add_filter( 'excerpt_length', 'lop_theme_excerpt_length', 999 );
