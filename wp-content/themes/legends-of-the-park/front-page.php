<?php
/**
 * Front page template.
 *
 * @package Legends_Of_The_Park
 */

get_header();
?>
<section class="hero">
<div class="hero-content">
<span class="badge blue">Founded by Kenneth Himmel</span>
<h1><?php esc_html_e( 'Legends of the Park', 'legends-of-the-park' ); ?></h1>
<p><?php esc_html_e( 'Join Legends of the Park to celebrate Nevada’s parks. Pick your favorite park, add skills like Park Photographer, join sports like Softball, and compete in Champions Month (July) to win for your park’s city division.', 'legends-of-the-park' ); ?></p>
<div class="hero-actions">
<a class="button-primary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Join Our Discord', 'legends-of-the-park' ); ?></a>
<a class="button-secondary" href="#membership" data-lop-toggle="membership-panel" aria-expanded="true">⚡ <?php esc_html_e( 'Membership Signup', 'legends-of-the-park' ); ?></a>
</div>
</div>
<div class="discord-thread">
<div class="message">
<strong>#desert-breeze-trails</strong>
<p><?php esc_html_e( 'Share your Desert Breeze Park trail snaps and recruit new runners for July’s Champions Month!', 'legends-of-the-park' ); ?></p>
</div>
<div class="message">
<strong>#anthem-hills-softball</strong>
<p><?php esc_html_e( 'Softball captains meet Wednesday in voice chat. RSVP below and invite your park squad!', 'legends-of-the-park' ); ?></p>
</div>
</div>
</section>
<section id="membership" class="section">
<h2 class="section-title"><span class="icon">🌲</span><?php esc_html_e( 'Claim Your Park Role', 'legends-of-the-park' ); ?></h2>
<div class="channel-card is-open" id="membership-panel">
<?php echo do_shortcode( '[lop_registration_form]' ); ?>
</div>
</section>
<section class="section">
<h2 class="section-title"><span class="icon">🏆</span><?php esc_html_e( 'Champions Month Leaderboard', 'legends-of-the-park' ); ?></h2>
<div class="channel-card">
<?php echo do_shortcode( '[lop_champions_leaderboard]' ); ?>
</div>
</section>
<section class="section">
<h2 class="section-title"><span class="icon">📍</span><?php esc_html_e( 'Parks Directory', 'legends-of-the-park' ); ?></h2>
<div class="channel-card">
<?php echo do_shortcode( '[lop_parks_directory]' ); ?>
</div>
</section>
<section class="section">
<h2 class="section-title"><span class="icon">📆</span><?php esc_html_e( 'Events & Voice Chat Rally Points', 'legends-of-the-park' ); ?></h2>
<div class="grid columns-2">
<div class="channel-card">
<h3><?php esc_html_e( 'Champions Month Signup', 'legends-of-the-park' ); ?></h3>
<p><?php esc_html_e( 'Compete in July events to earn trophies for your park division. Sign up and coordinate strategy in our Discord events channels.', 'legends-of-the-park' ); ?></p>
<?php echo do_shortcode( '[lop_competition_signup]' ); ?>
</div>
<div class="channel-card">
<h3><?php esc_html_e( 'Community Calendar', 'legends-of-the-park' ); ?></h3>
<?php echo do_shortcode( '[lop_events_feed]' ); ?>
</div>
</div>
</section>
<?php
get_footer();
