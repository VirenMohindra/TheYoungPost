<?php

// Add menus
add_theme_support( 'menus' );

// the main menu
function quindo_footer_nav() {
    wp_nav_menu(array(
        'container' => false,
        'menu' => 'The Footer Menu',
        'menu_class' => 'footer-menu',
    ));
}

function quindo_breadcrumb_nav() {
    wp_nav_menu(array(
        'container' => false,
        'menu' => 'The Footer Menu',
        'menu_class' => 'menu-breadcrumbs',
    ));
}