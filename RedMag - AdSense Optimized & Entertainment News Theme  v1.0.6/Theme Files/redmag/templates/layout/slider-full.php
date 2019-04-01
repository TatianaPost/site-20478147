<?php
/**
 * The default template for displaying content
 *
 * @author      Nanoredmag
 * @link        http://nanoredmag.co
 * @copyright   Copyright (c) 2015 Nanoredmag
 * @license     GPL v2
 */
$format = get_post_format();
$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
$bg_image="background-image:url('$thumbnail_src[0]')";
?>

<article <?php post_class('post-item post-tran  clearfix'); ?>>
    <div class="article-tran hover-share-item">
        <?php if(has_post_thumbnail()) : ?>
            <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                <?php if(has_post_thumbnail()) : ?>
                    <div class="post-image lazy"  data-src="<?php echo esc_attr($thumbnail_src[0]);?>" data-lazy="<?php echo esc_attr($thumbnail_src[0]);?>">
                        <a href="<?php echo get_permalink() ?>"></a>
                    </div>
                <?php endif;?>
                <span class="bg-rgb"></span>
                <div class="article-content">
                    <span class="post-cat"><?php echo redmag_category(' '); ?></span>
                    <div class="entry-header clearfix">
                        <header class="entry-header-title">
                            <?php
                            the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                            ?>
                        </header>
                    </div>
                    <div class="entry-meta clearfix">
                        <?php redmag_entry_meta(); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php else :
            $placeholder_image = get_template_directory_uri(). '/assets/images/layzyload-trans.jpg';
            ?>
            <div class="post-image  placeholder-trans ">
                <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('buggy-blog-tran'); ?>
                    <img src="<?php echo esc_url($placeholder_image); ?>" class="wp-post-image" width="1170" height="500">
                </a>
            </div>
            <span class="bg-rgb"></span>
            <div class="article-content">
                <span class="post-cat"><?php echo redmag_category(' '); ?></span>
                <div class="entry-header clearfix">
                    <header class="entry-header-title">
                        <?php
                        the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                        ?>
                    </header>
                </div>
                <div class="entry-meta clearfix">
                    <?php redmag_entry_meta(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

</article><!-- #post-## -->
