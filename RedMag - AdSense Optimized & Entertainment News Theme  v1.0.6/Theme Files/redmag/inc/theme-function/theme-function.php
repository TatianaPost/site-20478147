<?php
/**
 * @package     redmag
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

/* Keep Menu =========================================================================================================*/
if(!function_exists('redmag_keep_menu')){
    function redmag_keep_menu() {
        $configMenu = get_theme_mod('redmag_keep_menu',false);
        if(isset($configMenu) & $configMenu == '1'){
            $configMenu='header-fixed';
        }
        return $configMenu;
    }
}
/* Customize font Google  =========================================================================================== */
if(!function_exists('redmag_googlefont')){
    function redmag_googlefont(){
        global $wp_filesystem;
        $filepath = get_template_directory().'/assets/googlefont/googlefont.json';
        if( empty( $wp_filesystem ) ) {
            require_once( ABSPATH .'/wp-admin/includes/file.php' );
            WP_Filesystem();
        }
        if( $wp_filesystem ) {
            $listGoogleFont=$wp_filesystem->get_contents($filepath);
        }
        if($listGoogleFont){
            $gfont = json_decode($listGoogleFont);
            $fontarray = $gfont->items;
            $options = array();
            foreach($fontarray as $font){
                $options[$font->family] = $font->family;
            }
            return $options;
        }
        return false;
    }
}

/* Post Thumbnail =================================================================================================== */
if ( ! function_exists( 'redmag_post_thumbnail' ) ) :
    function redmag_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            </a>

        <?php endif; // End is_singular()
    }
endif;

/* Excerpt more  ==================================================================================================== */
function redmag_new_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'redmag_new_excerpt_more');

if(!function_exists('redmag_string_limit_words')){
    function redmag_string_limit_words($string, $word_limit)
    {
        $words = explode(' ', $string, ($word_limit + 1));

        if(count($words) > $word_limit) {
            array_pop($words);
        }

        return implode(' ', $words);
    }
}

function redmag_excerpt( $class = 'entry-excerpt' ) {
    if ( has_excerpt() || is_search() ) : ?>
        <div class="<?php echo esc_attr( $class ); ?>">
            <?php the_excerpt(); ?>
        </div><!-- .<?php echo esc_attr( $class ); ?> -->
    <?php endif;
}
/* Sub String Content =============================================================================================== */
if(!function_exists('redmag_content')) {
    function redmag_content($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
        return $excerpt;
    }
}


/* Get Category  ==================================================================================================== */
if(!function_exists('redmag_category')) {
    function  redmag_category($separator)
    {
        $first_time = 1;
        foreach ((get_the_category()) as $category) {
            $color = get_term_meta( $category->term_id, '_category_color', true );
            $style_css='';
            if($color){
                $background ="background:#$color";
                $style_css  ='style  = '.$background.'';
            }
            if ($first_time == 1) {?>
                <a href="<?php echo esc_url(get_category_link($category->term_id));?>" <?php echo esc_attr($style_css);?>  title="<?php  sprintf(esc_html__('View all posts in %s', 'redmag'), $category->name); ?>" ><?php echo esc_attr($category->name);?></a>
                <?php $first_time = 0; ?>
            <?php } else {
                echo esc_attr($separator) ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" <?php echo esc_attr($style_css);?> title="<?php  sprintf(esc_html__('View all posts in %s', 'redmag'), $category->name) ?>" ><?php  echo esc_attr($category->name); ?></a>
            <?php }
        }
    }
}

/* Add login outlink ================================================================================================ */
//add_filter( 'wp_nav_menu_items', 'redmag_loginout_link', 10, 2 );
function redmag_loginout_link($output='',$args) {

    if (!is_user_logged_in() && $args->theme_location == 'top_navigation') {
        $output .='<li><a href="'.get_permalink(get_option('woocommerce_myaccount_page_id')).'">';
        $output .='<span>'.esc_html__(' Login', 'redmag').'</span>';
        $output .='</a></li>';
    }
    elseif (is_user_logged_in() && $args->theme_location == 'top_navigation')
    {
        $output .='<li><a href="'.wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id'))).'">';
        $output .='<span>'.esc_html__(' Logout', 'redmag').'</span>';
        $output .='</a></li>';
    }
    return $output;

}

