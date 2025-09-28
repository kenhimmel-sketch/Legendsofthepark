<?php
namespace LOP\Membership;

/**
 * Admin utilities for Legends of the Park.
 */
class Admin {
/**
 * Init hooks.
 */
public static function init() {
add_action( 'admin_menu', array( __CLASS__, 'register_menu' ) );
add_filter( 'manage_lop_competition_entry_posts_columns', array( __CLASS__, 'entries_columns' ) );
add_action( 'manage_lop_competition_entry_posts_custom_column', array( __CLASS__, 'entries_column_content' ), 10, 2 );
}

/**
 * Register dashboard menu.
 */
public static function register_menu() {
add_menu_page(
__( 'Legends of the Park', 'lop-membership' ),
__( 'Legends of the Park', 'lop-membership' ),
'manage_options',
'lop-dashboard',
array( __CLASS__, 'render_dashboard' ),
'dashicons-hammer',
3
);
}

/**
 * Render admin dashboard page.
 */
public static function render_dashboard() {
$parks_count      = wp_count_posts( 'lop_park' );
$champions_count  = wp_count_posts( 'lop_champion' );
$events_count     = wp_count_posts( 'lop_event' );
$pending_entries  = wp_count_posts( 'lop_competition_entry' );
$members          = count_users();
$discord_link     = 'https://discord.gg/25bXKqSN';
?>
<div class="wrap lop-admin">
<h1><?php esc_html_e( 'Legends of the Park Control Center', 'lop-membership' ); ?></h1>
<p><?php esc_html_e( 'Review park rosters, approve Champions Month entries, and sync updates with the Discord community.', 'lop-membership' ); ?></p>
<div class="lop-admin__grid">
<div class="lop-admin__card">
<h2><?php esc_html_e( 'Parks Published', 'lop-membership' ); ?></h2>
<p class="lop-admin__metric"><?php echo esc_html( $parks_count ? $parks_count->publish : 0 ); ?></p>
<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=lop_park' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Manage Parks', 'lop-membership' ); ?></a>
</div>
<div class="lop-admin__card">
<h2><?php esc_html_e( 'Champions Stories', 'lop-membership' ); ?></h2>
<p class="lop-admin__metric"><?php echo esc_html( $champions_count ? $champions_count->publish : 0 ); ?></p>
<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=lop_champion' ) ); ?>" class="button"><?php esc_html_e( 'Highlight Winners', 'lop-membership' ); ?></a>
</div>
<div class="lop-admin__card">
<h2><?php esc_html_e( 'Upcoming Events', 'lop-membership' ); ?></h2>
<p class="lop-admin__metric"><?php echo esc_html( $events_count ? $events_count->publish : 0 ); ?></p>
<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=lop_event' ) ); ?>" class="button"><?php esc_html_e( 'Schedule Calendar', 'lop-membership' ); ?></a>
</div>
<div class="lop-admin__card">
<h2><?php esc_html_e( 'Pending Entries', 'lop-membership' ); ?></h2>
<p class="lop-admin__metric"><?php echo esc_html( $pending_entries ? $pending_entries->pending : 0 ); ?></p>
<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=lop_competition_entry' ) ); ?>" class="button button-secondary"><?php esc_html_e( 'Review Signups', 'lop-membership' ); ?></a>
</div>
</div>
<div class="lop-admin__panel">
<h2><?php esc_html_e( 'Membership Snapshot', 'lop-membership' ); ?></h2>
<ul>
<li><?php printf( esc_html__( '%1$s total members with %2$s active today.', 'lop-membership' ), number_format_i18n( $members['total_users'] ), number_format_i18n( $members['avail_roles']['subscriber'] ?? 0 ) ); ?></li>
<li><?php esc_html_e( 'Encourage members to add Discord handles via the profile upload form.', 'lop-membership' ); ?></li>
<li><a href="<?php echo esc_url( $discord_link ); ?>" target="_blank" rel="noopener"># <?php esc_html_e( 'Open Discord Control Panel', 'lop-membership' ); ?></a></li>
</ul>
</div>
</div>
<?php
}

/**
 * Customize admin columns for entries.
 */
public static function entries_columns( $columns ) {
$columns['lop_entry_skill']   = __( 'Skill / Sport', 'lop-membership' );
$columns['lop_entry_park']    = __( 'Park', 'lop-membership' );
$columns['lop_entry_discord'] = __( 'Discord', 'lop-membership' );
return $columns;
}

/**
 * Render admin column values.
 */
public static function entries_column_content( $column, $post_id ) {
switch ( $column ) {
case 'lop_entry_skill':
echo esc_html( get_post_meta( $post_id, '_lop_entry_skill', true ) );
break;
case 'lop_entry_park':
echo esc_html( get_post_meta( $post_id, '_lop_entry_park', true ) );
break;
case 'lop_entry_discord':
echo esc_html( get_post_meta( $post_id, '_lop_entry_discord', true ) );
break;
}
}
}
