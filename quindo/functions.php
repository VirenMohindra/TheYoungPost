<?php
    /* ----------------------------------------------------------------------------
     Config
    -------------------------------------------------------------------------------*/

    // Configuration values
    define('GOOGLE_ANALYTICS_ID', false); // UA-XXXXX-Y

    if (!defined('WP_ENV')) {
        define('WP_ENV', 'production');
    }
    /* ----------------------------------------------------------------------------
     Include Files
    -------------------------------------------------------------------------------*/
    // Admin Section
    include('_/inc/admin.php');

    // Wp_head Clean Up
    include('_/inc/cleanup.php');

    // Styles, Scripts, & Enqueueing
    include('_/inc/scripts.php');

    // Custom Theme Utility Functions
    include('_/inc/utilities.php');

    // Featured Images and Image Sizes
    include('_/inc/images.php');

    // Custom Post Types / Taxonomies
    // include('_/inc/post_types.php');
    
    // Menus / Nav
    include('_/inc/nav.php');

    // New meta information for categories
    include('_/inc/cat_meta.php');

    // Ajax Load More functions
    include('_/inc/load_more.php');

    // Rewrite URL
    include('_/inc/rewrite.php');
?>