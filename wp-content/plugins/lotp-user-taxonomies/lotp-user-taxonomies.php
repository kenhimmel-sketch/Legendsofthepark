<?php
/**
 * Plugin Name: LotP User Taxonomies
 * Description: Registers user taxonomies for parks and skills and enforces a single favorite park selection.
 * Version: 1.0.0
 * Author: Legends of the Park
 */

declare(strict_types=1);

if (! defined('ABSPATH')) {
    exit;
}

add_action('init', static function (): void {
    // Park (single-select)
    register_taxonomy('lotp_park', 'user', [
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'labels'            => [
            'name'          => 'Parks',
            'singular_name' => 'Park',
        ],
        'capabilities'      => [
            'manage_terms' => 'edit_users',
            'edit_terms'   => 'edit_users',
            'delete_terms' => 'edit_users',
            'assign_terms' => 'read',
        ],
        'meta_box_cb'       => false,
    ]);

    // Skills (multi-select)
    register_taxonomy('lotp_skill', 'user', [
        'public'            => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'labels'            => [
            'name'          => 'Skills',
            'singular_name' => 'Skill',
        ],
        'capabilities'      => [
            'manage_terms' => 'edit_users',
            'edit_terms'   => 'edit_users',
            'delete_terms' => 'edit_users',
            'assign_terms' => 'read',
        ],
        'meta_box_cb'       => false,
    ]);
});

/**
 * Ensure only a single "favorite park" term is stored for a user.
 */
function lotp_keep_single_favorite_park(int $user_id): void
{
    $terms = wp_get_object_terms($user_id, 'lotp_park', [
        'fields'     => 'ids',
        'orderby'    => 'term_order',
        'order'      => 'ASC',
        'hide_empty' => false,
    ]);

    if (is_wp_error($terms) || count($terms) <= 1) {
        return;
    }

    $latest = array_pop($terms);

    if ($latest) {
        wp_set_object_terms($user_id, (int) $latest, 'lotp_park', false);
    }
}

add_action('profile_update', 'lotp_keep_single_favorite_park', 20, 1);
add_action('user_register', 'lotp_keep_single_favorite_park', 20, 1);
