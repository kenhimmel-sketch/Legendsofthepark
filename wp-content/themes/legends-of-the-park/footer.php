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
<div class="grid columns-3">
<div>
<h3><?php esc_html_e( 'Join Our Discord', 'legends-of-the-park' ); ?></h3>
<p><?php esc_html_e( 'Jump into live park chatter, vote on park champions, and find event voice chats.', 'legends-of-the-park' ); ?></p>
<a class="button-secondary" href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener">
<span aria-hidden="true">#</span>
<span><?php esc_html_e( 'Join Legends of the Park Discord', 'legends-of-the-park' ); ?></span>
</a>
</div>
<div>
<h3><?php esc_html_e( 'Upcoming Events', 'legends-of-the-park' ); ?></h3>
<?php dynamic_sidebar( 'footer-1' ); ?>
</div>
<div>
<h3><?php esc_html_e( 'Stay Connected', 'legends-of-the-park' ); ?></h3>
<ul class="card-list">
<li data-lop-filterable>
<a href="https://discord.gg/25bXKqSN" rel="noopener" target="_blank">Discord</a>
</li>
<li data-lop-filterable>
<a href="mailto:hello@legendsofthepark.com">hello@legendsofthepark.com</a>
</li>
</ul>
</div>
</div>
<p class="site-info">
&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Founded by Kenneth Himmel for Nevada residents who love their neighborhood parks.', 'legends-of-the-park' ); ?>
</p>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