/* Config Sidebar Blog ============================================================================================== */
add_action( 'single-sidebar-left', 'redmag_single_sidebar_left' );
function redmag_single_sidebar_left() {
    $single_sidebar=get_theme_mod( 'redmag_sidebar_single', 'right' );
    $single_own    =get_theme_mod( 'redmag_single_own');
    if(isset($_GET['layout'])){
        $single_sidebar=$_GET['layout'];
    }
    if(isset($_GET['single_own'])){
        $single_own=$_GET['single_own'];
    }
    if ( $single_sidebar && $single_sidebar == 'left') { ?>
        <div id="archive-sidebar" class="sidebar col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <div class="content-inner">
                <?php
                if(is_active_sidebar( 'single' ) && $single_own ):
                    dynamic_sidebar( 'single' );
                else:
                    dynamic_sidebar( 'blogs' );
                endif;
                ?>
            </div>
        </div>
    <?php }
}
add_action( 'single-sidebar-right', 'redmag_single_sidebar_right' );
function redmag_single_sidebar_right() {
    $single_sidebar=get_theme_mod( 'redmag_sidebar_single', 'right' );
    if(isset($_GET['layout'])){
        $single_sidebar=$_GET['layout'];
    }
    $single_own    =get_theme_mod( 'redmag_single_own');
    if(isset($_GET['single_own'])){
        $single_own=$_GET['single_own'];
    }
    if ( $single_sidebar && $single_sidebar == 'right') {?>
        <div id="archive-sidebar" class="sidebar col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <div class="content-inner">
                <?php
                if(is_active_sidebar( 'single' ) && $single_own):
                    dynamic_sidebar( 'single' );
                else:
                    dynamic_sidebar( 'blogs' );
                endif;
                ?>
            </div>
        </div>
    <?php }
}
//content
add_action( 'single-content-before', 'redmag_single_content_before' );
function redmag_single_content_before() {
    $single_sidebar=get_theme_mod( 'redmag_sidebar_single', 'right' );
    if(isset($_GET['layout'])){
        $single_sidebar=$_GET['layout'];
    }
    if ( $single_sidebar && $single_sidebar == 'full') {?>
        <div class="main-content sidebar-without col-sx-12 col-sm-12 col-md-12 col-lg-12">
    <?php }
    else{?>
        <div class="main-content sidebar-<?php echo esc_html($single_sidebar)?> col-sx-12 col-sm-12 col-md-9 col-lg-9">
    <?php }
}
add_action( 'single-content-after', 'redmag_single_content_after' );
function redmag_single_content_after() {
    $single_sidebar=get_theme_mod( 'redmag_sidebar_single', 'right' );
    if ( $single_sidebar){?>
        </div>
    <?php }
}

/* Config Sidebar archive =========================================================================================== */
add_action( 'archive-sidebar-left', 'redmag_cat_sidebar_left' );
function redmag_cat_sidebar_left() {
    $cat_sidebar=get_theme_mod( 'redmag_sidebar_cat', 'right' );
    if(isset($_GET['layout'])){
        $cat_sidebar=$_GET['layout'];
    }
    if ( $cat_sidebar && $cat_sidebar == 'left') {?>
         <div id="archive-sidebar" class="sidebar col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <?php get_sidebar('sidebar'); ?>
        </div>
    <?php }
}
add_action( 'archive-sidebar-right', 'redmag_cat_sidebar_right' );
function redmag_cat_sidebar_right() {
    $cat_sidebar=get_theme_mod( 'redmag_sidebar_cat', 'right' );
    if(isset($_GET['layout'])){
        $cat_sidebar=$_GET['layout'];
    }
    if ( $cat_sidebar && $cat_sidebar == 'right') {?>
         <div id="archive-sidebar" class="sidebar col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <?php get_sidebar('sidebar'); ?>
        </div>
    <?php }
}
//content
add_action( 'archive-content-before', 'redmag_cat_content_before' );
function redmag_cat_content_before() {
    $cat_sidebar=get_theme_mod( 'redmag_sidebar_cat', 'right' );
    if(isset($_GET['layout'])){
        $cat_sidebar=$_GET['layout'];
    }
    if ( $cat_sidebar && $cat_sidebar == 'full') {?>
        <div class="main-content col-md-12 col-lg-12">
    <?php }
    else{?>
        <div class="main-content sidebar-<?php echo esc_html($cat_sidebar)?> col-sx-12 col-sm-12 col-md-9 col-lg-9">
    <?php }
}
add_action( 'archive-content-after', 'redmag_cat_content_after' );
function redmag_cat_content_after() {
    $cat_sidebar=get_theme_mod( 'redmag_sidebar_cat', 'right' );
    if ( $cat_sidebar){?>
        </div>
    <?php }
}


