<?php
/**
 * Theme header.
 *
 * @package Legends_Of_The_Park
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
<div class="site-branding">
<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php esc_attr_e( 'Legends of the Park home', 'legends-of-the-park' ); ?>">
<?php if ( has_custom_logo() ) : ?>
<?php the_custom_logo(); ?>
<?php else : ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/discord-leaf.svg' ); ?>" alt="Discord Leaf Icon" />
<?php endif; ?>
</a>
<div>
<span class="badge green"><?php esc_html_e( 'Legends of the Park', 'legends-of-the-park' ); ?></span>
<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
<p class="site-description"><?php bloginfo( 'description' ); ?></p>
</div>
</div>
<nav class="nav-primary" aria-label="<?php esc_attr_e( 'Primary navigation', 'legends-of-the-park' ); ?>">
<?php
wp_nav_menu(
array(
'theme_location' => 'primary',
'container'      => false,
'menu_class'     => 'menu menu--primary',
'fallback_cb'    => '__return_false',
)
);
?>
</nav>
</header>
<main id="primary" class="site-main">
