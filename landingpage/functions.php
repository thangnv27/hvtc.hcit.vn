<?php
/* ----------------------------------------------------------------------------------- */
# adds the plugin initalization scripts that add styles and functions
/* ----------------------------------------------------------------------------------- */
if(!current_theme_supports('deactivate_layerslider')) require_once( "config-layerslider/config.php" );//layerslider plugin

######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
//include 'libs/HttpFoundation/Response.php';
//include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
include 'libs/template-tags.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################

if (is_admin()) {
    include 'includes/plugins-required.php';
    
    // Add filter
    add_filter('acf/settings/show_admin', '__return_false');
    add_filter('acf/settings/show_updates', '__return_false');
    
    // Add action
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
//    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
}

function remove_menu_editor() {
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_theme_setup")) {

    function ppo_theme_setup() {
        global $sitepress;
        
        /*
	 * Make theme available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( SHORT_NAME, get_template_directory() . '/languages' );
        
        ## Enable Links Manager (WP 3.5 or higher)
        //add_filter('pre_option_link_manager_enabled', '__return_true');
        
        // This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 
            'css/editor-style.css',
            'css/addquicktag.min.css',
            'genericons/genericons.css', 
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
            get_stylesheet_directory_uri(), 
        ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
        
        /*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
//	add_theme_support( 'html5', array(
//            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
//	) );

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//            'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
//	) );

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
        ));
        
        // Front-end remove admin bar
        if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
            show_admin_bar(false);
        }

        // Remove WP Generator Meta Tag
        remove_action('wp_head', 'wp_generator');
        remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag' ) );
    }

}

add_action('after_setup_theme', 'ppo_theme_setup');

/* ----------------------------------------------------------------------------------- */
# Register main Scripts and Styles
/* ----------------------------------------------------------------------------------- */
add_action('admin_enqueue_scripts', 'ppo_register_scripts');

function ppo_register_scripts(){
    wp_enqueue_media();
    
    ## Get Global Styles
    wp_enqueue_style(SHORT_NAME . '-addquicktag-template', get_template_directory_uri() . '/css/addquicktag.css');
    
    ## Get Global Scripts
    wp_enqueue_script(SHORT_NAME . '-scripts', get_template_directory_uri() . '/libs/js/scripts.js', array('jquery'));
}

/**
 * Enqueue scripts and styles for the front end.
 */
function ppo_enqueue_scripts() {
    // Add Bootstrap stylesheet
    wp_enqueue_style( SHORT_NAME . '-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
    
    // Add font awesome
//    wp_enqueue_style( SHORT_NAME . '-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );
    
    // Add animate stylesheet
//    wp_enqueue_style( SHORT_NAME . '-animate', get_template_directory_uri() . '/css/animate.min.css', array(), THEME_VER );

    // Load addquicktag stylesheet
//    wp_enqueue_style( SHORT_NAME . '-addquicktag', get_template_directory_uri() . '/css/addquicktag.min.css', array(), THEME_VER );

    // Load our main stylesheet.
    wp_enqueue_style( SHORT_NAME . '-style', get_stylesheet_uri() );
    
    // Add wordpress default stylesheet
//    wp_enqueue_style( SHORT_NAME . '-wp-default', get_template_directory_uri() . '/css/wp-default.min.css', array(), THEME_VER );

    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( SHORT_NAME . '-ie', get_template_directory_uri() . '/css/ie.css', array( SHORT_NAME . '-style' ), THEME_VER );
    wp_style_add_data( SHORT_NAME . '-ie', 'conditional', 'lt IE 9' );

    if ( is_singular() && comments_open() ) {
        // Add Genericons font, used in the main stylesheet.
        wp_enqueue_style( SHORT_NAME . '-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

        // Add comment stylesheet
        wp_enqueue_style( SHORT_NAME . '-comment', get_template_directory_uri() . '/css/comment.css', array(), THEME_VER );

        // Add comment script
        wp_enqueue_script( 'comment-reply' );
    }

    // Add script references
    wp_deregister_script( 'jquery' );
//    wp_deregister_script( 'wp-embed' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '1.9.1', true );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( SHORT_NAME . '-modernizr', get_template_directory_uri() . '/js/modernizr.js', array( ), THEME_VER, true );
}

add_action( 'wp_enqueue_scripts', 'ppo_enqueue_scripts' );

/* ----------------------------------------------------------------------------------- */
# Custom Login / Logout
/* ----------------------------------------------------------------------------------- */
function change_username_wps_text($text) {
    if (in_array($GLOBALS['pagenow'], array('wp-login.php'))) {
        if ($text == 'Username') {
            $text = 'Username or Email';
        }
    }
    return $text;
}

add_filter('gettext', 'change_username_wps_text');

// remove the default filter
remove_filter('authenticate', 'wp_authenticate_username_password', 20, 3);

// add custom filter
add_filter('authenticate', 'ppo_authenticate_username_password', 20, 3);

function ppo_authenticate_username_password($user, $username, $password) {

    // If an email address is entered in the username box, 
    // then look up the matching username and authenticate as per normal, using that.
    if(is_email($username)){
        if (!empty($username))
            $user = get_user_by('email', $username);

        if (isset($user->user_login, $user))
            $username = $user->user_login;
    }

    // using the username found when looking up via email
    return wp_authenticate_username_password(NULL, $username, $password);
}

function redirect_after_logout() {
    wp_redirect(home_url());
    exit;
}

add_action('wp_logout','redirect_after_logout');

/**
 * Add admin bar items
 */
if(!is_admin()){
    add_action('admin_bar_menu', 'add_toolbar_items', 100);
}

function add_toolbar_items($admin_bar) {
    $admin_bar->remove_menu('wp-logo');
    $admin_bar->remove_menu('site-name');
    $admin_bar->remove_menu('customize');
    $admin_bar->remove_menu('updates');
    $admin_bar->remove_menu('comments');
    $admin_bar->remove_menu('wpseo-menu');
    $admin_bar->remove_menu('ubermenu');
    $admin_bar->remove_menu('itsec_admin_bar_menu');
    
    $admin_bar->add_menu(array(
        'id' => 'ppo-mn-item',
        'title' => __('Quick Tools', SHORT_NAME),
        'href' => 'javascript://',
        'meta' => array(
            'title' => __('Quick Tools', SHORT_NAME),
        ),
    ));
    $admin_bar->add_menu(array(
        'id' => 'my-second-sub-item1',
        'parent' => 'ppo-mn-item',
        'title' => 'Dashboard',
        'href' => admin_url(),
    ));
    $admin_bar->add_menu(array(
        'id' => 'my-second-sub-item2',
        'parent' => 'ppo-mn-item',
        'title' => 'Menu',
        'href' => admin_url('nav-menus.php'),
    ));
    $admin_bar->add_menu(array(
        'id' => 'my-second-sub-item3',
        'parent' => 'ppo-mn-item',
        'title' => 'Media',
        'href' => admin_url('upload.php'),
    ));
    $admin_bar->add_menu(array(
        'id' => 'my-second-sub-item4',
        'parent' => 'ppo-mn-item',
        'title' => 'Slider',
        'href' => admin_url('admin.php?page=layerslider&action=edit&id=1'),
    ));
}