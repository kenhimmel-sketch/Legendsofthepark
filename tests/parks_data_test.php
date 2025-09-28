<?php
$parks = include __DIR__ . '/../wp-content/plugins/legends-of-the-park-membership/data/parks.php';

if ( ! is_array( $parks ) || empty( $parks ) ) {
    throw new RuntimeException( 'Parks data file did not return an array.' );
}

$total_parks   = 0;
$invalid_parks = [];

foreach ( $parks as $division => $park_list ) {
    if ( ! is_string( $division ) || '' === trim( $division ) ) {
        $invalid_parks[] = 'Division key must be a non-empty string.';
        continue;
    }

    if ( ! is_array( $park_list ) || empty( $park_list ) ) {
        $invalid_parks[] = sprintf( 'Division "%s" is missing park entries.', $division );
        continue;
    }

    foreach ( $park_list as $index => $park ) {
        $total_parks++;

        foreach ( array( 'name', 'location', 'amenities' ) as $field ) {
            if ( ! isset( $park[ $field ] ) || '' === trim( (string) $park[ $field ] ) ) {
                $invalid_parks[] = sprintf( 'Division "%1$s" park #%2$d is missing field "%3$s".', $division, $index + 1, $field );
            }
        }
    }
}

if ( $total_parks < 20 ) {
    $invalid_parks[] = sprintf( 'Expected at least 20 parks, found %d.', $total_parks );
}

if ( ! empty( $invalid_parks ) ) {
    throw new RuntimeException( implode( PHP_EOL, $invalid_parks ) );
}

echo sprintf(
    "Parks data validation passed with %d parks across %d divisions." . PHP_EOL,
    $total_parks,
    count( $parks )
);
