# Legends of the Park

Static flag football operations hub for Nevada captains. This repository ships a bespoke WordPress theme and membership plugin that powers schedules, scouting intel, and training programs for the Legends of the Park flag football league.

## Repository Layout

```
wp-content/
├── plugins/
│   └── legends-of-the-park-membership/    # Custom league data, registration tools, and shortcodes
└── themes/
    └── legends-of-the-park/               # Front-end theme styled like a night-game command center
```

## Prerequisites

* PHP 8.0+
* MySQL 5.7+ / MariaDB equivalent
* WordPress 6.3+

## Local Installation

1. Install WordPress following the [official guide](https://wordpress.org/support/article/how-to-install-wordpress/).
2. Clone this repository into your WordPress directory (`wp-content` will merge with the existing directory).
3. Activate the **Legends of the Park** theme from Appearance → Themes.
4. Activate the **Legends of the Park Membership** plugin from Plugins.
5. Visit **Legends of the Park → Control Center** in the admin dashboard to review division rosters and configure weekly schedules.

### Optional Setup

* Create a page using the “Champions Month” template for spotlight events.
* Add the `[lop_registration_form]` shortcode to capture team registrations and waivers.
* Populate **Events** and **Champions** custom post types with matchup recaps, Discord RSVP links, and highlight reels.

## Shortcodes

| Shortcode | Description |
|-----------|-------------|
| `[lop_registration_form]` | Front-end membership signup with roster, captains, and division preferences. |
| `[lop_member_profile]` | Logged-in team hub with Discord badges and document uploads. |
| `[lop_champions_leaderboard]` | Division leaderboard displaying championship points. |
| `[lop_parks_directory]` | Searchable grid of training facilities and team amenities. |
| `[lop_competition_signup]` | RSVP form for scrimmages and showcase events. |
| `[lop_events_feed]` | Upcoming games list with kickoff times and volunteer needs. |
| `[lop_park_members]` | List of members who favor the current training venue. |
| `[lop_park_champions]` | Champions associated with the current division. |

## Discord Integrations

* Global “Join Our Discord” buttons link to `https://discord.gg/25bXKqSN`.
* Registration forms store Discord handles and surface scrimmage coordination links.
* Events include RSVP links to Discord voice chats for gameday logistics.

## Clinics & Player Development

* The theme highlights weekly clinics and downloadable playbooks.
* Mentorship pairings, SafeSport certifications, and film-room resources are surfaced in the Training section.

## Security Notes

* Nonces protect member registration, roster uploads, and competition signups.
* User uploads are limited to images and capped to the latest 12 submissions per member.

## Season Workflow

1. Captains register squads, choose divisions, and upload waivers.
2. Admins publish weekly **Events** with Discord RSVP links.
3. Teams confirm `[lop_competition_signup]` entries; commissioners approve volunteer assignments.
4. Match recaps and stats feed the **Champions** leaderboard.
5. Clinics and scouting links keep teams improving between game nights.

## Quality Checks

Run the lightweight PHP smoke tests to verify league data and theming palettes remain intact after making changes:

```bash
php -l wp-content/plugins/legends-of-the-park-membership/legends-of-the-park-membership.php
php tests/parks_data_test.php
php tests/theme_palette_test.php
```

The first command performs a syntax check, while the latter scripts confirm that the league seed file retains 20+ fully-detailed entries and that the theme CSS continues to ship the emerald, sunset, and blue palette required by the project brief.
