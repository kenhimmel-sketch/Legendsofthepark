<?php
/**
 * Default template fallback.
 *
 * @package Legends_Of_The_Park
 */

get_header();
?>
<section class="section">
<?php if ( have_posts() ) : ?>
<div class="grid columns-2">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'discord-card' ); ?>>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="entry-meta">
<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
</div>
<?php the_excerpt(); ?>
</article>
<?php endwhile; ?>
</div>
<?php the_posts_pagination(); ?>
<?php else : ?>
<p><?php esc_html_e( 'No posts to display yet. Create pages with Gutenberg or Elementor to power the park community.', 'legends-of-the-park' ); ?></p>
<?php endif; ?>
</section>
<?php
get_footer();
