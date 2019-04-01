<?php
$placeholder_image_footer = get_template_directory_uri(). '/assets/images/bg_default_footer.jpg';
$bg_image_footer = get_theme_mod('redmag_footer_image', '');
($bg_image_footer) ?$bg="background-image: url('$bg_image_footer')" :$bg='background-image: url("'.$placeholder_image_footer.'")';

if(get_theme_mod('redmag_enable_footer', '1')) { ?>
    <footer id="na-footer" class="na-footer  footer-1" style = "<?php echo esc_attr($bg);?>">

        <!--    Footer center-->
        <?php  if(is_active_sidebar( 'footer-1a' ) || is_active_sidebar( 'footer-1b' ) || is_active_sidebar( 'footer-1c' )){ ?>
            <!--    Footer center-->
            <div class="footer-center clearfix">
                <div class="container">
                    <div class="container-inner">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer-1a'); ?>
                            </div>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer-1b'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer-1c'); ?>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <?php dynamic_sidebar('footer-1d'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>

        <!--    Footer bottom-->
        <div class="footer-bottom clearfix">
            <div class="container">
                <div class="container-inner">
                    <div class="row">

                        <div class="col-md-6 col-sm-6">
                            <div class="coppy-right">
                                <?php if(get_theme_mod('redmag_copyright_text')) {?>
                                    <span><?php echo  wp_kses_post(get_theme_mod('redmag_copyright_text'));?></span>
                                <?php } else {
                                    echo '<span>'.esc_html('@ All Right Reserved ','redmag').' '.date("Y").'<a href="'.esc_url('http://redmag.nanoagency.co').'">'.esc_html('  RedMag Theme','redmag').'</a></span>';
                                } ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 footer-bottom-left">
                            <?php dynamic_sidebar('copy-right'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </footer><!-- .site-footer -->
<?php } ?>
