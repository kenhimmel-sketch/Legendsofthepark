<?php
/**
 * Archive template for Park directory.
 *
 * @package Legends_Of_The_Park
 */

get_header();
?>
<section class="section">
<h1 class="section-title"><span class="icon">📍</span><?php esc_html_e( 'Nevada Parks Directory', 'legends-of-the-park' ); ?></h1>
<div class="channel-card">
<p><?php esc_html_e( 'Browse parks by city division, find amenities, and link directly to Discord threads to plan your next park meetup.', 'legends-of-the-park' ); ?></p>
<input type="search" class="button-secondary" data-lop-filter="lop-parks-archive" placeholder="<?php esc_attr_e( 'Search parks or amenities…', 'legends-of-the-park' ); ?>" />
<div id="lop-parks-archive" class="card-list">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'discord-card' ); ?> data-lop-filterable>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="badge blue"><?php echo esc_html( get_the_term_list( get_the_ID(), 'lop_city_division', '', ', ', '' ) ); ?></div>
<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
<a class="button-secondary" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View Park Hub', 'legends-of-the-park' ); ?></a>
</article>
<?php endwhile; ?>
<?php else : ?>
<p><?php esc_html_e( 'No parks found yet. Check back after activation.', 'legends-of-the-park' ); ?></p>
<?php endif; ?>
</div>
<?php the_posts_pagination(); ?>
</div>
</section>
<?php
get_footer();
