<?php


// Adding is login page function
function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

// changing the logo link from wordpress.org to your site
function quindo_login_url() {  return home_url(); }
add_filter( 'login_headerurl', 'quindo_login_url' );

// changing the alt text on the logo to show your site name
function quindo_login_title() { return get_option( 'blogname' ); }
add_filter( 'login_headertitle', 'quindo_login_title' );

// Remove unwanted items from admin menu
function quindo_remove_admin_menu_items() {
    $remove_menu_items = array('Ajax Load More', __('Dashboard'),__('Posts'),__('Media'),__('Pages'),__('Comments'),__('Appearance'),__('Plugins'),__('Users'),__('Tools'),__('Settings'),);
    $remove_menu_items = array('Pages');
    global $menu;
    end ($menu);
    while (prev($menu)){
        if (in_array($menu[key($menu)][0], $remove_menu_items))
            unset($menu[key($menu)]);
    }
}
add_action('admin_menu', 'quindo_remove_admin_menu_items');    

// Remove tags
function quindo_remove_tags(){
    register_taxonomy('post_tag', array());
}
add_action('init', 'quindo_remove_tags');

// Register styles for WYSIWYG editor
function quindo_editor_styles() {
    if (WP_ENV === 'production')
        $quindo_file_suffix = '.min';
    add_editor_style( '_/css/editor-style'.$quindo_file_suffix.'.css' );
}
add_action( 'after_setup_theme', 'quindo_editor_styles' );

// Register styles for login page
function quindo_login_css() {
    if (WP_ENV === 'production')
        $quindo_file_suffix = '.min';
    wp_enqueue_style( 'logincss', get_template_directory_uri() . '/_/css/login'.$quindo_file_suffix.'.css?'.filemtime(get_template_directory()."/_/css/login" . $quindo_file_suffix . ".css"), false );
}
add_action( 'login_enqueue_scripts', 'quindo_login_css', 10 );

function make_mce_awesome( $init ) {
    // Remove unwanted buttons in the first toolbar
    //$toolbar1_remove = array('bold','italic','strikethrough','bullist','numlist','blockquote','hr','alignleft','aligncenter','alignright','link','unlink','wp_more','spellchecker','wp_fullscreen','wp_adv',);
    $toolbar1_remove = array('hr', 'wp_more');
    $init['toolbar1'] = implode(',', array_diff(explode(',', $init['toolbar1']), $toolbar1_remove));

    // Remove unwanted buttons in the second toolbar
    //$toolbar1_remove = array('formatselect','underline','alignjustify','forecolor','pastetext','removeformat','charmap','outdent','indent','undo','redo','wp_help');
    $toolbar2_remove = array('forecolor', 'outdent', 'indent');
    $init['toolbar2'] = implode(',', array_diff(explode(',', $init['toolbar2']), $toolbar2_remove));

    // Clean up text that's pasted in
    $init['paste_remove_styles'] = true;
    $init['paste_remove_spans'] = true;

    // Update formats available to use
    //$init['block_formats'] = 'Paragraph=p;Address=address;Pre=pre;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';
    $init['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';

    return $init;
}    
add_filter('tiny_mce_before_init', 'make_mce_awesome');

function mce_add_buttons( $buttons ){
    array_splice( $buttons, 1, 0, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'mce_add_buttons' );


// Disable admin editor. Should be in config.php but let's add it here just in case
define('DISALLOW_FILE_EDIT', TRUE);