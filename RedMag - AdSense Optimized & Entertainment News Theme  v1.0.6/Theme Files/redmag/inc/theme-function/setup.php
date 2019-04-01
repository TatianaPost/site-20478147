<?php
/**
 * @package     redmag
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

/*  Setup Theme ===================================================================================================== */
add_action( 'after_setup_theme', 'redmag_theme_setup' );
if ( ! function_exists( 'redmag_theme_setup' ) ) :
    function redmag_theme_setup() {
        load_theme_textdomain( 'redmag', get_template_directory() . '/languages' );

        //  Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        //  Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        //  Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        //Enable support for Post Formats.
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ) );

        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ) );

        add_theme_support( 'custom-header' );

        add_theme_support( 'custom-background' );

        add_theme_support( "title-tag" );

        add_theme_support( 'woocommerce' );
    }
endif;

/* Thumbnail Sizes ================================================================================================== */
set_post_thumbnail_size( 220, 150, true);

add_image_size( 'redmag-blog-list', 491, 280, true);
add_image_size( 'redmag-blog-list-large', 614, 320, true);
add_image_size( 'redmag-sidebar', 100 ,100, true);

add_image_size( 'redmag-blog-grid', 496, 290, true);

add_image_size( 'redmag-blog-tran', 480 ,250, true);
add_image_size( 'redmag-blog-tran-vertical', 328 ,480, true);

add_image_size( 'redmag-blog-video',480,150,true);


add_image_size( 'redmag-mini-list', 150 ,100, true);

add_image_size( 'redmag-blog-tran-large', 770 ,420, true);

add_image_size( 'redmag-blog-vertical', 510 ,680, true);

add_image_size( 'redmag-related-image',370,247,true);


/* Setup Font ======================================================================================================= */
function redmag_font_url() {
    $fonts_url = '';
    $oswald     = _x( 'on', 'Oswald font: on or off', 'redmag' );
    $poppins     = _x( 'on', 'Open Sans font: on or off', 'redmag' );
    if ( 'off' !== $oswald ) {
        $font_families = array();
        if ( 'off' !== $oswald ) {
            $font_families[] = 'Oswald:400,500,700';
        }
        if ( 'off' !== $poppins ) {
            $font_families[] = 'Poppins:300,400,500,600,700';
        }
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
}


/* Load Front-end scripts  ========================================================================================== */
add_action( 'wp_enqueue_scripts', 'redmag_theme_scripts');
function redmag_theme_scripts() {

    // Add  fonts, used in the main stylesheet.
    wp_enqueue_style( 'redmag_fonts', redmag_font_url(), array(), null );

    //style plugins
    if(is_rtl()){
        wp_enqueue_style('bootstrap-rtl',get_template_directory_uri().'/assets/css/bootstrap-rtl.min.css', array(), '3.0.2');
    }else{
        wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), '3.0.2');
    }

    wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), '4.6.3');
    wp_enqueue_style('themify-icons',get_template_directory_uri().'/assets/css/themify-icons.css', array(),null);
    //style MAIN THEME
    wp_enqueue_style( 'redmag-main', get_template_directory_uri(). '/style.css', array(), null );
    //style skin
    wp_enqueue_style('redmag-css', get_template_directory_uri().'/assets/css/style-default.min.css' );

    //register all plugins
    wp_enqueue_script( 'plugins', get_template_directory_uri().'/assets/js/plugins.min.js', array(), null, true );
    wp_enqueue_script( 'videoController', get_template_directory_uri().'/assets/js/plugins/jquery.videoController.min.js', array(), null, true );
    wp_enqueue_script('jquery-masonry');
    wp_register_script('tweets-widgets', get_template_directory_uri().'/assets/js/plugins/tweets-widgets.min.js','jquery', '2.3.0', true);

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'redmag-theme-keyboard-image-navigation', get_template_directory_uri() . '/assets/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20141010' );
    }

    //jquery MAIN THEME
    wp_enqueue_script('isotope-init', get_template_directory_uri() . '/assets/js/dev/isotope-init.js', array('jquery'),null, true);
    wp_enqueue_script('redmag', get_template_directory_uri() . '/assets/js/dev/redmag.js', array('jquery'),null, true);

}

/* Load Back-end SCRIPTS============================================================================================= */
function redmag_js_enqueue(){
    wp_enqueue_media();
    wp_enqueue_style('thickbox');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    // moved the js to an external file, you may want to change the path
    wp_enqueue_script('information_js',get_template_directory_uri(). '/assets/js/widget.min.js', 'jquery', '1.0', true);
}
add_action('admin_enqueue_scripts', 'redmag_js_enqueue');

/* Register the required plugins    ================================================================================= */
add_action( 'tgmpa_register', 'redmag_register_required_plugins' );
function redmag_register_required_plugins() {

    $plugins = array(
        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'      => esc_html__( 'Nano Core Plugin', 'redmag' ),
            'slug'      => 'theme-core',
            'source'    => get_template_directory() . '/inc/theme-plugins/theme-core.zip',
            'required'  => true,
            'version'   => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/nano.jpg',

        ),
        //Contact form 7
        array(
            'name'      => esc_html__('Contact Form 7', 'redmag' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/contact-form7.jpg',
        ),
        //WPBakery Visual Composer
        array(
            'name'      =>  esc_html__('WPBakery Visual Compose', 'redmag' ),
            'slug'      => 'js_composer',
            'source'    => get_template_directory() . '/inc/theme-plugins/js_composer.zip',
            'required'  => true,
            'version'   => '5.4.5',
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/vc.jpg',
        ),
        //MailChimp for WordPress
        array(
            'name'      =>  esc_html__('MailChimp for WordPress ', 'redmag' ),
            'slug'      => 'mailchimp-for-wp',
            'required'  => false,
            'image_url' => get_template_directory_uri() . '/inc/backend/assets/images/plugins/mailchimp.jpg',
        ),

    );

    $config = array(
        'id'           => 'redmag',                   // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                       // Default absolute path to pre-packaged plugins.
        'has_notices'  => true,
        'menu'         => 'tgmpa-install-plugins',  // Menu slug.
        'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'is_automatic' => true,                     // Automatically activate plugins after installation or not.
        'message'      => '',                       // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );

}

/* Register Navigation ============================================================================================== */
register_nav_menus( array(
    'primary_navigation'    => esc_html__( 'Primary Navigation', 'redmag' ),
    'top_navigation'        => esc_html__( 'Topbar Navigation', 'redmag' )
) );


/* Register Sidebar ================================================================================================= */
if ( function_exists('register_sidebar') ) {
    register_sidebar( array(
        'name'          => esc_html__( 'Archive', 'redmag' ),
        'id'            => 'archive',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'redmag' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Blogs', 'redmag' ),
        'id'            => 'blogs',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'redmag' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 1', 'redmag' ),
        'id'            => 'sidebar1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'redmag' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar(array(
        'name' => esc_html__('Footer Top','redmag'),
        'id'   => 'footer-top',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 1','redmag'),
        'id'   => 'footer-1a',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 2','redmag'),
        'id'   => 'footer-1b',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 3','redmag'),
        'id'   => 'footer-1c',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer 1 Column 4','redmag'),
        'id'   => 'footer-1d',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Custom Header Left','redmag'),
        'id'   => 'custom-header-middle',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Custom Copy Right','redmag'),
        'id'   => 'copy-right',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Single Top','redmag'),
        'id'   => 'single-top',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Single','redmag'),
        'id'   => 'single',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Bottom Single','redmag'),
        'id'   => 'single-post',
        'before_widget' => '<div id="%1$s" class="widget first %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}