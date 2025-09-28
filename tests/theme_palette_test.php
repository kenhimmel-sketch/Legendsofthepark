<?php
$css_path = __DIR__ . '/../wp-content/themes/legends-of-the-park/assets/css/main.css';

if ( ! file_exists( $css_path ) ) {
    throw new RuntimeException( 'Theme CSS file not found: ' . $css_path );
}

$css = file_get_contents( $css_path );

if ( false === $css ) {
    throw new RuntimeException( 'Unable to read theme CSS file.' );
}

$required_colors = array(
    '#228B22' => 'Emerald green for park energy',
    '#FF8C00' => 'Sunset orange for activity',
    '#4682B4' => 'Cool blue for calm channels',
);

$missing = array();
foreach ( $required_colors as $color => $description ) {
    if ( false === stripos( $css, $color ) ) {
        $missing[] = sprintf( '%s (%s)', $color, $description );
    }
}

if ( ! empty( $missing ) ) {
    throw new RuntimeException( 'Missing required palette colors: ' . implode( ', ', $missing ) );
}

echo "Theme palette validation passed. All required colors detected." . PHP_EOL;
