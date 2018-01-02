<?php
$basename = basename($_SERVER['PHP_SELF']);
//if (!in_array($basename, array('plugins.php', 'update.php', 'upgrade.php'))) {
//    ob_start();
//    ob_start("ob_gzhandler");
//}
/* ----------------------------------------------------------------------------------- */
# Set default timezone
/* ----------------------------------------------------------------------------------- */
date_default_timezone_set('Asia/Ho_Chi_Minh');
/* ----------------------------------------------------------------------------------- */
# Definition
/* ----------------------------------------------------------------------------------- */
if (!defined('THEME_NAME'))
    define('THEME_NAME', "PPO");

if (!defined('SHORT_NAME'))
    define('SHORT_NAME', "ppo");

if (!defined('THEME_VER'))
    define('THEME_VER', "1.0");

if (!defined('MENU_NAME'))
    define('MENU_NAME', SHORT_NAME . "_settings");
/* ----------------------------------------------------------------------------------- */
# Theme Options
/* ----------------------------------------------------------------------------------- */
$pages = get_pages();
$page_list = array();
foreach ($pages as $page) {
    $page_list[$page->ID] = $page->post_title;
}
$categories = get_categories(array('hide_empty' => 0));
$category_list = array();
foreach ($categories as $category) {
    $category_list[$category->term_id] = $category->name;
}

$options = array(
    'general' => array(
        "name" => "General",
        array("id" => "ppo_opt",
            "std" => "general",
            "type" => "hidden"),
        array("name" => "Site Options",
            "type" => "title",
            "desc" => ""),
        array("type" => "open"),
        array("name" => "Keywords meta",
            "desc" => "Enter the meta keywords for all pages. These are used by search engines to index your pages with more relevance.",
            "id" => "keywords_meta",
            "std" => "",
            "type" => "text"),
        array("name" => "Favicon",
            "desc" => "An icon associated with a particular website, and typically displayed in the address bar of a browser viewing the site. Size: 16x16",
            "id" => "favicon",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Logo",
            "desc" => "",
            "id" => "sitelogo",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Logo Mobile",
            "desc" => "",
            "id" => "mobilelogo",
            "std" => "",
            "type" => "text",
            "btn" => true),
        array("name" => "Copyright text",
            "desc" => "",
            "id" => "copyright_text",
            "std" => "",
            "type" => "text"),
        array("type" => "close"),
        
//        array("name" => "Footer Information",
//            "type" => "title",
//            "desc" => ""),
        array("type" => "open"),
        array("name" => "Footer Information",
            "desc" => "",
            "id" => "footer_info",
            "std" => "",
            "type" => "textarea",
            "editor" => array(
                "wyswig" => true,
                "rows" => 10,
            )),
        array("type" => "close"),
        array("type" => "submit"),
    ),
    'theme-options' => array(
        "name" => "Theme Options",
        array("id" => "ppo_opt",
            "std" => "theme-options",
            "type" => "hidden"),
        
//        array("name" => "Tùy chọn khác",
//            "type" => "title",
//            "desc" => "Tìm chỉnh website.",
//        ),
        array("type" => "open"),
        array("name" => "Fixed menu",
            "desc" => "Menu chính của bạn sẽ luôn dính ở phía trên trình duyệt khi cuộn chuột.",
            "id" => SHORT_NAME . "_fixedMenu",
            "std" => '',
            "type" => "checkbox"),
        array("name" => "Hotline",
            "desc" => "",
            "id" => "hotline",
            "std" => "",
            "type" => "text"),
        array("name" => "Subiz License ID",
            "desc" => "Ví dụ: 22038",
            "id" => SHORT_NAME . "_subizID",
            "std" => "",
            "type" => "text"),
        array("name" => "Zopim Key",
            "desc" => "Ví dụ: 45dRAcMR15dTPbRdXeXEtTLQAKxNDjij",
            "id" => SHORT_NAME . "_zopimKey",
            "std" => "",
            "type" => "text"),
        array("name" => "Google Analytics",
            "desc" => "Google Analytics. Ví dụ: UA-40210538-1",
            "id" => SHORT_NAME . "_gaID",
            "std" => "UA-40210538-1",
            "type" => "text"),
        array("name" => "Header Code",
            "desc" => "Phần này cho phép đặt các mã code vào đầu trang.",
            "id" => SHORT_NAME . "_headerCode",
            "std" => '',
            "type" => "textarea"),
        array("name" => "Footer Code",
            "desc" => "Phần này cho phép đặt các mã code vào cuối trang.",
            "id" => SHORT_NAME . "_footerCode",
            "std" => '',
            "type" => "textarea"),
//        array("name" => "Custom CSS",
//            "desc" => "",
//            "id" => SHORT_NAME . "_customCSS",
//            "std" => '',
//            "type" => "textarea"),
        array("type" => "close"),
        array("type" => "submit"),
    ),
//    'style-options' => array(
//        "name" => "Styling",
//        array("id" => "ppo_opt",
//            "std" => "style-options",
//            "type" => "hidden"),
//        
//        array("name" => "Header",
//            "type" => "title",
//            "desc" => ""),
//        array("type" => "open"),
//        array("name" => "Header Background",
//            "desc" => "",
//            "id" => SHORT_NAME . "_bgHeader",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Header Button 1 Background",
//            "desc" => "",
//            "id" => SHORT_NAME . "_bgBtn1",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Header Button 1 Color",
//            "desc" => "",
//            "id" => SHORT_NAME . "_colorBtn1",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Header Button 2 Background",
//            "desc" => "",
//            "id" => SHORT_NAME . "_bgBtn2",
//            "std" => "",
//            "type" => "text"),
//        array("name" => "Header Button 2 Color",
//            "desc" => "",
//            "id" => SHORT_NAME . "_colorBtn2",
//            "std" => "",
//            "type" => "text"),
//        array("type" => "close"),
//        
//        array("name" => "Menu",
//            "type" => "title",
//            "desc" => ""),
//        array("type" => "open"),
//        array("name" => "Background Menu",
//            "desc" => "",
//            "id" => SHORT_NAME . "_bgMenu",
//            "std" => "f7f5e7",
//            "type" => "text"),
//        array("name" => "Color Menu",
//            "desc" => "",
//            "id" => SHORT_NAME . "_colorMenu",
//            "std" => "141412",
//            "type" => "text"),
//        array("name" => "Background Menu Hover",
//            "desc" => "",
//            "id" => SHORT_NAME . "_bgMenuHover",
//            "std" => "220e10",
//            "type" => "text"),
//        array("name" => "Color Menu Hover",
//            "desc" => "",
//            "id" => SHORT_NAME . "_colorMenuHover",
//            "std" => "ffffff",
//            "type" => "text"),
//        array("type" => "close"),
//        
//        array("name" => "Footer",
//            "type" => "title",
//            "desc" => ""),
//        array("type" => "open"),
//        array("name" => "Background Footer",
//            "desc" => "",
//            "id" => SHORT_NAME . "_bgFooter",
//            "std" => "333333",
//            "type" => "text"),
//        array("type" => "close"),
//        array("type" => "submit"),
//    ),
);