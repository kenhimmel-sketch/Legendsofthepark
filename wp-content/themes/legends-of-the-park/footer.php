<?php
/**
 * Theme footer.
 *
 * @package Legends_Of_The_Park
 */
?>
</main>
<footer class="site-footer">
<div class="footer">
<div class="footer-grid">
<div>
<h3><?php esc_html_e( 'Why Static?', 'legends-of-the-park' ); ?></h3>
<p><?php esc_html_e( 'This build serves fast, reliable HTML. Every layout, image, and map embed is baked into the theme so anyone can explore without signups or loading delays.', 'legends-of-the-park' ); ?></p>
</div>
<div>
<h3><?php esc_html_e( 'Explore Quickly', 'legends-of-the-park' ); ?></h3>
<ul class="card-list">
<li><a href="#divisions"><?php esc_html_e( 'Browse divisions', 'legends-of-the-park' ); ?></a></li>
<li><a href="#parks"><?php esc_html_e( 'Jump to all parks', 'legends-of-the-park' ); ?></a></li>
<li><a href="#about"><?php esc_html_e( 'Learn how the guide works', 'legends-of-the-park' ); ?></a></li>
</ul>
</div>
<div>
<h3><?php esc_html_e( 'Credits', 'legends-of-the-park' ); ?></h3>
<p><?php esc_html_e( 'Created by Kenneth Himmel and the Legends of the Park community to spotlight Nevada’s outdoor gems.', 'legends-of-the-park' ); ?></p>
</div>
</div>
<p class="site-info">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All content is provided for inspiration and trip planning.', 'legends-of-the-park' ); ?></p>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
