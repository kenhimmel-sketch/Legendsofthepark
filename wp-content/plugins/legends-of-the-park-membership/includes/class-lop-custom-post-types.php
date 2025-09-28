<?php
namespace LOP\Membership;

/**
 * Register custom post types and related meta.
 */
class Custom_Post_Types {
/**
 * Boot hooks.
 */
public static function init() {
add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
add_action( 'init', array( __CLASS__, 'register_post_types' ) );
add_action( 'add_meta_boxes', array( __CLASS__, 'register_meta_boxes' ) );
add_action( 'save_post', array( __CLASS__, 'save_meta' ), 10, 2 );
}

/**
 * Register city division taxonomy.
 */
public static function register_taxonomies() {
register_taxonomy(
'lop_city_division',
array( 'lop_park', 'lop_champion' ),
array(
'label'        => __( 'City Divisions', 'lop-membership' ),
'public'       => true,
'hierarchical' => false,
'show_in_rest' => true,
)
);
}

/**
 * Register custom post types.
 */
public static function register_post_types() {
register_post_type(
'lop_park',
array(
'label'           => __( 'Parks', 'lop-membership' ),
'public'          => true,
'menu_icon'       => 'dashicons-location-alt',
'supports'        => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
'show_in_rest'    => true,
'has_archive'     => true,
'rewrite'         => array( 'slug' => 'parks' ),
)
);

register_post_type(
'lop_champion',
array(
'label'        => __( 'Champions', 'lop-membership' ),
'public'       => true,
'menu_icon'    => 'dashicons-awards',
'supports'     => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
'show_in_rest' => true,
)
);

register_post_type(
'lop_event',
array(
'label'           => __( 'Events', 'lop-membership' ),
'public'          => true,
'menu_icon'       => 'dashicons-calendar-alt',
'supports'        => array( 'title', 'editor', 'excerpt' ),
'show_in_rest'    => true,
'has_archive'     => true,
'rewrite'         => array( 'slug' => 'events' ),
)
);

register_post_type(
'lop_competition_entry',
array(
'label'               => __( 'Competition Entries', 'lop-membership' ),
'public'              => false,
'show_ui'             => true,
'menu_icon'           => 'dashicons-clipboard',
'supports'            => array( 'title', 'custom-fields' ),
'capability_type'     => 'post',
'map_meta_cap'        => true,
'show_in_rest'        => false,
)
);
}

/**
 * Register meta boxes.
 */
public static function register_meta_boxes() {
add_meta_box( 'lop-park-meta', __( 'Park Details', 'lop-membership' ), array( __CLASS__, 'render_park_meta_box' ), 'lop_park', 'side', 'default' );
add_meta_box( 'lop-champion-meta', __( 'Champion Details', 'lop-membership' ), array( __CLASS__, 'render_champion_meta_box' ), 'lop_champion', 'normal', 'default' );
add_meta_box( 'lop-entry-meta', __( 'Entry Details', 'lop-membership' ), array( __CLASS__, 'render_entry_meta_box' ), 'lop_competition_entry', 'normal', 'default' );
add_meta_box( 'lop-event-meta', __( 'Event Schedule', 'lop-membership' ), array( __CLASS__, 'render_event_meta_box' ), 'lop_event', 'side', 'default' );
}

/**
 * Render park meta box.
 */
public static function render_park_meta_box( $post ) {
wp_nonce_field( 'lop_park_meta', 'lop_park_meta_nonce' );
$location  = get_post_meta( $post->ID, '_lop_location', true );
$amenities = get_post_meta( $post->ID, '_lop_amenities', true );
?>
<p>
<label for="lop-location"><?php esc_html_e( 'Location', 'lop-membership' ); ?></label>
<input type="text" id="lop-location" name="lop_location" value="<?php echo esc_attr( $location ); ?>" class="widefat" />
</p>
<p>
<label for="lop-amenities"><?php esc_html_e( 'Amenities', 'lop-membership' ); ?></label>
<textarea id="lop-amenities" name="lop_amenities" class="widefat" rows="4"><?php echo esc_textarea( $amenities ); ?></textarea>
</p>
<?php
}

/**
 * Render champion meta box.
 */
public static function render_champion_meta_box( $post ) {
wp_nonce_field( 'lop_champion_meta', 'lop_champion_meta_nonce' );
$skill = get_post_meta( $post->ID, '_lop_skill', true );
$team  = get_post_meta( $post->ID, '_lop_team', true );
$park  = get_post_meta( $post->ID, '_lop_park', true );
?>
<p>
<label for="lop-skill"><?php esc_html_e( 'Skill or Sport', 'lop-membership' ); ?></label>
<input type="text" id="lop-skill" name="lop_skill" value="<?php echo esc_attr( $skill ); ?>" class="widefat" />
</p>
<p>
<label for="lop-team"><?php esc_html_e( 'Team / Division', 'lop-membership' ); ?></label>
<input type="text" id="lop-team" name="lop_team" value="<?php echo esc_attr( $team ); ?>" class="widefat" />
</p>
<p>
<label for="lop-park"><?php esc_html_e( 'Associated Park', 'lop-membership' ); ?></label>
<input type="text" id="lop-park" name="lop_park" value="<?php echo esc_attr( $park ); ?>" class="widefat" />
</p>
<?php
}

/**
 * Render entry meta box.
 */
public static function render_entry_meta_box( $post ) {
wp_nonce_field( 'lop_entry_meta', 'lop_entry_meta_nonce' );
$skill    = get_post_meta( $post->ID, '_lop_entry_skill', true );
$team     = get_post_meta( $post->ID, '_lop_entry_team', true );
$user     = get_post_meta( $post->ID, '_lop_entry_user', true );
$park     = get_post_meta( $post->ID, '_lop_entry_park', true );
$discord  = get_post_meta( $post->ID, '_lop_entry_discord', true );
?>
<p>
<label for="lop-entry-user"><?php esc_html_e( 'Member', 'lop-membership' ); ?></label>
<input type="text" id="lop-entry-user" name="lop_entry_user" value="<?php echo esc_attr( $user ); ?>" class="widefat" />
</p>
<p>
<label for="lop-entry-park"><?php esc_html_e( 'Park', 'lop-membership' ); ?></label>
<input type="text" id="lop-entry-park" name="lop_entry_park" value="<?php echo esc_attr( $park ); ?>" class="widefat" />
</p>
<p>
<label for="lop-entry-skill"><?php esc_html_e( 'Skill / Sport', 'lop-membership' ); ?></label>
<input type="text" id="lop-entry-skill" name="lop_entry_skill" value="<?php echo esc_attr( $skill ); ?>" class="widefat" />
</p>
<p>
<label for="lop-entry-team"><?php esc_html_e( 'Team or Division', 'lop-membership' ); ?></label>
<input type="text" id="lop-entry-team" name="lop_entry_team" value="<?php echo esc_attr( $team ); ?>" class="widefat" />
</p>
<p>
<label for="lop-entry-discord"><?php esc_html_e( 'Discord Handle', 'lop-membership' ); ?></label>
<input type="text" id="lop-entry-discord" name="lop_entry_discord" value="<?php echo esc_attr( $discord ); ?>" class="widefat" />
</p>
<?php
}

/**
 * Render event meta box.
 */
public static function render_event_meta_box( $post ) {
wp_nonce_field( 'lop_event_meta', 'lop_event_meta_nonce' );
$start  = get_post_meta( $post->ID, '_lop_event_start', true );
$discord = get_post_meta( $post->ID, '_lop_event_discord', true );
?>
<p>
<label for="lop-event-start"><?php esc_html_e( 'Event Date & Time', 'lop-membership' ); ?></label>
<input type="datetime-local" id="lop-event-start" name="lop_event_start" value="<?php echo esc_attr( $start ); ?>" class="widefat" />
</p>
<p>
<label for="lop-event-discord"><?php esc_html_e( 'Discord RSVP Link', 'lop-membership' ); ?></label>
<input type="url" id="lop-event-discord" name="lop_event_discord" value="<?php echo esc_attr( $discord ); ?>" class="widefat" placeholder="https://discord.gg/25bXKqSN" />
</p>
<?php
}

/**
 * Save meta.
 */
public static function save_meta( $post_id, $post ) {
if ( 'lop_park' === $post->post_type ) {
if ( ! isset( $_POST['lop_park_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lop_park_meta_nonce'] ) ), 'lop_park_meta' ) ) {
return;
}
if ( isset( $_POST['lop_location'] ) ) {
update_post_meta( $post_id, '_lop_location', sanitize_text_field( wp_unslash( $_POST['lop_location'] ) ) );
}
if ( isset( $_POST['lop_amenities'] ) ) {
update_post_meta( $post_id, '_lop_amenities', sanitize_textarea_field( wp_unslash( $_POST['lop_amenities'] ) ) );
}
} elseif ( 'lop_champion' === $post->post_type ) {
if ( ! isset( $_POST['lop_champion_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lop_champion_meta_nonce'] ) ), 'lop_champion_meta' ) ) {
return;
}
$fields = array(
'_lop_skill' => 'lop_skill',
'_lop_team'  => 'lop_team',
'_lop_park'  => 'lop_park',
);
foreach ( $fields as $meta_key => $field_key ) {
if ( isset( $_POST[ $field_key ] ) ) {
update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) ) );
}
}
} elseif ( 'lop_competition_entry' === $post->post_type ) {
if ( ! isset( $_POST['lop_entry_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lop_entry_meta_nonce'] ) ), 'lop_entry_meta' ) ) {
return;
}
$fields = array(
'_lop_entry_skill'   => 'lop_entry_skill',
'_lop_entry_team'    => 'lop_entry_team',
'_lop_entry_user'    => 'lop_entry_user',
'_lop_entry_park'    => 'lop_entry_park',
'_lop_entry_discord' => 'lop_entry_discord',
);
foreach ( $fields as $meta_key => $field_key ) {
if ( isset( $_POST[ $field_key ] ) ) {
update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $field_key ] ) ) );
}
}
} elseif ( 'lop_event' === $post->post_type ) {
if ( ! isset( $_POST['lop_event_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lop_event_meta_nonce'] ) ), 'lop_event_meta' ) ) {
return;
}
if ( isset( $_POST['lop_event_start'] ) ) {
update_post_meta( $post_id, '_lop_event_start', sanitize_text_field( wp_unslash( $_POST['lop_event_start'] ) ) );
}
if ( isset( $_POST['lop_event_discord'] ) ) {
update_post_meta( $post_id, '_lop_event_discord', esc_url_raw( wp_unslash( $_POST['lop_event_discord'] ) ) );
}
}
}

