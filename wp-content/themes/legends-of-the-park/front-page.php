<?php
/**
 * Front page template for the Legends of the Park flag football league.
 *
 * @package Legends_Of_The_Park
 */

$league      = include get_template_directory() . '/inc/league-data.php';
$divisions   = $league['divisions'];
$highlights  = $league['season_highlights'];
$games       = $league['upcoming_games'];
$clinics     = $league['training_clinics'];
$pillars     = $league['community_pillars'];
$steps       = $league['registration_steps'];
$rulebook    = $league['rulebook_url'];
$contact     = $league['contact_email'];

get_header();
?>
<section class="hero" id="top">
    <div class="hero-content">
        <span class="badge blue"><?php esc_html_e( 'Nevada Flag Football League', 'legends-of-the-park' ); ?></span>
        <h1><?php esc_html_e( 'Legends of the Park', 'legends-of-the-park' ); ?></h1>
        <p><?php esc_html_e( 'Premier flag football built for fast-paced playbooks, inclusive rosters, and community-driven gamedays.', 'legends-of-the-park' ); ?></p>
        <div class="hero-actions">
            <a class="button-primary" href="#registration"><?php esc_html_e( 'Register Your Squad', 'legends-of-the-park' ); ?></a>
            <?php if ( ! empty( $rulebook ) ) : ?>
                <a class="button-secondary" href="<?php echo esc_url( $rulebook ); ?>" target="_blank" rel="noopener">
                    <?php esc_html_e( 'Download Rulebook', 'legends-of-the-park' ); ?>
                </a>
            <?php endif; ?>
            <a class="button-tertiary" href="#schedule"><?php esc_html_e( 'Upcoming Games', 'legends-of-the-park' ); ?></a>
        </div>
        <ul class="hero-metrics">
            <?php foreach ( array_slice( $highlights, 0, 3 ) as $metric ) : ?>
                <li>
                    <span class="hero-metrics__value"><?php echo esc_html( $metric['value'] ); ?></span>
                    <span class="hero-metrics__label"><?php echo esc_html( $metric['label'] ); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="hero-board" aria-label="<?php esc_attr_e( 'Upcoming games scoreboard', 'legends-of-the-park' ); ?>">
        <div class="hero-board__header">
            <span class="badge green"><?php esc_html_e( 'Next Kickoffs', 'legends-of-the-park' ); ?></span>
            <p><?php esc_html_e( 'Lock in for the next slate. RSVP links keep your sideline organized.', 'legends-of-the-park' ); ?></p>
        </div>
        <ul class="hero-board__list">
            <?php foreach ( array_slice( $games, 0, 3 ) as $game ) : ?>
                <li>
                    <div>
                        <span class="hero-board__matchup"><?php echo esc_html( $game['matchup'] ); ?></span>
                        <span class="hero-board__meta"><?php echo esc_html( $game['division'] ); ?></span>
                    </div>
                    <div class="hero-board__details">
                        <span><?php echo esc_html( $game['date'] ); ?> • <?php echo esc_html( $game['time'] ); ?></span>
                        <span><?php echo esc_html( $game['location'] ); ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<section class="section stats" id="season">
    <h2 class="section-title"><span class="icon">📊</span><?php esc_html_e( 'Season at a Glance', 'legends-of-the-park' ); ?></h2>
    <p class="section-lead"><?php esc_html_e( 'Metrics the commission tracks weekly to keep competition sharp and community-first.', 'legends-of-the-park' ); ?></p>
    <div class="stats-grid">
        <?php foreach ( $highlights as $highlight ) : ?>
            <article class="stat-card">
                <span class="stat-card__value"><?php echo esc_html( $highlight['value'] ); ?></span>
                <h3><?php echo esc_html( $highlight['label'] ); ?></h3>
                <p><?php echo esc_html( $highlight['description'] ); ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<section class="section intro" id="about">
    <div class="intro-content">
        <h2 class="section-title"><span class="icon">🏆</span><?php esc_html_e( 'Built for Competitive Community', 'legends-of-the-park' ); ?></h2>
        <p><?php esc_html_e( 'Legends of the Park fuses tournament-caliber strategy with an open-door culture. Schedules, stats, and clinics all live in this static hub so your team can prep from any device.', 'legends-of-the-park' ); ?></p>
        <ul class="pill-list">
            <?php foreach ( $pillars as $pillar ) : ?>
                <li><?php echo esc_html( $pillar ); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="intro-card">
        <h3><?php esc_html_e( 'How to Plug In', 'legends-of-the-park' ); ?></h3>
        <ol>
            <li><?php esc_html_e( 'Scout divisions below to find the right competitive fit.', 'legends-of-the-park' ); ?></li>
            <li><?php esc_html_e( 'Lock in your upcoming games and volunteer slots.', 'legends-of-the-park' ); ?></li>
            <li><?php esc_html_e( 'Reserve clinics to sharpen playbooks and leadership.', 'legends-of-the-park' ); ?></li>
        </ol>
    </div>
