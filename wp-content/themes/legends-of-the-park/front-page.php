<?php
/**
 * Front page template for the static Legends of the Park site.
 *
 * @package Legends_Of_The_Park
 */

$divisions = include get_template_directory() . '/inc/parks-data.php';

get_header();
?>
<section class="hero" id="top">
<div class="hero-content">
<span class="badge blue">Nevada Parks Showcase</span>
<h1><?php esc_html_e( 'Legends of the Park', 'legends-of-the-park' ); ?></h1>
<p><?php esc_html_e( 'Explore every Nevada division and park we highlighted. No logins, no waitlists—just beautiful layouts, interactive maps, and the stories that make each park legendary.', 'legends-of-the-park' ); ?></p>
<div class="hero-actions">
<a class="button-primary" href="#divisions"><?php esc_html_e( 'Browse Divisions', 'legends-of-the-park' ); ?></a>
<a class="button-secondary" href="#parks"><?php esc_html_e( 'Jump to All Parks', 'legends-of-the-park' ); ?></a>
</div>
</div>
<div class="hero-gallery" aria-hidden="true">
<img src="https://images.unsplash.com/photo-1489515217757-5fd1be406fef?auto=format&fit=crop&w=900&q=80" alt="" loading="lazy" />
<img src="https://images.unsplash.com/photo-1470770841072-f978cf4d019e?auto=format&fit=crop&w=900&q=80" alt="" loading="lazy" />
</div>
</section>
<section class="section intro" id="about">
<div class="intro-content">
<h2 class="section-title"><span class="icon">🌄</span><?php esc_html_e( 'A Static Tribute to Nevada Parks', 'legends-of-the-park' ); ?></h2>
<p><?php esc_html_e( 'Legends of the Park is engineered as a view-only WordPress theme. Every division and park lives inside the theme files so the site can run statically on any host—no databases or logins required.', 'legends-of-the-park' ); ?></p>
<ul class="pill-list">
<li><?php esc_html_e( 'Four divisions from Las Vegas to Carson City', 'legends-of-the-park' ); ?></li>
<li><?php esc_html_e( 'Twenty curated parks with images and amenity highlights', 'legends-of-the-park' ); ?></li>
<li><?php esc_html_e( 'Embedded maps for quick orientation', 'legends-of-the-park' ); ?></li>
</ul>
</div>
<div class="intro-card">
<h3><?php esc_html_e( 'How to Use This Guide', 'legends-of-the-park' ); ?></h3>
<ol>
<li><?php esc_html_e( 'Pick a division to see its personality and coverage area.', 'legends-of-the-park' ); ?></li>
<li><?php esc_html_e( 'Scroll through the park cards for visuals, descriptions, and amenities.', 'legends-of-the-park' ); ?></li>
<li><?php esc_html_e( 'Open any map link to plan your next visit.', 'legends-of-the-park' ); ?></li>
</ol>
</div>
</section>
<section class="section" id="divisions">
<h2 class="section-title"><span class="icon">🛡️</span><?php esc_html_e( 'Choose Your Division', 'legends-of-the-park' ); ?></h2>
<p class="section-lead"><?php esc_html_e( 'Each division celebrates a region of Nevada with its own vibe, standout parks, and quick links to the stories below.', 'legends-of-the-park' ); ?></p>
<div class="divisions-grid">
<?php foreach ( $divisions as $slug => $division ) : ?>
<article class="division-card">
<div class="division-card__media">
<img src="<?php echo esc_url( $division['image'] ); ?>" alt="<?php echo esc_attr( $division['image_alt'] ); ?>" loading="lazy" />
</div>
<div class="division-card__body">
<span class="badge green"><?php echo esc_html( $division['name'] ); ?></span>
<h3><?php echo esc_html( $division['tagline'] ); ?></h3>
<p><?php echo esc_html( $division['description'] ); ?></p>
<ul class="pill-list">
<?php foreach ( $division['features'] as $feature ) : ?>
<li><?php echo esc_html( $feature ); ?></li>
<?php endforeach; ?>
</ul>
<div class="division-card__actions">
<a class="button-tertiary" href="#division-<?php echo esc_attr( $slug ); ?>">
<?php esc_html_e( 'View Parks', 'legends-of-the-park' ); ?>
</a>
<span class="park-count"><?php printf( esc_html__( '%d parks', 'legends-of-the-park' ), count( $division['parks'] ) ); ?></span>
</div>
</div>
</article>
<?php endforeach; ?>
</div>
</section>
<section class="section" id="parks">
<h2 class="section-title"><span class="icon">📍</span><?php esc_html_e( 'Park Spotlights', 'legends-of-the-park' ); ?></h2>
<p class="section-lead"><?php esc_html_e( 'Dive into every division’s parks. Each profile includes a high-resolution photo, summary, amenities, and map for easy navigation.', 'legends-of-the-park' ); ?></p>
<?php foreach ( $divisions as $slug => $division ) : ?>
<section class="division-detail" id="division-<?php echo esc_attr( $slug ); ?>">
<div class="division-detail__header">
<div class="division-detail__content">
<h3><?php echo esc_html( $division['name'] ); ?></h3>
<p><?php echo esc_html( $division['description'] ); ?></p>
<ul class="pill-list">
<?php foreach ( $division['features'] as $feature ) : ?>
<li><?php echo esc_html( $feature ); ?></li>
<?php endforeach; ?>
</ul>
</div>
<div class="division-detail__map">
<iframe src="<?php echo esc_url( $division['map_embed'] ); ?>" loading="lazy" allowfullscreen title="<?php echo esc_attr( $division['name'] ); ?> map"></iframe>
</div>
</div>
<div class="park-grid">
<?php foreach ( $division['parks'] as $park ) : ?>
<article class="park-card" id="<?php echo esc_attr( sanitize_title( $park['name'] ) ); ?>">
<div class="park-card__media">
<img src="<?php echo esc_url( $park['image'] ); ?>" alt="<?php echo esc_attr( $park['image_alt'] ); ?>" loading="lazy" />
</div>
<div class="park-card__body">
<h4><?php echo esc_html( $park['name'] ); ?></h4>
<p class="park-location"><?php echo esc_html( $park['location'] ); ?></p>
<p><?php echo esc_html( $park['description'] ); ?></p>
<ul class="amenities">
<?php foreach ( $park['amenities'] as $amenity ) : ?>
<li><?php echo esc_html( $amenity ); ?></li>
<?php endforeach; ?>
</ul>
</div>
<div class="park-card__map">
<iframe src="<?php echo esc_url( $park['map_embed'] ); ?>" loading="lazy" allowfullscreen title="<?php echo esc_attr( $park['name'] ); ?> map"></iframe>
</div>
<div class="park-card__actions">
<a class="button-tertiary" href="<?php echo esc_url( $park['directions'] ); ?>" target="_blank" rel="noopener">
<?php esc_html_e( 'Open in Maps', 'legends-of-the-park' ); ?>
</a>
</div>
</article>
<?php endforeach; ?>
</div>
</section>
<?php endforeach; ?>
</section>
<?php
get_footer();
