# Legends of the Park

Discord-inspired WordPress experience for Nevada park lovers. This repository ships a bespoke theme and membership plugin that bring Kenneth Himmel’s Legends of the Park community to life with Champions Month competitions, park directories, and Discord integrations.

## Repository Layout

```
wp-content/
├── plugins/
│   └── legends-of-the-park-membership/    # Custom membership, parks, champions, events, and Discord tools
└── themes/
    └── legends-of-the-park/               # Front-end theme styled like Discord with park imagery
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
5. Visit **Legends of the Park → Control Center** in the admin dashboard to review seeded parks and configure Champions Month content.

### Optional Setup

* Create a page using the “Champions Month” template for July competitions.
* Add the `[lop_events_feed]` shortcode to any page to surface the event calendar.
* Populate **Events** and **Champions** custom post types with real stories, Discord RSVP links, and July winners.

## Shortcodes

| Shortcode | Description |
|-----------|-------------|
| `[lop_registration_form]` | Front-end membership signup with park, skills, and sports fields. |
| `[lop_member_profile]` | Logged-in user profile with Discord badges and park uploads. |
| `[lop_champions_leaderboard]` | Division leaderboard displaying champion posts. |
| `[lop_parks_directory]` | Searchable grid of Nevada parks grouped by division. |
| `[lop_competition_signup]` | Champions Month RSVP form that creates pending entries for admin approval. |
| `[lop_events_feed]` | Upcoming events list with Discord RSVP buttons. |
| `[lop_park_members]` | List of members who favor the current park (use on single park templates). |
| `[lop_park_champions]` | Champions associated with the current park. |

## Discord Integrations

* Global “Join Our Discord” buttons link to `https://discord.gg/25bXKqSN`.
* Profile forms store Discord handles and surface share buttons.
* Events include RSVP links to Discord voice chats for live coordination.

## Elementor & Gutenberg Support

* The theme registers Discord-colored palettes and editor styles for Gutenberg.
* Use Elementor sections/widgets to compose chat-inspired layouts that inherit the theme styling.

## Security Notes

* Nonces protect member registration, profile uploads, and competition signups.
* User uploads are limited to images and capped to the latest 12 submissions per member.

## Champions Month Workflow

1. Members register and select their park, skills, and sports.
2. Admins publish July **Events** with Discord RSVP links.
3. Members submit `[lop_competition_signup]` forms; entries appear pending for review.
4. Admins approve winners via the **Champions** post type which powers leaderboards.
5. Parks and champions display Discord discussion links to keep the community chatting.

## Quality Checks

Run the lightweight PHP smoke tests to verify seeded data and theming palettes remain intact after making changes:

```bash
php -l wp-content/plugins/legends-of-the-park-membership/legends-of-the-park-membership.php
php tests/parks_data_test.php
php tests/theme_palette_test.php
```

The first command performs a syntax check, while the latter scripts confirm that the Nevada park seed file retains 20+ fully-detailed entries and that the theme CSS continues to ship the emerald, sunset, and blue Discord-inspired palette required by the project brief.
