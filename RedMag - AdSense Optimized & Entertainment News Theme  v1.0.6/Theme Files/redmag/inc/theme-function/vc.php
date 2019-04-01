<?php
/**
 * @package     redmag
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

if (class_exists('WPBakeryVisualComposerAbstract')) {

    function redmag_vc_templates( $default_templates ) {
        // New templates
        $new_templates = array(
            'templates-home-1' => array(
                'name' 			=> esc_html__( 'Templates Home 1', 'redmag' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home1.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1502372953064{background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column3" type_post="yes" number_post="6" title="Today News" category_name=""][/vc_column][/vc_row][vc_row css=".vc_custom_1502210615550{margin-top: 60px !important;}"][vc_column][vc_single_image image="1013" img_size="full" alignment="center"][/vc_column][/vc_row][vc_row][vc_column css=".vc_custom_1502529981371{margin-top: 0px !important;padding-top: 0px !important;padding-right: 35px !important;}" offset="vc_col-lg-9 vc_col-md-12"][box_category layout_types="box2" type_post="yes" show_cate="" number_post="3" filter="yes" text_align="yes" title="Trending this Week" category_name=""][box_category layout_types="box6" show_cate="" number_post="4" filter="" title="Summer" category_name="" el_class="left" link="" cat_link="http://localhost/wp/wp-redmag/category/summer/"][box_category layout_types="box2b" show_cate="" number_post="3" filter="" title="Entertainment" category_name="" el_class="left" link="http://localhost/wp/wp-redmag/category/summer/" cat_link="http://localhost/wp/wp-redmag/category/entertainment/"][box_category layout_types="box2" show_cate="" number_post="3" filter="" title="Lifestyle" category_name="" el_class="left" cat_link="http://localhost/wp/wp-redmag/category/lifestyle/"][vc_single_image image="912" img_size="full" alignment="center" css=".vc_custom_1502365782942{margin-top: 30px !important;}"][blog filter="" category_name="" title="Latest News" el_class="left"][/vc_column][vc_column el_class="sidebar" css=".vc_custom_1502529975397{margin-top: 35px !important;margin-bottom: -35px !important;padding-right: 15px !important;padding-left: 15px !important;}" offset="vc_col-lg-3 vc_col-md-12"][vc_widget_sidebar sidebar_id="sidebar1"][/vc_column][/vc_row]'
            ),
            'templates-home-2' => array(
                'name' 			=> esc_html__( 'Templates Home 2', 'redmag' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home2.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1502428813309{margin-top: 0px !important;background-image: url(http://localhost/wp/wp-redmag/wp-content/uploads/2017/07/bg-single.jpg?id=554) !important;background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column1" category_name=""][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-lg-9 vc_col-md-9" css=".vc_custom_1502456774667{margin-top: 30px !important;padding-right: 35px !important;}"][box_video layout_types="carousel" auto_play="" text_align="" category_name=""][box_category layout_types="box2" type_post="yes" show_cate="" number_post="6" filter="yes" text_align="yes" title="Most Popular" category_name=""][vc_single_image image="912" img_size="full" alignment="center" css=".vc_custom_1502457080688{margin-top: 40px !important;}"][blog category_name="" title="Latest News"][/vc_column][vc_column css=".vc_custom_1502428895432{margin-top: 52px !important;padding-right: 15px !important;padding-left: 15px !important;}" el_class="sidebar" offset="vc_col-lg-3 vc_col-md-3"][vc_widget_sidebar sidebar_id="sidebar1"][/vc_column][/vc_row][vc_row][vc_column css=".vc_custom_1502456973543{margin-top: 80px !important;margin-bottom: 0px !important;}"][vc_single_image image="1013" img_size="full" alignment="center"][/vc_column][/vc_row]'
            ),
            'templates-home-3' => array(
                'name' 			=> esc_html__( 'Templates Home 3', 'redmag' ),
                'weight' 		=> 0,
                'image_path' 	=> get_template_directory_uri() . '/inc/backend/assets/images/home/home3.jpg',
                'custom_class'	=> '',
                'content' 		=> '[vc_row full_width="stretch_row" css=".vc_custom_1501923482717{margin-top: -30px !important;background-image: url(http://localhost/wp/wp-redmag/wp-content/uploads/2017/07/bg-single.jpg?id=554) !important;background-position: 0 0 !important;background-repeat: repeat !important;}"][vc_column][top_blog layout_types="column4b" type_post="yes" number_post="5"][/vc_column][/vc_row][vc_row][vc_column offset="vc_col-lg-9 vc_col-md-9" css=".vc_custom_1502385693005{padding-right: 35px !important;}"][blog_featured][box_video layout_types="list" auto_play="" title="Watch now"][box_category layout_types="box2" show_cate="" number_post="3" filter="" text_align="" title="Lifestyle" cat_link="http://localhost/wp/wp-redmag/category/style/"][box_category layout_types="box9" show_cate="" number_post="3" filter="" text_align="" title="Entertainment" cat_link="http://localhost/wp/wp-redmag/category/entertainment/"][box_category layout_types="box6" show_cate="" number_post="4" filter="" text_align="" title="Summer" cat_link="http://localhost/wp/wp-redmag/category/summer/"][blog post_layout="grid" ads_layout="no-ads" columns="2" filter="" text_align="" title="News latest"][/vc_column][vc_column el_class="sidebar" css=".vc_custom_1502385727563{margin-top: 60px !important;margin-bottom: -38px !important;padding-right: 15px !important;padding-left: 15px !important;}" offset="vc_col-lg-3 vc_col-md-3"][vc_widget_sidebar sidebar_id="sidebar1"][/vc_column][/vc_row]'
            ),
            'templates-contact-us' => array(
                'name' 			=> esc_html__( 'Templates Contact Us', 'redmag' ),
                'weight' 		=> 0,
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1501780296562{margin-top: 0px !important;}"][vc_column][vc_gmaps link="#E-8_JTNDaWZyYW1lJTIwc3JjJTNEJTIyaHR0cHMlM0ElMkYlMkZ3d3cuZ29vZ2xlLmNvbSUyRm1hcHMlMkZlbWJlZCUzRnBiJTNEJTIxMW0xOCUyMTFtMTIlMjExbTMlMjExZDYzMDQuODI5OTg2MTMxMjcxJTIxMmQtMTIyLjQ3NDY5NjgwMzMwOTIlMjEzZDM3LjgwMzc0NzUyMTYwNDQzJTIxMm0zJTIxMWYwJTIxMmYwJTIxM2YwJTIxM20yJTIxMWkxMDI0JTIxMmk3NjglMjE0ZjEzLjElMjEzbTMlMjExbTIlMjExczB4ODA4NTg2ZTYzMDI2MTVhMSUyNTNBMHg4NmJkMTMwMjUxNzU3YzAwJTIxMnNTdG9yZXklMkJBdmUlMjUyQyUyQlNhbiUyQkZyYW5jaXNjbyUyNTJDJTJCQ0ElMkI5NDEyOSUyMTVlMCUyMTNtMiUyMTFzZW4lMjEyc3VzJTIxNHYxNDM1ODI2NDMyMDUxJTIyJTIwd2lkdGglM0QlMjI2MDAlMjIlMjBoZWlnaHQlM0QlMjI2MDAlMjIlMjBmcmFtZWJvcmRlciUzRCUyMjAlMjIlMjBzdHlsZSUzRCUyMmJvcmRlciUzQTAlMjIlMjBhbGxvd2Z1bGxzY3JlZW4lM0UlM0MlMkZpZnJhbWUlM0U="][/vc_column][/vc_row][vc_row][vc_column width="1/2"][vc_custom_heading text="Get in touch with us " font_container="tag:h2|font_size:24|text_align:left|color:%23000000" use_theme_fonts="yes"][contact-form-7 id="76" title="Get in touch with us "][/vc_column][vc_column width="1/2" css=".vc_custom_1498717766379{margin-left: 0px !important;padding-left: 30px !important;}"][vc_custom_heading text="Contact Details" font_container="tag:h2|font_size:24|text_align:left|color:%23000000" use_theme_fonts="yes"][vc_column_text]<i class="fa fa-map-marker"></i> 198 West 21th Street, Suite 721 New York, NY 10010<i class="fa fa-phone"></i> Phone: +95 (0) 123 456 789<i class="fa fa-envelope-o"></i> <a href="mailto:nanoagency@gmail.com">nanoagency.co@gmail.com</a>[/vc_column_text][vc_single_image image="950" img_size="full"][/vc_column][/vc_row]'
            ),
            'templates-about-me' => array(
                'name' 			=> esc_html__( 'Templates About Me', 'redmag' ),
                'weight' 		=> 0,
                'custom_class'	=> '',
                'content' 		=> '[vc_row css=".vc_custom_1501777430594{margin-bottom: 30px !important;}"][vc_column][na_introduce introduce-image="958" title="Red Magazine" des="Mauris ac metus et lacus ultricies finibus. Praesent sodales mattis felis ac congue. Maecenas nisl erat, tincidunt quis pretium vel, mollis ac erat. Ut eget mauris at purus posuere luctus sit amet ut tortor. Sed lacinia condimentum augue in bibendum. Curabitur elit tortor, pulvinar et leo vitae, molestie pulvinar lorem. Etiam volutpat odio eget nisi congue, a dictum nibh laoreet. Proin at ullamcorper velit. Nullam vel metus ex. Nullam lobortis sem quis justo scelerisque scelerisque." initialize="RedMag" after_initialize=" - Magazine WordPress"][/vc_column][/vc_row][vc_row][vc_column][vc_images_carousel images="955,944,945,946,958,954,986" img_size="full" slides_per_view="3" autoplay="yes" hide_pagination_control="yes" wrap="yes"][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
<h3>Nullam mattis orci sit amet nisi scelerisque imperdiet.</h3>
Quisque molestie felis in mi laoreet dignissim. Integer condimentum, ante ac tempus hendrerit, arcu libero tincidunt ipsum, et venenatis metus nisl non lorem. Phasellus rhoncus lectus ac pretium sollicitudin. Donec vitae leo nisi. Duis tristique sem sit amet urna luctus hendrerit. Nunc imperdiet arcu id nisi ultricies, quis dignissim turpis lobortis. Donec tempus metus quis turpis fermentum, nec euismod libero rhoncus. Integer egestas semper ex quis venenatis. Suspendisse ullamcorper sapien vitae mollis dapibus.Mauris ac metus et lacus ultricies finibus. Praesent sodales mattis felis ac congue. Maecenas nisl erat, tincidunt quis pretium vel, mollis ac erat. Ut eget mauris at purus posuere luctus sit amet ut tortor. Sed lacinia condimentum augue in bibendum. Curabitur elit tortor, pulvinar et leo vitae, molestie pulvinar lorem. Etiam volutpat odio eget nisi congue, a dictum nibh laoreet. Proin at ullamcorper velit. Nullam vel metus ex. Nullam lobortis sem quis justo scelerisque scelerisque. Morbi eu diam posuere, varius dolor ac, ultrices eros. In ullamcorper varius diam vitae vehicula. Vivamus eu vehicula est, tincidunt pharetra arcu. Donec tempus imperdiet pharetra. Vestibulum sit amet est ut dolor posuere suscipit. Cras sagittis ornare aliquet.Aenean in venenatis mauris, sodales lobortis augue. Duis eu lorem id tortor finibus vestibulum ac id nisl. Pellentesque rutrum lorem et leo feugiat ultricies. Vestibulum placerat quis nisl nec sodales. Fusce quis felis mattis, scelerisque orci id, posuere enim. Sed a est gravida, facilisis tortor at, lacinia metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce ullamcorper justo et tincidunt tempus.<em>Praesent pellentesque ullamcorper ex, et dictum urna <a style="color: red;" href="https://themeforest.net/item/sumeo-blog-wordpress-themes/20234844">sed ut feugiat elit</a>.</em>[/vc_column_text][/vc_column][/vc_row]'
            ),
        );


        foreach ( array_reverse( $new_templates ) as $template ) {
            array_unshift( $default_templates, $template );
        }

        return $default_templates;
    }
    add_filter( 'vc_load_default_templates', 'redmag_vc_templates' );

}
