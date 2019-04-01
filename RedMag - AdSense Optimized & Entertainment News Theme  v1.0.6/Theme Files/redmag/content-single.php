<?php
/**
 * The default template for displaying content
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
?>
<div class="box box-article">
    <article id="post-<?php the_ID(); ?>" <?php  post_class();?>>
        <?php if(has_post_format('gallery')) : ?>

            <?php $images = get_post_meta( $post->ID, '_format_gallery_images', true ); ?>

            <?php if($images) : ?>
                <div class="post-image single-image">
                    <ul class="owl-single">
                        <?php foreach($images as $image) : ?>
                            <?php $the_image = wp_get_attachment_image_src( $image, 'redmag-single-post' ); ?>
                            <?php $the_caption = get_post_field('post_excerpt', $image); ?>
                            <li><img src="<?php echo esc_url($the_image[0]); ?>" <?php if($the_caption) : ?>title="<?php echo esc_attr($the_caption); ?>"<?php endif; ?> /></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php elseif(has_post_format('video')) : ?>

                <div class="embed-responsive embed-responsive-16by9 post-video single-video embed-responsive embed-responsive-16by9">
                    <?php $sp_video = get_post_meta( get_the_ID(), '_format_video_embed', true ); ?>
                    <?php if(wp_oembed_get( $sp_video )) : ?>
                        <?php echo wp_oembed_get($sp_video); ?>
                    <?php else : ?>
                        <?php echo esc_url($sp_video); ?>
                    <?php endif; ?>
                </div>

            <?php elseif(has_post_format('audio')) : ?>

                <div class="post-image audio single-audio">
                    <?php $sp_audio = get_post_meta( $post->ID, '_format_audio_embed', true ); ?>
                    <?php if(wp_oembed_get( $sp_audio )) : ?>
                        <?php echo str_replace($search, $replace, wp_oembed_get($sp_audio)); ?>
                    <?php else : ?>
                        <?php echo str_replace('','', $sp_audio); ?>
                    <?php endif; ?>
                </div>

            <?php else : ?>

            <?php if(has_post_thumbnail()) : ?>
                <?php if(!get_theme_mod('sp_post_thumb')) : ?>
                    <div class="post-image single-image ">
                        <?php the_post_thumbnail('redmag-single-post'); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        <?php endif; ?>
        <div class="entry-header clearfix">
            <header class="entry-header-title">
                <?php  the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header>
            <!-- .entry-header -->
            <?php redmag_excerpt(); ?>
            <div class="entry-avatar clearfix">
                <span class="author-by"><?php echo esc_html__('By','redmag')?></span>
                <span class="author-title">
                    <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php echo esc_attr(get_the_author()); ?>
                    </a>
                </span>
                <span class="post-date">
                    <span class="author-on"><?php echo esc_html__('on','redmag')?></span>
                    <?php echo get_the_date('M d, Y'); ?>
                </span>
                <div class="entry-header-share">
                    <?php get_template_part('templates/share'); ?>
                </div>
            </div>
        </div>

        <div class="entry-content">

            <?php
                //ads
                if(get_theme_mod('redmag_ads_single_article')) {?>
                    <div class="ads_content_single ads-before-content">
                        <?php echo  get_theme_mod('redmag_ads_rectangle');?>
                    </div>
                <?php }

                the_content();

                //ads
                if(get_theme_mod('redmag_ads_single_article')) {?>
                    <div class="advertising_content_single">
                        <?php echo  get_theme_mod('redmag_ads_leaderboard');?>
                    </div>
                <?php }
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'redmag' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span class="page-numbers">',
                    'link_after'  => '</span>',
                    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'redmag' ) . ' </span>%',
                    'separator'   => '<span class="screen-reader-text">, </span>',
                ) );

            ?>
        </div>
    <!--    Author bio.-->
        <div class="entry-footer clearfix">
            <div class="entry-footer-social clearfix">
                <div class="entry-footer-left">
                    <?php get_template_part('templates/tag'); ?>
                </div>
                <div class="entry-footer-right">
                    <?php get_template_part('templates/share'); ?>
                </div>
            </div>

        </div>
    </article>
</div>
<div class="box box-author">
    <?php
    if ( '' !== get_the_author_meta( 'description' ) ) {
        get_template_part('templates/about_author');
    }
    ?>
</div>
<?php get_template_part('templates/post_pagination'); ?>


<?php
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
    //ads
    if(get_theme_mod('redmag_ads_single_comment')) {?>
        <div class="advertising_content_single">
            <?php echo  get_theme_mod('redmag_ads_leaderboard');?>
        </div>
    <?php }
     //related
    get_template_part('templates/related_posts');
    ?>