/**
 * Seed parks on activation.
 */
public static function activate() {
self::register_taxonomies();
self::register_post_types();
self::maybe_seed_parks();
flush_rewrite_rules();
}

/**
 * Seed parks from data file if they are missing.
 */
protected static function maybe_seed_parks() {
$parks_data = include LOP_MEMBERSHIP_DIR . 'data/parks.php';
if ( empty( $parks_data ) || ! is_array( $parks_data ) ) {
return;
}

foreach ( $parks_data as $division => $parks ) {
$term = get_term_by( 'name', $division, 'lop_city_division' );
if ( ! $term ) {
$term = wp_insert_term( $division, 'lop_city_division' );
}
$term_id = is_wp_error( $term ) ? 0 : ( is_array( $term ) ? $term['term_id'] : $term->term_id );

foreach ( $parks as $park ) {
$existing = get_page_by_title( $park['name'], OBJECT, 'lop_park' );
if ( $existing ) {
continue;
}

$post_id = wp_insert_post(
array(
'post_type'    => 'lop_park',
'post_title'   => sanitize_text_field( $park['name'] ),
'post_status'  => 'publish',
'post_content' => sprintf( __( '%1$s in %2$s features %3$s. Add your stories and photos to help your park rise during Champions Month.', 'lop-membership' ), $park['name'], $division, $park['amenities'] ),
)
);

if ( ! is_wp_error( $post_id ) ) {
if ( $term_id ) {
wp_set_post_terms( $post_id, array( $term_id ), 'lop_city_division', false );
}
update_post_meta( $post_id, '_lop_location', sanitize_text_field( $park['location'] ) );
update_post_meta( $post_id, '_lop_amenities', sanitize_textarea_field( $park['amenities'] ) );
}
}
}
}
}