/* Comment Form ===================================================================================================== */
function redmag_comment_form($arg,$class='btn-variant',$id='submit'){
    ob_start();
    comment_form($arg);
    $form = ob_get_clean();
    echo str_replace('id="submit"','id="'.$id.'"', $form);
}

function redmag_list_comments($comment, $args, $depth){
    $path = get_template_directory() . '/templates/list_comments.php';
    if( is_file($path) ) require ($path);
}


/* Facebook Comments =================================================================================================*/
add_action('wp_head', 'redmag_facebook_comments');
function redmag_facebook_comments() {
        $app_id=get_theme_mod('redmag_comments_single',''); ?>
        <meta property="fb:app_id" content="<?php echo esc_attr($app_id);?>" />
<?php }


/* Ajax Feature Post =================================================================================================*/
add_action('wp_ajax_feature_post', 'redmag_feature_post');
add_action('wp_ajax_nopriv_feature_post', 'redmag_feature_post');
function redmag_feature_post() {
    if (check_admin_referer( 'redmag-feature-post' ) ) {
        $post_id = absint( $_GET['post_id'] );
        if ( 'post' === get_post_type( $post_id ) ) {
            update_post_meta( $post_id, '_featured', get_post_meta( $post_id, '_featured', true ) === 'yes' ? 'no' : 'yes' );
            delete_transient( 'redmag_featured_post' );
        }
    }
    wp_safe_redirect( wp_get_referer() ? remove_query_arg( array( 'trashed', 'untrashed', 'deleted', 'ids' ), wp_get_referer() ) : admin_url( 'edit.php' ) );
    die();
    }

    // add featured thumbnail to admin post columns
    function redmag_add_thumbnail_columns( $columns ) {
        $columns['post_featured'] = esc_html__('Featured', 'redmag');
        return $columns;
    }
    function redmag_is_featured() {
        $featured =get_post_meta( get_the_ID(), '_featured', true );
        return $featured === 'yes' ? true : false;
    }
    function redmag_add_thumbnail_columns_data( $column_name, $post_id) {
        if ($column_name === 'post_featured') {
        $url = wp_nonce_url( admin_url( 'admin-ajax.php?action=feature_post&post_id=' . get_the_ID() ), 'redmag-feature-post' );
        echo '<a href="' . esc_url( $url ) . '" title="'. esc_html__( 'Toggle featured', 'redmag' ) . '">';
            if (redmag_is_featured()) {
            echo '<span class="redmag-featured tips" data-tip="' . esc_attr__( 'Yes', 'redmag' ) . '"><span class="dashicons dashicons-star-filled"></span> </span>';
            } else {
            echo '<span class="redmag-featured not-featured tips" data-tip="' . esc_attr__( 'No', 'redmag' ) . '"><span class="dashicons dashicons-star-empty"></span></span>';
            }
            echo '</a>';
        }
    }

    if ( function_exists( 'add_theme_support' ) ) {
    add_filter( 'manage_posts_columns' , 'redmag_add_thumbnail_columns' );
    add_action( 'manage_posts_custom_column' , 'redmag_add_thumbnail_columns_data', 10, 2 );
}

/* PostViews =========================================================================================================*/
function redmag_post_views($post_ID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($post_ID, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_ID, $count_key, $count);
    }
}

function redmag_track_post_views($post_id)
    {
        if (!is_single()) return;
        if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    redmag_post_views($post_id);
}
add_action('wp_head', 'redmag_track_post_views');

function redmag_get_PostViews($post_ID)
    {
        $count_key = 'post_views_count';
        $count = get_post_meta($post_ID, $count_key, true);
        return $count;
    }

function redmag_post_column_views($newcolumn)
    {
        $newcolumn['post_views'] = esc_html__('Views', 'redmag');
        return $newcolumn;
    }

function redmag_post_custom_column_views($column_name, $id)
    {
        if ($column_name === 'post_views') {
        echo esc_attr(redmag_get_PostViews(get_the_ID()));
    }
}

add_filter('manage_posts_columns', 'redmag_post_column_views');
add_action('manage_posts_custom_column', 'redmag_post_custom_column_views', 10, 2);


/* Move comment field to bottom ======================================================================================*/
function redmag_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'redmag_move_comment_field_to_bottom' );
?>
