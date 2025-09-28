<?php
/**
 * Gutenberg editor enhancements for Legends of the Park theme.
 *
 * @package Legends_Of_The_Park
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

add_action( 'enqueue_block_editor_assets', 'lop_enqueue_block_editor_assets' );
/**
 * Enqueue editor styles and palette.
 */
function lop_enqueue_block_editor_assets() {
wp_enqueue_style( 'lop-editor-style', get_template_directory_uri() . '/assets/css/main.css', array(), LOP_THEME_VERSION );
}

add_action( 'after_setup_theme', 'lop_register_block_editor_settings' );
/**
 * Register custom color palette.
 */
function lop_register_block_editor_settings() {
add_theme_support( 'editor-color-palette', array(
array(
'name'  => __( 'Emerald Park', 'legends-of-the-park' ),
'slug'  => 'emerald',
'color' => '#228B22',
),
array(
'name'  => __( 'Sunset Rally', 'legends-of-the-park' ),
'slug'  => 'sunset',
'color' => '#FF8C00',
),
array(
'name'  => __( 'Calm Skies', 'legends-of-the-park' ),
'slug'  => 'calm-sky',
'color' => '#4682B4',
),
array(
'name'  => __( 'Discord Charcoal', 'legends-of-the-park' ),
'slug'  => 'charcoal',
'color' => '#2F3136',
),
) );
}
