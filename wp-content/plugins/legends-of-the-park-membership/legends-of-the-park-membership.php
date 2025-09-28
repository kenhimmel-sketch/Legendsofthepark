<?php
/**
 * Plugin Name: Legends of the Park Membership
 * Plugin URI: https://legendsofthepark.example.com
 * Description: Membership tools, park directory, and Champions Month management for the Legends of the Park community.
 * Version: 1.0.0
 * Author: Legends of the Park
 * Author URI: https://legendsofthepark.example.com
 * Text Domain: lop-membership
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
}

define( 'LOP_MEMBERSHIP_VERSION', '1.0.0' );
define( 'LOP_MEMBERSHIP_DIR', plugin_dir_path( __FILE__ ) );
define( 'LOP_MEMBERSHIP_URL', plugin_dir_url( __FILE__ ) );

require_once LOP_MEMBERSHIP_DIR . 'includes/class-lop-assets.php';
require_once LOP_MEMBERSHIP_DIR . 'includes/class-lop-custom-post-types.php';
require_once LOP_MEMBERSHIP_DIR . 'includes/class-lop-registration.php';
require_once LOP_MEMBERSHIP_DIR . 'includes/class-lop-shortcodes.php';
require_once LOP_MEMBERSHIP_DIR . 'includes/class-lop-admin.php';

/**
 * Initialize plugin components.
 */
function lop_membership_init() {
load_plugin_textdomain( 'lop-membership', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
\LOP\Membership\Assets::init();
\LOP\Membership\Custom_Post_Types::init();
\LOP\Membership\Registration::init();
\LOP\Membership\Shortcodes::init();
\LOP\Membership\Admin::init();
}
add_action( 'plugins_loaded', 'lop_membership_init' );

register_activation_hook( __FILE__, '\\LOP\\Membership\\Custom_Post_Types::activate' );
