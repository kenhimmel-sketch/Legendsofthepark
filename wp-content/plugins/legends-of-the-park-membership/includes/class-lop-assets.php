<?php
namespace LOP\Membership;

/**
 * Handle plugin assets.
 */
class Assets {
/**
 * Initialize hooks.
 */
public static function init() {
add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
}

/**
 * Enqueue frontend assets.
 */
public static function enqueue() {
wp_enqueue_style( 'lop-membership', LOP_MEMBERSHIP_URL . 'assets/css/membership.css', array(), LOP_MEMBERSHIP_VERSION );
wp_enqueue_script( 'lop-membership', LOP_MEMBERSHIP_URL . 'assets/js/membership.js', array( 'jquery' ), LOP_MEMBERSHIP_VERSION, true );
wp_localize_script(
'lop-membership',
'lopMembership',
array(
'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
'nonce'        => wp_create_nonce( 'lop-membership-nonce' ),
'entrySuccess' => __( 'Thanks! Your Champions Month signup is pending admin approval.', 'lop-membership' ),
)
);
}
}
