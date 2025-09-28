<?php
namespace LOP\Membership;

/**
 * Handle membership registration fields.
 */
class Registration {
/**
 * Initialize hooks.
 */
public static function init() {
add_action( 'register_form', array( __CLASS__, 'render_registration_fields' ) );
add_action( 'user_register', array( __CLASS__, 'save_registration_fields' ) );
add_action( 'show_user_profile', array( __CLASS__, 'render_profile_fields' ) );
add_action( 'edit_user_profile', array( __CLASS__, 'render_profile_fields' ) );
add_action( 'personal_options_update', array( __CLASS__, 'save_profile_fields' ) );
add_action( 'edit_user_profile_update', array( __CLASS__, 'save_profile_fields' ) );
}

/**
 * Get park options grouped by division.
 */
public static function get_parks_options() {
$parks = include LOP_MEMBERSHIP_DIR . 'data/parks.php';
return is_array( $parks ) ? $parks : array();
}

/**
 * Return available skill badges.
 */
public static function get_skills() {
return array(
'Park Photographer',
'Park Runner',
'Park Dog Mom',
'Park Naturalist',
'Park Coach',
'Trail Steward',
'Community Gardener',
'Cleanup Captain',
);
}

/**
 * Return available sports.
 */
public static function get_sports() {
return array(
'Softball',
'Volleyball',
'Pickleball',
'Ultimate Frisbee',
'Basketball',
'Run Club',
'Disc Golf',
'Fitness Bootcamp',
);
}

/**
 * Render additional registration fields.
 */
public static function render_registration_fields() {
$parks = self::get_parks_options();
?>
<p>
<label for="lop_favorite_park"><?php esc_html_e( 'Favorite Nevada Park', 'lop-membership' ); ?></label>
<select name="lop_favorite_park" id="lop_favorite_park">
<option value=""><?php esc_html_e( 'Select your home park', 'lop-membership' ); ?></option>
<?php foreach ( $parks as $division => $items ) : ?>
<optgroup label="<?php echo esc_attr( $division ); ?>">
<?php foreach ( $items as $park ) : ?>
<option value="<?php echo esc_attr( $park['name'] ); ?>"><?php echo esc_html( $park['name'] ); ?></option>
<?php endforeach; ?>
</optgroup>
<?php endforeach; ?>
</select>
</p>
<p>
<label><?php esc_html_e( 'Skills & Park Talents', 'lop-membership' ); ?></label><br />
<?php foreach ( self::get_skills() as $skill ) : ?>
<label class="lop-checkbox"><input type="checkbox" name="lop_skills[]" value="<?php echo esc_attr( $skill ); ?>" /> <?php echo esc_html( $skill ); ?></label><br />
<?php endforeach; ?>
</p>
<p>
<label><?php esc_html_e( 'Teams & Sports', 'lop-membership' ); ?></label><br />
<?php foreach ( self::get_sports() as $sport ) : ?>
<label class="lop-checkbox"><input type="checkbox" name="lop_sports[]" value="<?php echo esc_attr( $sport ); ?>" /> <?php echo esc_html( $sport ); ?></label><br />
<?php endforeach; ?>
</p>
<?php
}

/**
 * Save fields on registration.
 */
public static function save_registration_fields( $user_id ) {
if ( isset( $_POST['lop_favorite_park'] ) ) {
update_user_meta( $user_id, 'lop_favorite_park', sanitize_text_field( wp_unslash( $_POST['lop_favorite_park'] ) ) );
}
if ( isset( $_POST['lop_skills'] ) ) {
$skills = array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['lop_skills'] ) );
update_user_meta( $user_id, 'lop_skills', $skills );
}
if ( isset( $_POST['lop_sports'] ) ) {
$sports = array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['lop_sports'] ) );
update_user_meta( $user_id, 'lop_sports', $sports );
}
}

/**
 * Render profile fields in admin.
 */
public static function render_profile_fields( $user ) {
$parks   = self::get_parks_options();
$skills  = (array) get_user_meta( $user->ID, 'lop_skills', true );
$sports  = (array) get_user_meta( $user->ID, 'lop_sports', true );
$favorite = get_user_meta( $user->ID, 'lop_favorite_park', true );
$uploads = (array) get_user_meta( $user->ID, 'lop_gallery_uploads', true );
?>
<h2><?php esc_html_e( 'Legends of the Park Membership', 'lop-membership' ); ?></h2>
<table class="form-table" role="presentation">
<tr>
<th><label for="lop_favorite_park"><?php esc_html_e( 'Favorite Nevada Park', 'lop-membership' ); ?></label></th>
<td>
<select name="lop_favorite_park" id="lop_favorite_park">
<option value=""><?php esc_html_e( 'Select your home park', 'lop-membership' ); ?></option>
<?php foreach ( $parks as $division => $items ) : ?>
<optgroup label="<?php echo esc_attr( $division ); ?>">
<?php foreach ( $items as $park ) : ?>
<option value="<?php echo esc_attr( $park['name'] ); ?>" <?php selected( $favorite, $park['name'] ); ?>><?php echo esc_html( $park['name'] ); ?></option>
<?php endforeach; ?>
</optgroup>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr>
<th><?php esc_html_e( 'Skills', 'lop-membership' ); ?></th>
<td>
<?php foreach ( self::get_skills() as $skill ) : ?>
<label><input type="checkbox" name="lop_skills[]" value="<?php echo esc_attr( $skill ); ?>" <?php checked( in_array( $skill, $skills, true ), true ); ?> /> <?php echo esc_html( $skill ); ?></label><br />
<?php endforeach; ?>
</td>
</tr>
<tr>
<th><?php esc_html_e( 'Sports', 'lop-membership' ); ?></th>
<td>
<?php foreach ( self::get_sports() as $sport ) : ?>
<label><input type="checkbox" name="lop_sports[]" value="<?php echo esc_attr( $sport ); ?>" <?php checked( in_array( $sport, $sports, true ), true ); ?> /> <?php echo esc_html( $sport ); ?></label><br />
<?php endforeach; ?>
</td>
</tr>
<?php if ( ! empty( $uploads ) ) : ?>
<tr>
<th><?php esc_html_e( 'Park Uploads', 'lop-membership' ); ?></th>
<td>
<ul>
<?php foreach ( $uploads as $attachment_id ) : ?>
<li><a href="<?php echo esc_url( wp_get_attachment_url( $attachment_id ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( get_the_title( $attachment_id ) ); ?></a></li>
<?php endforeach; ?>
</ul>
</td>
</tr>
<?php endif; ?>
</table>
<?php
}

/**
 * Save profile fields in admin.
 */
public static function save_profile_fields( $user_id ) {
if ( isset( $_POST['lop_favorite_park'] ) ) {
update_user_meta( $user_id, 'lop_favorite_park', sanitize_text_field( wp_unslash( $_POST['lop_favorite_park'] ) ) );
}
$skills = isset( $_POST['lop_skills'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['lop_skills'] ) ) : array();
$sports = isset( $_POST['lop_sports'] ) ? array_map( 'sanitize_text_field', (array) wp_unslash( $_POST['lop_sports'] ) ) : array();
update_user_meta( $user_id, 'lop_skills', $skills );
update_user_meta( $user_id, 'lop_sports', $sports );
}
}
