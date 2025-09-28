<?php
/**
 * Single Park template.
 *
 * @package Legends_Of_The_Park
 */

get_header();
?>
<section class="section">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'channel-card' ); ?>>
<header>
<h1><?php the_title(); ?></h1>
<div class="badge green"><?php echo esc_html( strip_tags( get_the_term_list( get_the_ID(), 'lop_city_division', '', ', ', '' ) ) ); ?></div>
</header>
<?php if ( has_post_thumbnail() ) : ?>
<div class="park-image"><?php the_post_thumbnail( 'lop-hero' ); ?></div>
<?php endif; ?>
<div class="park-meta">
<?php if ( $location = get_post_meta( get_the_ID(), '_lop_location', true ) ) : ?>
<p><strong><?php esc_html_e( 'Location:', 'legends-of-the-park' ); ?></strong> <?php echo esc_html( $location ); ?></p>
<?php endif; ?>
<?php if ( $amenities = get_post_meta( get_the_ID(), '_lop_amenities', true ) ) : ?>
<p><strong><?php esc_html_e( 'Amenities:', 'legends-of-the-park' ); ?></strong> <?php echo esc_html( $amenities ); ?></p>
<?php endif; ?>
</div>
<div class="park-content">
<?php the_content(); ?>
</div>
<div class="park-community grid columns-2">
<div class="discord-card">
<h2><?php esc_html_e( 'Members Representing This Park', 'legends-of-the-park' ); ?></h2>
<?php echo do_shortcode( '[lop_park_members]' ); ?>
</div>
<div class="discord-card">
<h2><?php esc_html_e( 'Champions & Highlights', 'legends-of-the-park' ); ?></h2>
<?php echo do_shortcode( '[lop_park_champions]' ); ?>
<a class="button-secondary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener"># <?php esc_html_e( 'Discuss on Discord', 'legends-of-the-park' ); ?></a>
</div>
</div>
</article>
<?php endwhile; ?>
</section>
<?php
get_footer();
