<?php
/**
 * The template for displaying pages
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

get_header();

$redmag_title     = get_post_meta(get_the_ID(), 'redmag_disable_title',true);
?>

<div class="wrap-content" role="main">
    <?php if($redmag_title != '1'){?>
        <div class="cat-header clearfix">
            <div class="container">
                <?php the_title( '<h1 class="title-page">', '</h1>' );?>
            </div>
        </div>
    <?php }?>
    <div class="container wrap-content-inner">
        <div class="row">
            <div class="site-main page-content col-sm-12 " role="main">
                    <?php
                    while ( have_posts() ) : the_post();?>
                        <?php get_template_part( 'content', 'page' );
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile;
                    ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>