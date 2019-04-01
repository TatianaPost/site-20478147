<?php
/**
 * Single Product
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

get_header();
?>
<div class="wrap-content" role="main">
    <div class="container wrap-content-inner">
        <?php
        $single_top=get_theme_mod('redmag_single_top');
        if(isset($_GET['top'])){
            $single_top=$_GET['top'];
        }
        ?>
        <?php if ( is_active_sidebar( 'single-top' ) && $single_top ) :?>
            <div class="single-top">
                <?php dynamic_sidebar( 'single-top' );?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php do_action('single-sidebar-left'); ?>

            <?php do_action('single-content-before'); ?>
                <div class="content-inner">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content','single' );
                        // If comments are open or we have at least one comment, load up the comment template.

                        // End the loop.
                    endwhile;
                    ?>
                </div>
                <?php if ( is_active_sidebar( 'single-post' ) ) :?>
                    <div class="more-single">
                        <?php dynamic_sidebar( 'single-post' );?>
                    </div>
                <?php endif; ?>
            <?php do_action('single-content-after'); ?>

            <?php do_action('single-sidebar-right'); ?>

        </div>
    </div>
</div>
<?php get_footer(); ?>
