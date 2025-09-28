<?php
namespace LOP\Membership;

use WP_User_Query;

/**
 * Shortcodes for community features.
 */
class Shortcodes {
/**
 * Init hooks.
 */
public static function init() {
add_shortcode( 'lop_registration_form', array( __CLASS__, 'registration_form' ) );
add_shortcode( 'lop_member_profile', array( __CLASS__, 'member_profile' ) );
add_shortcode( 'lop_champions_leaderboard', array( __CLASS__, 'champions_leaderboard' ) );
add_shortcode( 'lop_parks_directory', array( __CLASS__, 'parks_directory' ) );
add_shortcode( 'lop_competition_signup', array( __CLASS__, 'competition_signup_form' ) );
add_shortcode( 'lop_events_feed', array( __CLASS__, 'events_feed' ) );
add_shortcode( 'lop_park_members', array( __CLASS__, 'park_members' ) );
add_shortcode( 'lop_park_champions', array( __CLASS__, 'park_champions' ) );

add_action( 'admin_post_nopriv_lop_register_member', array( __CLASS__, 'handle_member_registration' ) );
add_action( 'admin_post_lop_register_member', array( __CLASS__, 'handle_member_registration' ) );
add_action( 'admin_post_lop_competition_signup', array( __CLASS__, 'handle_competition_signup' ) );
add_action( 'admin_post_lop_profile_upload', array( __CLASS__, 'handle_profile_upload' ) );
}

/**
 * Render registration form.
 */
public static function registration_form() {
if ( is_user_logged_in() ) {
return '<div class="lop-notice lop-notice--success">' . esc_html__( 'You are already a member! Visit your profile below to update your park badges.', 'lop-membership' ) . '</div>' . self::member_profile();
}

$parks      = Registration::get_parks_options();
$skills     = Registration::get_skills();
$sports     = Registration::get_sports();
$error_code = isset( $_GET['lop_register_error'] ) ? sanitize_text_field( wp_unslash( $_GET['lop_register_error'] ) ) : '';
$success    = isset( $_GET['lop_register'] ) && 'success' === $_GET['lop_register'];

$errors = array(
'missing'  => __( 'Please complete all required fields.', 'lop-membership' ),
'exists'   => __( 'That username or email is already registered.', 'lop-membership' ),
'invalid'  => __( 'The passwords did not match.', 'lop-membership' ),
'unknown'  => __( 'We could not complete your registration. Please try again.', 'lop-membership' ),
);

ob_start();
if ( $success ) {
printf( '<div class="lop-notice lop-notice--success">%s</div>', esc_html__( 'Welcome to Legends of the Park! Check your email to set your password and hop into Discord.', 'lop-membership' ) );
} elseif ( $error_code && isset( $errors[ $error_code ] ) ) {
printf( '<div class="lop-notice lop-notice--error">%s</div>', esc_html( $errors[ $error_code ] ) );
}
?>
<form class="lop-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
<input type="hidden" name="action" value="lop_register_member" />
<?php wp_nonce_field( 'lop_register_member', 'lop_register_nonce' ); ?>
<div class="lop-form__row">
<label for="lop_username"><?php esc_html_e( 'Username', 'lop-membership' ); ?></label>
<input type="text" id="lop_username" name="lop_username" required />
</div>
<div class="lop-form__row">
<label for="lop_email"><?php esc_html_e( 'Email', 'lop-membership' ); ?></label>
<input type="email" id="lop_email" name="lop_email" required />
</div>
<div class="lop-form__row">
<label for="lop_password"><?php esc_html_e( 'Password', 'lop-membership' ); ?></label>
<input type="password" id="lop_password" name="lop_password" required />
</div>
<div class="lop-form__row">
<label for="lop_password_confirm"><?php esc_html_e( 'Confirm Password', 'lop-membership' ); ?></label>
<input type="password" id="lop_password_confirm" name="lop_password_confirm" required />
</div>
<div class="lop-form__row">
<label for="lop_favorite_park"><?php esc_html_e( 'Favorite Nevada Park', 'lop-membership' ); ?></label>
<select id="lop_favorite_park" name="lop_favorite_park" required>
<option value=""><?php esc_html_e( 'Select your park division', 'lop-membership' ); ?></option>
<?php foreach ( $parks as $division => $list ) : ?>
<optgroup label="<?php echo esc_attr( $division ); ?>">
<?php foreach ( $list as $park ) : ?>
<option value="<?php echo esc_attr( $park['name'] ); ?>"><?php echo esc_html( $park['name'] ); ?></option>
<?php endforeach; ?>
</optgroup>
<?php endforeach; ?>
</select>
</div>
<fieldset class="lop-form__row">
<legend><?php esc_html_e( 'Skills & Park Talents', 'lop-membership' ); ?></legend>
<?php foreach ( $skills as $skill ) : ?>
<label><input type="checkbox" name="lop_skills[]" value="<?php echo esc_attr( $skill ); ?>" /> <?php echo esc_html( $skill ); ?></label>
<?php endforeach; ?>
</fieldset>
<fieldset class="lop-form__row">
<legend><?php esc_html_e( 'Teams & Sports', 'lop-membership' ); ?></legend>
<?php foreach ( $sports as $sport ) : ?>
<label><input type="checkbox" name="lop_sports[]" value="<?php echo esc_attr( $sport ); ?>" /> <?php echo esc_html( $sport ); ?></label>
<?php endforeach; ?>
</fieldset>
<button type="submit" class="button-secondary"><?php esc_html_e( 'Become a Legend', 'lop-membership' ); ?></button>
<p class="lop-form__footnote"><a href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Join our Discord after registering', 'lop-membership' ); ?></a></p>
</form>
<?php
return ob_get_clean();
}

/**
 * Handle member registration form submission.
 */
public static function handle_member_registration() {
$redirect = wp_get_referer() ? wp_get_referer() : home_url();
if ( ! isset( $_POST['lop_register_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['lop_register_nonce'] ), 'lop_register_member' ) ) {
wp_safe_redirect( add_query_arg( 'lop_register_error', 'unknown', $redirect ) );
exit;
}

$username = isset( $_POST['lop_username'] ) ? sanitize_user( wp_unslash( $_POST['lop_username'] ) ) : '';
$email    = isset( $_POST['lop_email'] ) ? sanitize_email( wp_unslash( $_POST['lop_email'] ) ) : '';
$password = isset( $_POST['lop_password'] ) ? (string) $_POST['lop_password'] : '';
$confirm  = isset( $_POST['lop_password_confirm'] ) ? (string) $_POST['lop_password_confirm'] : '';

if ( empty( $username ) || empty( $email ) || empty( $password ) || empty( $confirm ) ) {
wp_safe_redirect( add_query_arg( 'lop_register_error', 'missing', $redirect ) );
exit;
}

if ( $password !== $confirm ) {
wp_safe_redirect( add_query_arg( 'lop_register_error', 'invalid', $redirect ) );
exit;
}

if ( username_exists( $username ) || email_exists( $email ) ) {
wp_safe_redirect( add_query_arg( 'lop_register_error', 'exists', $redirect ) );
exit;
}

$user_id = wp_insert_user(
array(
'user_login' => $username,
'user_email' => $email,
'user_pass'  => $password,
)
);

if ( is_wp_error( $user_id ) ) {
wp_safe_redirect( add_query_arg( 'lop_register_error', 'unknown', $redirect ) );
exit;
}

Registration::save_registration_fields( $user_id );

wp_safe_redirect( add_query_arg( 'lop_register', 'success', $redirect ) );
exit;
}

/**
 * Output member profile for logged in user.
 */
public static function member_profile() {
if ( ! is_user_logged_in() ) {
return '<div class="lop-notice">' . esc_html__( 'Log in to view your park profile and upload highlights.', 'lop-membership' ) . '</div>';
}

$user      = wp_get_current_user();
$favorite  = get_user_meta( $user->ID, 'lop_favorite_park', true );
$skills    = (array) get_user_meta( $user->ID, 'lop_skills', true );
$sports    = (array) get_user_meta( $user->ID, 'lop_sports', true );
$uploads   = (array) get_user_meta( $user->ID, 'lop_gallery_uploads', true );
$discord   = get_user_meta( $user->ID, 'lop_discord_handle', true );
$nonce     = wp_create_nonce( 'lop_profile_upload' );

ob_start();
?>
<div class="lop-profile">
<header class="lop-profile__header">
<h2><?php echo esc_html( $user->display_name ); ?></h2>
<?php if ( $favorite ) : ?>
<span class="badge blue"># <?php echo esc_html( $favorite ); ?></span>
<?php endif; ?>
</header>
<?php if ( $discord ) : ?>
<p class="lop-profile__discord"><?php printf( esc_html__( 'Discord: %s', 'lop-membership' ), esc_html( $discord ) ); ?></p>
<?php endif; ?>
<div class="lop-profile__badges">
<?php foreach ( $skills as $skill ) : ?>
<span class="badge green"><?php echo esc_html( $skill ); ?></span>
<?php endforeach; ?>
<?php foreach ( $sports as $sport ) : ?>
<span class="badge blue"><?php echo esc_html( $sport ); ?></span>
<?php endforeach; ?>
</div>
<form class="lop-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" enctype="multipart/form-data">
<input type="hidden" name="action" value="lop_profile_upload" />
<input type="hidden" name="lop_upload_nonce" value="<?php echo esc_attr( $nonce ); ?>" />
<div class="lop-form__row">
<label for="lop_discord_handle"><?php esc_html_e( 'Discord Handle', 'lop-membership' ); ?></label>
<input type="text" id="lop_discord_handle" name="lop_discord_handle" value="<?php echo esc_attr( $discord ); ?>" placeholder="Legend#0001" />
</div>
<div class="lop-form__row">
<label for="lop_profile_upload"><?php esc_html_e( 'Upload Park Highlight (image)', 'lop-membership' ); ?></label>
<input type="file" id="lop_profile_upload" name="lop_profile_upload" accept="image/*" />
</div>
<button type="submit" class="button-secondary"><?php esc_html_e( 'Save & Share', 'lop-membership' ); ?></button>
<a class="button-secondary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Share to Discord', 'lop-membership' ); ?></a>
</form>
<?php if ( ! empty( $uploads ) ) : ?>
<div class="lop-gallery">
<h3><?php esc_html_e( 'Your Park Uploads', 'lop-membership' ); ?></h3>
<div class="lop-gallery__grid">
<?php foreach ( $uploads as $attachment_id ) : ?>
<?php $url = wp_get_attachment_image_url( $attachment_id, 'medium' ); ?>
<?php if ( $url ) : ?>
<a href="<?php echo esc_url( wp_get_attachment_url( $attachment_id ) ); ?>" target="_blank" rel="noopener">
<img src="<?php echo esc_url( $url ); ?>" alt="" />
</a>
<?php endif; ?>
<?php endforeach; ?>
</div>
</div>
<?php endif; ?>
</div>
<?php
return ob_get_clean();
}

/**
 * Handle profile uploads and Discord handle saves.
 */
public static function handle_profile_upload() {
$redirect = wp_get_referer() ? wp_get_referer() : home_url();
if ( ! is_user_logged_in() ) {
wp_safe_redirect( $redirect );
exit;
}
if ( ! isset( $_POST['lop_upload_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['lop_upload_nonce'] ), 'lop_profile_upload' ) ) {
wp_safe_redirect( $redirect );
exit;
}

$user_id = get_current_user_id();

if ( isset( $_POST['lop_discord_handle'] ) ) {
update_user_meta( $user_id, 'lop_discord_handle', sanitize_text_field( wp_unslash( $_POST['lop_discord_handle'] ) ) );
}

if ( ! empty( $_FILES['lop_profile_upload']['name'] ) ) {
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$attachment_id = media_handle_upload( 'lop_profile_upload', 0 );
if ( ! is_wp_error( $attachment_id ) ) {
$uploads = (array) get_user_meta( $user_id, 'lop_gallery_uploads', true );
$uploads[] = $attachment_id;
update_user_meta( $user_id, 'lop_gallery_uploads', array_slice( $uploads, -12 ) );
}
}

wp_safe_redirect( $redirect );
exit;
}

/**
 * Champions leaderboard output.
 */
public static function champions_leaderboard() {
$divisions = get_terms(
array(
'taxonomy'   => 'lop_city_division',
'hide_empty' => false,
)
);

$leaderboard = array();
$champions   = get_posts(
array(
'post_type'      => 'lop_champion',
'posts_per_page' => -1,
)
);

foreach ( $champions as $champion ) {
$terms = wp_get_post_terms( $champion->ID, 'lop_city_division', array( 'fields' => 'names' ) );
$division = ! empty( $terms ) ? $terms[0] : __( 'Unassigned', 'lop-membership' );
$leaderboard[ $division ][] = $champion;
}

ob_start();
if ( empty( $leaderboard ) ) {
echo '<p>' . esc_html__( 'Champion stories will appear here after admins publish winners.', 'lop-membership' ) . '</p>';
} else {
foreach ( $leaderboard as $division => $items ) {
echo '<section class="lop-leaderboard">';
echo '<h3>' . esc_html( $division ) . '</h3>';
$count = 1;
foreach ( $items as $item ) {
$skill = get_post_meta( $item->ID, '_lop_skill', true );
$team  = get_post_meta( $item->ID, '_lop_team', true );
echo '<div class="leaderboard-item">';
echo '<span class="position">' . esc_html( '#' . $count ) . '</span>';
echo '<div><strong>' . esc_html( get_the_title( $item ) ) . '</strong><br /><span class="badge green">' . esc_html( $skill ) . '</span></div>';
echo '<span class="badge blue">' . esc_html( $team ) . '</span>';
echo '</div>';
$count++;
}
echo '</section>';
}
}
return ob_get_clean();
}

/**
 * Parks directory listing.
 */
public static function parks_directory() {
$parks = get_posts(
array(
'post_type'      => 'lop_park',
'posts_per_page' => -1,
'orderby'        => 'title',
'order'          => 'ASC',
)
);

if ( empty( $parks ) ) {
return '<p>' . esc_html__( 'Parks will appear here once the plugin is activated and data is seeded.', 'lop-membership' ) . '</p>';
}

ob_start();
?>
<div class="lop-directory">
<input type="search" data-lop-filter="lop-directory-list" placeholder="<?php esc_attr_e( 'Search parks…', 'lop-membership' ); ?>" class="button-secondary" />
<div id="lop-directory-list" class="lop-directory__grid">
<?php foreach ( $parks as $park ) : ?>
<?php $terms = wp_get_post_terms( $park->ID, 'lop_city_division', array( 'fields' => 'names' ) ); ?>
<article class="discord-card" data-lop-filterable>
<h3><a href="<?php echo esc_url( get_permalink( $park ) ); ?>"><?php echo esc_html( get_the_title( $park ) ); ?></a></h3>
<?php if ( ! empty( $terms ) ) : ?>
<span class="badge green"><?php echo esc_html( $terms[0] ); ?></span>
<?php endif; ?>
<p><?php echo esc_html( wp_trim_words( $park->post_excerpt ? $park->post_excerpt : $park->post_content, 24 ) ); ?></p>
<a class="button-secondary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Discuss on Discord', 'lop-membership' ); ?></a>
</article>
<?php endforeach; ?>
</div>
</div>
<?php
return ob_get_clean();
}

/**
 * Competition signup form for Champions Month.
 */
public static function competition_signup_form() {
if ( ! is_user_logged_in() ) {
return '<p>' . esc_html__( 'Log in to RSVP for Champions Month events.', 'lop-membership' ) . '</p>';
}

$user     = wp_get_current_user();
$skills   = Registration::get_skills();
$sports   = Registration::get_sports();
$favorite = get_user_meta( $user->ID, 'lop_favorite_park', true );
$nonce    = wp_create_nonce( 'lop_competition_signup' );

ob_start();
?>
<form class="lop-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
<input type="hidden" name="action" value="lop_competition_signup" />
<input type="hidden" name="lop_competition_nonce" value="<?php echo esc_attr( $nonce ); ?>" />
<div class="lop-form__row">
<label for="lop_competition_skill"><?php esc_html_e( 'Select Skill or Sport', 'lop-membership' ); ?></label>
<select id="lop_competition_skill" name="lop_entry_skill" required>
<option value=""><?php esc_html_e( 'Choose an option', 'lop-membership' ); ?></option>
<?php foreach ( array_merge( $skills, $sports ) as $option ) : ?>
<option value="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $option ); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="lop-form__row">
<label for="lop_competition_discord"><?php esc_html_e( 'Discord Handle', 'lop-membership' ); ?></label>
<input type="text" id="lop_competition_discord" name="lop_entry_discord" value="<?php echo esc_attr( get_user_meta( $user->ID, 'lop_discord_handle', true ) ); ?>" required />
</div>
<div class="lop-form__row">
<label for="lop_competition_team"><?php esc_html_e( 'Team or Division', 'lop-membership' ); ?></label>
<input type="text" id="lop_competition_team" name="lop_entry_team" value="<?php echo esc_attr( $favorite ); ?>" />
</div>
<button type="submit" class="button-secondary"><?php esc_html_e( 'Submit for Admin Review', 'lop-membership' ); ?></button>
<p class="lop-form__footnote"><?php esc_html_e( 'Admins approve entries within 24 hours. Watch the #champions-month channel for announcements.', 'lop-membership' ); ?></p>
</form>
<?php
return ob_get_clean();
}

/**
 * Handle competition signup submission.
 */
public static function handle_competition_signup() {
$redirect = wp_get_referer() ? wp_get_referer() : home_url();
if ( ! is_user_logged_in() ) {
wp_safe_redirect( $redirect );
exit;
}

if ( ! isset( $_POST['lop_competition_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['lop_competition_nonce'] ), 'lop_competition_signup' ) ) {
wp_safe_redirect( $redirect );
exit;
}

$user    = wp_get_current_user();
$skill   = isset( $_POST['lop_entry_skill'] ) ? sanitize_text_field( wp_unslash( $_POST['lop_entry_skill'] ) ) : '';
$team    = isset( $_POST['lop_entry_team'] ) ? sanitize_text_field( wp_unslash( $_POST['lop_entry_team'] ) ) : '';
$discord = isset( $_POST['lop_entry_discord'] ) ? sanitize_text_field( wp_unslash( $_POST['lop_entry_discord'] ) ) : '';
$park    = get_user_meta( $user->ID, 'lop_favorite_park', true );

if ( empty( $skill ) ) {
wp_safe_redirect( $redirect );
exit;
}

$post_id = wp_insert_post(
array(
'post_type'   => 'lop_competition_entry',
'post_status' => 'pending',
'post_title'  => sprintf( '%1$s - %2$s', $user->display_name, $skill ),
)
);

if ( ! is_wp_error( $post_id ) ) {
update_post_meta( $post_id, '_lop_entry_skill', $skill );
update_post_meta( $post_id, '_lop_entry_team', $team );
update_post_meta( $post_id, '_lop_entry_user', $user->user_login );
update_post_meta( $post_id, '_lop_entry_park', $park );
update_post_meta( $post_id, '_lop_entry_discord', $discord );
}

wp_safe_redirect( add_query_arg( 'lop_entry_submitted', '1', $redirect ) );
exit;
}

/**
 * Events feed output.
 */
public static function events_feed() {
$events = get_posts(
array(
'post_type'      => 'lop_event',
'posts_per_page' => 6,
'orderby'        => 'meta_value',
'order'          => 'ASC',
'meta_key'       => '_lop_event_start',
'meta_type'      => 'DATETIME',
)
);

if ( empty( $events ) ) {
return '<p>' . esc_html__( 'Add events in the dashboard to populate the calendar feed.', 'lop-membership' ) . '</p>';
}

ob_start();
?>
<ul class="lop-events">
<?php foreach ( $events as $event ) : ?>
<?php
$start   = get_post_meta( $event->ID, '_lop_event_start', true );
$discord = get_post_meta( $event->ID, '_lop_event_discord', true );
$datetime = $start ? gmdate( 'F j, Y g:i A T', strtotime( $start ) ) : '';
?>
<li>
<strong><?php echo esc_html( get_the_title( $event ) ); ?></strong>
<?php if ( $datetime ) : ?>
<span class="lop-event__time"><?php echo esc_html( $datetime ); ?></span>
<?php endif; ?>
<div class="lop-event__excerpt"><?php echo esc_html( wp_trim_words( $event->post_excerpt ? $event->post_excerpt : $event->post_content, 22 ) ); ?></div>
<?php if ( $discord ) : ?>
<a class="button-secondary" href="<?php echo esc_url( $discord ); ?>" target="_blank" rel="noopener"># <?php esc_html_e( 'RSVP in Discord', 'lop-membership' ); ?></a>
<?php else : ?>
<a class="button-secondary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Join Voice Lobby', 'lop-membership' ); ?></a>
<?php endif; ?>
</li>
<?php endforeach; ?>
</ul>
<?php
return ob_get_clean();
}

/**
 * Output members for the current park.
 */
public static function park_members() {
$park = get_the_title();
$query = new WP_User_Query(
array(
'meta_key'   => 'lop_favorite_park',
'meta_value' => $park,
)
);

$members = $query->get_results();
if ( empty( $members ) ) {
return '<p>' . esc_html__( 'No members have claimed this park yet. Invite your friends from Discord!', 'lop-membership' ) . '</p>';
}

ob_start();
echo '<ul class="lop-members">';
foreach ( $members as $member ) {
$skills = (array) get_user_meta( $member->ID, 'lop_skills', true );
$badge  = ! empty( $skills ) ? $skills[0] : __( 'Park Legend', 'lop-membership' );
echo '<li><strong>' . esc_html( $member->display_name ) . '</strong> <span class="badge green">' . esc_html( $badge ) . '</span></li>';
}
echo '</ul>';
return ob_get_clean();
}

/**
 * Output champions for the current park.
 */
public static function park_champions() {
$park = get_the_title();
$champions = get_posts(
array(
'post_type'      => 'lop_champion',
'posts_per_page' => 5,
'meta_key'       => '_lop_park',
'meta_value'     => $park,
)
);

if ( empty( $champions ) ) {
return '<p>' . esc_html__( 'Champions will appear after July competitions conclude.', 'lop-membership' ) . '</p>';
}

ob_start();
echo '<ul class="lop-champions">';
foreach ( $champions as $champion ) {
$skill = get_post_meta( $champion->ID, '_lop_skill', true );
$team  = get_post_meta( $champion->ID, '_lop_team', true );
echo '<li><strong>' . esc_html( get_the_title( $champion ) ) . '</strong> <span class="badge blue">' . esc_html( $skill ) . '</span> <span class="badge green">' . esc_html( $team ) . '</span></li>';
}
echo '</ul>';
return ob_get_clean();
}
}
