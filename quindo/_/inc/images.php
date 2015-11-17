<?php

// Add featured images
// add_theme_support( 'post-thumbnails' );    

// Thumbnail sizes
add_image_size( 'quindo-menuArt', 85, 65, true );
add_image_size( 'quindo-card1', 320, 550, true );
add_image_size( 'quindo-card2', 660, 550, true );
add_image_size( 'quindo-card3', 1000, 550, true );
add_image_size( 'quindo-featured-inside', 1200, 600, true );
add_image_size( 'quindo-featured-front', 1200, 850, true );

// Add thumbnail options to select in media manager
function quindo_custom_image_sizes( $sizes ) {
    // return array_merge( $sizes, array(
    //     'quindo-thumb-600' => __('600px by 150px'),
    // ) );
}
//add_filter( 'image_size_names_choose', 'quindo_custom_image_sizes' );