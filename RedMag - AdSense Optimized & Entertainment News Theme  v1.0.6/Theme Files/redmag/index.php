<?php
/**
 * The template for displaying archive pages
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
get_header();
?>

<div class="container has-padding-top">
    <div class="row">
        <div class="main-content sidebar-right col-sm-12 col-md-9 col-lg-9" role="main">
            <?php if ( have_posts() ) : ?>
            <div class="archive-blog row">
                <?php
                // Start the Loop.
                while ( have_posts() ) : the_post();
                    ?>
                    <div class="col-md-12">
                        <?php get_template_part( 'templates/layout/content-list'); ?>
                    </div>
                    <?php
                endwhile;

                else :
                    // If no content, include the "No posts found" template.
                    get_template_part( 'content', 'none' );

                endif;
                the_posts_pagination( array(
                    'prev_text'          => '<i class="fa fa-angle-left"></i>',
                    'next_text'          => '<i class="fa fa-angle-right"></i>',
                    'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',

                ) );
                ?>
            </div>

        </div><!-- .site-main -->

        <div id="archive-sidebar" class="sidebar sidebar-right  hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-3 col-lg-3 archive-sidebar">
            <div class="content-inner">
                <?php get_sidebar('sidebar'); ?>
            </div>
        </div>

    </div><!-- .content-area -->
</div>
<?php get_footer(); ?>
