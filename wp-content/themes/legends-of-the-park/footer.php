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
                <p><?php esc_html_e( 'This hub ships as pure HTML so captains can prep playbooks, rosters, and scouting intel without logins or load screens.', 'legends-of-the-park' ); ?></p>
            </div>
            <div>
                <h3><?php esc_html_e( 'Quick Links', 'legends-of-the-park' ); ?></h3>
                <ul class="card-list">
                    <li><a href="#schedule"><?php esc_html_e( 'Game Schedule', 'legends-of-the-park' ); ?></a></li>
                    <li><a href="#teams"><?php esc_html_e( 'Team Hubs', 'legends-of-the-park' ); ?></a></li>
                    <li><a href="#training"><?php esc_html_e( 'Skills & Clinics', 'legends-of-the-park' ); ?></a></li>
                    <li><a href="#registration"><?php esc_html_e( 'Register a Team', 'legends-of-the-park' ); ?></a></li>
                </ul>
            </div>
            <div>
                <h3><?php esc_html_e( 'League Motto', 'legends-of-the-park' ); ?></h3>
                <p><?php esc_html_e( 'Play fast. Communicate loud. Celebrate everyone under the lights.', 'legends-of-the-park' ); ?></p>
            </div>
        </div>
        <p class="site-info">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Nevada’s flagship flag football community.', 'legends-of-the-park' ); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
