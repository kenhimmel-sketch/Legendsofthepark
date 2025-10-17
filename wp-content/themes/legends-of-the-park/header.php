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
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/discord-leaf.svg' ); ?>" alt="Legends of the Park badge" />
            <?php endif; ?>
        </a>
        <div>
            <span class="badge green"><?php esc_html_e( 'Flag Football Command Center', 'legends-of-the-park' ); ?></span>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
            <p class="site-description"><?php esc_html_e( 'Static league hub with schedules, clinics, and scouting intel.', 'legends-of-the-park' ); ?></p>
        </div>
    </div>
    <nav class="nav-primary" aria-label="<?php esc_attr_e( 'Primary navigation', 'legends-of-the-park' ); ?>">
        <ul>
            <li><a href="#top"><?php esc_html_e( 'Home', 'legends-of-the-park' ); ?></a></li>
            <li><a href="#schedule"><?php esc_html_e( 'Schedule', 'legends-of-the-park' ); ?></a></li>
            <li><a href="#divisions"><?php esc_html_e( 'Divisions', 'legends-of-the-park' ); ?></a></li>
            <li><a href="#teams"><?php esc_html_e( 'Teams', 'legends-of-the-park' ); ?></a></li>
            <li><a href="#training"><?php esc_html_e( 'Training', 'legends-of-the-park' ); ?></a></li>
            <li><a href="#registration"><?php esc_html_e( 'Register', 'legends-of-the-park' ); ?></a></li>
        </ul>
    </nav>
</header>
<main id="primary" class="site-main">