</section>
<section class="section" id="schedule">
    <h2 class="section-title"><span class="icon">🏈</span><?php esc_html_e( 'Upcoming Games', 'legends-of-the-park' ); ?></h2>
    <p class="section-lead"><?php esc_html_e( 'Mark your calendars. Every matchup includes a storyline, kickoff time, and coordination link.', 'legends-of-the-park' ); ?></p>
    <div class="schedule-grid">
        <?php foreach ( $games as $game ) : ?>
            <article class="game-card">
                <header>
                    <span class="badge green"><?php echo esc_html( $game['division'] ); ?></span>
                    <time datetime="<?php echo esc_attr( $game['date_iso'] ); ?>"><?php echo esc_html( $game['date'] ); ?></time>
                </header>
                <h3><?php echo esc_html( $game['matchup'] ); ?></h3>
                <p><?php echo esc_html( $game['storyline'] ); ?></p>
                <ul class="game-card__meta">
                    <li><?php echo esc_html( $game['time'] ); ?></li>
                    <li><?php echo esc_html( $game['location'] ); ?></li>
                </ul>
                <?php if ( ! empty( $game['cta']['url'] ) ) : ?>
                    <a class="button-secondary" href="<?php echo esc_url( $game['cta']['url'] ); ?>" target="_blank" rel="noopener">
                        <?php echo esc_html( $game['cta']['label'] ); ?>
                    </a>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<section class="section" id="divisions">
    <h2 class="section-title"><span class="icon">🛡️</span><?php esc_html_e( 'Choose Your Division', 'legends-of-the-park' ); ?></h2>
    <p class="section-lead"><?php esc_html_e( 'Each division brings a unique pace, coaching support, and gameday experience.', 'legends-of-the-park' ); ?></p>
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
                            <?php esc_html_e( 'View Teams & Hub', 'legends-of-the-park' ); ?>
                        </a>
                        <span class="park-count"><?php printf( esc_html__( '%d teams', 'legends-of-the-park' ), count( $division['teams'] ) ); ?></span>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<section class="section teams" id="teams">
    <h2 class="section-title"><span class="icon">📣</span><?php esc_html_e( 'Team Hubs', 'legends-of-the-park' ); ?></h2>
    <p class="section-lead"><?php esc_html_e( 'Dive into your division hub for practice schedules, scouting links, and leadership contacts.', 'legends-of-the-park' ); ?></p>
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
                <div class="division-detail__hub">
                    <h4><?php esc_html_e( 'Home Field Hub', 'legends-of-the-park' ); ?></h4>
                    <p><?php echo esc_html( $division['home_field'] ); ?></p>
                    <iframe src="<?php echo esc_url( $division['map_embed'] ); ?>" loading="lazy" allowfullscreen title="<?php echo esc_attr( $division['name'] ); ?> map"></iframe>
                </div>
            </div>
            <div class="team-grid">
                <?php foreach ( $division['teams'] as $team ) : ?>
                    <article class="team-card" id="<?php echo esc_attr( sanitize_title( $team['name'] ) ); ?>">
                        <div class="team-card__header">
                            <h4><?php echo esc_html( $team['name'] ); ?></h4>
                            <span class="team-card__record"><?php echo esc_html( $team['record'] ); ?></span>
                        </div>
                        <p class="team-card__identity"><?php echo esc_html( $team['identity'] ); ?></p>
                        <ul class="team-card__meta">
                            <li><strong><?php esc_html_e( 'Coach', 'legends-of-the-park' ); ?>:</strong> <?php echo esc_html( $team['coach'] ); ?></li>
                            <li><strong><?php esc_html_e( 'Captains', 'legends-of-the-park' ); ?>:</strong> <?php echo esc_html( $team['captains'] ); ?></li>
                            <li><strong><?php esc_html_e( 'Training', 'legends-of-the-park' ); ?>:</strong> <?php echo esc_html( $team['training'] ); ?></li>
                            <li><strong><?php esc_html_e( 'Next Match', 'legends-of-the-park' ); ?>:</strong> <?php echo esc_html( $team['next_match'] ); ?></li>
                        </ul>
                        <?php if ( ! empty( $team['strengths'] ) ) : ?>
                            <ul class="team-card__tags">
                                <?php foreach ( $team['strengths'] as $strength ) : ?>
                                    <li><?php echo esc_html( $strength ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ( ! empty( $team['scouting'] ) ) : ?>
                            <div class="team-card__footer">
                                <a class="button-tertiary" href="<?php echo esc_url( $team['scouting'] ); ?>" target="_blank" rel="noopener">
                                    <?php esc_html_e( 'Scouting Report', 'legends-of-the-park' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
</section>
<section class="section" id="training">
    <h2 class="section-title"><span class="icon">🎯</span><?php esc_html_e( 'Skills & Clinics', 'legends-of-the-park' ); ?></h2>
    <p class="section-lead"><?php esc_html_e( 'Sharpen playbooks, footwork, and leadership with weekly specialty sessions.', 'legends-of-the-park' ); ?></p>
    <div class="clinics-grid">
        <?php foreach ( $clinics as $clinic ) : ?>
            <article class="clinic-card">
                <header>
                    <h3><?php echo esc_html( $clinic['title'] ); ?></h3>
                    <span class="badge green"><?php echo esc_html( $clinic['division'] ); ?></span>
                </header>
                <p class="clinic-card__focus"><?php echo esc_html( $clinic['focus'] ); ?></p>
                <ul class="clinic-card__meta">
                    <li><strong><?php esc_html_e( 'Coach', 'legends-of-the-park' ); ?>:</strong> <?php echo esc_html( $clinic['coach'] ); ?></li>
                    <li><strong><?php esc_html_e( 'Schedule', 'legends-of-the-park' ); ?>:</strong> <?php echo esc_html( $clinic['dates'] ); ?></li>
                </ul>
                <?php if ( ! empty( $clinic['cta_url'] ) ) : ?>
                    <a class="button-secondary" href="<?php echo esc_url( $clinic['cta_url'] ); ?>" target="_blank" rel="noopener">
                        <?php echo esc_html( $clinic['cta_label'] ); ?>
                    </a>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<section class="section registration" id="registration">
    <h2 class="section-title"><span class="icon">📝</span><?php esc_html_e( 'Registration Checklist', 'legends-of-the-park' ); ?></h2>
    <p class="section-lead"><?php esc_html_e( 'Everything captains need to lock in their roster before kickoff.', 'legends-of-the-park' ); ?></p>
    <div class="registration-grid">
        <div class="registration-card">
            <h3><?php esc_html_e( 'Steps to Qualify', 'legends-of-the-park' ); ?></h3>
            <ol class="registration-steps">
                <?php foreach ( $steps as $step ) : ?>
                    <li><?php echo esc_html( $step ); ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
        <div class="registration-card">
            <h3><?php esc_html_e( 'Need Support?', 'legends-of-the-park' ); ?></h3>
            <p><?php esc_html_e( 'Our commissioners and volunteer coordinators respond within one business day.', 'legends-of-the-park' ); ?></p>
            <ul class="registration-meta">
                <li><strong><?php esc_html_e( 'Email', 'legends-of-the-park' ); ?>:</strong> <a href="mailto:<?php echo esc_attr( $contact ); ?>"><?php echo esc_html( $contact ); ?></a></li>
                <li><strong><?php esc_html_e( 'Discord', 'legends-of-the-park' ); ?>:</strong> <a href="https://discord.gg/25bXKqSN" target="_blank" rel="noopener">discord.gg/25bXKqSN</a></li>
                <li><strong><?php esc_html_e( 'Office Hours', 'legends-of-the-park' ); ?>:</strong> <?php esc_html_e( 'Tuesdays & Thursdays • 5-7 PM PT', 'legends-of-the-park' ); ?></li>
            </ul>
        </div>
    </div>
</section>
<?php
get_footer();
