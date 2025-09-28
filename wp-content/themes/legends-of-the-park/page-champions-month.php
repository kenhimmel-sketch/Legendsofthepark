<?php
/**
 * Template Name: Champions Month
 *
 * Dedicated page for July competitions.
 *
 * @package Legends_Of_The_Park
 */

get_header();
?>
<section class="section">
<h1 class="section-title"><span class="icon">🥇</span><?php esc_html_e( 'Champions Month - July', 'legends-of-the-park' ); ?></h1>
<div class="channel-card">
<p><?php esc_html_e( 'Every July, Legends of the Park crowns community champions across every skill and sport. Represent your favorite Nevada park and earn trophies for your city division.', 'legends-of-the-park' ); ?></p>
<ul class="card-list">
<li><?php esc_html_e( 'Earn badges as Park Photographer, Park Runner, Park Dog Mom, and more.', 'legends-of-the-park' ); ?></li>
<li><?php esc_html_e( 'Join sports showdowns including Softball, Volleyball, Pickleball, and Ultimate Frisbee.', 'legends-of-the-park' ); ?></li>
<li><?php esc_html_e( 'Sync with your park’s Discord channel for live strategy threads and judge Q&A.', 'legends-of-the-park' ); ?></li>
</ul>
</div>
</section>
<section class="section">
<h2 class="section-title"><span class="icon">🏆</span><?php esc_html_e( 'Division Leaderboards', 'legends-of-the-park' ); ?></h2>
<div class="channel-card">
<?php echo do_shortcode( '[lop_champions_leaderboard]' ); ?>
</div>
</section>
<section class="section">
<h2 class="section-title"><span class="icon">📝</span><?php esc_html_e( 'Competition Signup', 'legends-of-the-park' ); ?></h2>
<div class="channel-card">
<?php echo do_shortcode( '[lop_competition_signup]' ); ?>
</div>
</section>
<section class="section">
<h2 class="section-title"><span class="icon">💬</span><?php esc_html_e( 'Live Discord Channels', 'legends-of-the-park' ); ?></h2>
<div class="grid columns-2">
<div class="discord-card">
<h3>#champions-lounge</h3>
<p><?php esc_html_e( 'Drop updates, share highlight reels, and celebrate wins with your division.', 'legends-of-the-park' ); ?></p>
<a class="button-secondary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Enter Channel', 'legends-of-the-park' ); ?></a>
</div>
<div class="discord-card">
<h3>#event-voice</h3>
<p><?php esc_html_e( 'Voice chat lobbies open 30 minutes before each sport final. RSVP via the calendar feed below.', 'legends-of-the-park' ); ?></p>
<?php echo do_shortcode( '[lop_events_feed]' ); ?>
</div>
</div>
</section>
<?php
get_footer();
