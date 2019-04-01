<?php
/**
 * @package     NA Core
 * @version     0.1
 * @author      Nanoredmag
 * @link        http://nanoredmag.co
 * @copyright   Copyright (c) 2015 Nanoredmag
 * @license     GPL v2
 */
if (!class_exists('redmag_Customize')) {
    class redmag_Customize
    {
        public $customizers = array();

        public $panels = array();

        public function init()
        {
            $this->customizer();
            add_action('customize_controls_enqueue_scripts', array($this, 'redmag_customizer_script'));
            add_action('customize_register', array($this, 'redmag_register_theme_customizer'));
            add_action('customize_register', array($this, 'remove_default_customize_section'), 20);
        }

        public static function &getInstance()
        {
            static $instance;
            if (!isset($instance)) {
                $instance = new redmag_Customize();
            }
            return $instance;
        }

        protected function customizer()
        {
            $this->panels = array(

                'site_panel' => array(
                    'title'             => esc_html__('Style Setting','redmag'),
                    'description'       => esc_html__('Style Setting >','redmag'),
                    'priority'          =>  101,
                ),
                'sidebar_panel' => array(
                    'title'             => esc_html__('Sidebar','redmag'),
                    'description'       => esc_html__('Sidebar Setting','redmag'),
                    'priority'          => 103,
                ),
                'redmag_option_panel' => array(
                    'title'             => esc_html__('Option','redmag'),
                    'description'       => '',
                    'priority'          => 104,
                ),
            );

            $this->customizers = array(
                'title_tagline' => array(
                    'title' => esc_html__('Site Identity', 'redmag'),
                    'priority'  =>  1,
                    'settings' => array(
                        'redmag_logo' => array(
                            'class' => 'image',
                            'label' => esc_html__('Logo', 'redmag'),
                            'description' => esc_html__('Upload Logo Image', 'redmag'),
                            'priority' => 12
                        ),
                    )
                ),
//2.General ============================================================================================================
                'redmag_general' => array(
                    'title' => esc_html__('General', 'redmag'),
                    'description' => '',
                    'priority' => 2,
                    'settings' => array(

                        'redmag_bg_body' => array(
                            'label'         => esc_html__('Background - Body', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 2,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                        'redmag_primary_body' => array(
                            'label'         => esc_html__('Primary - Color', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 1,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                    )
                ),
//3.Header =============================================================================================================
                'redmag_header' => array(
                    'title' => esc_html__('Header', 'redmag'),
                    'description' => '',
                    'priority' => 3,
                    'settings' => array(
                        //header
                        'redmag_header_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Header', 'redmag'),
                            'priority' => 0,
                        ),

                        'redmag_header' => array(
                            'class'=> 'layout',
                            'label' => esc_html__('Header Layout', 'redmag'),
                            'priority' =>1,
                            'choices' => array(
                                'simple'                   => get_template_directory_uri().'/assets/images/header/default.png',
                                'center'                   => get_template_directory_uri().'/assets/images/header/center.png',
                                'left'                     => get_template_directory_uri().'/assets/images/header/left.png',

                            ),
                            'params' => array(
                                'default' => 'left',
                            ),
                        ),
                        
                        'redmag_keep_menu' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Keep Menu','redmag'),
                            'priority' => 2,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'redmag_bg_header' => array(
                            'label'         => esc_html__('Background - Header', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 5,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),

                        'redmag_color_menu' => array(
                            'label'         => esc_html__('Color - Text', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                    )
                ),
//4.Footer =============================================================================================================
                'redmag_new_section_footer' => array(
                    'title' => esc_html__('Footer', 'redmag'),
                    'description' => '',
                    'priority' => 4,
                    'settings' => array(
                        'redmag_footer' => array(
                            'type' => 'select',
                            'label' => esc_html__('Choose Footer Style', 'redmag'),
                            'description' => '',
                            'priority' => -1,
                            'choices' => array(
                                '1'     => esc_html__('Footer 1', 'redmag'),
                                'hidden' => esc_html__('Hidden Footer', 'redmag')
                            ),
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                        'redmag_footer_image' => array(
                            'class'         => 'image',
                            'priority'      =>2,
                            'label'         => esc_html__('Background Image', 'redmag'),
                            'params'        => array(
                                'default'   => '',
                            ),
                            'sanitize_callback' =>0,
                        ),

                        'redmag_enable_footer' => array(
                            'type' => 'checkbox',
                            'label' => esc_html__('Enable Footer', 'redmag'),
                            'description' => '',
                            'priority' => 0,
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                        'redmag_enable_copyright' => array(
                            'type' => 'checkbox',
                            'label' => esc_html__('Enable Copyright', 'redmag'),
                            'description' => '',
                            'priority' => 0,
                            'params' => array(
                                'default' => '1',
                            ),
                        ),
                        'redmag_copyright_text' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('Footer Copyright Text', 'redmag'),
                            'description' => '',
                            'priority' => 0,
                        ),

                        'redmag_bg_footer' => array(
                            'label'         => esc_html__('Background - Footer', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 5,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'redmag_color_footer' => array(
                            'label'         => esc_html__('Color - Text ', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                    )
                ),

//5.Categories Blog ====================================================================================================
                'redmag_blog' => array(
                    'title' => esc_html__('Blogs Categories', 'redmag'),
                    'description' => '',
                    'priority' => 5,
                    'settings' => array(

                        'redmag_sidebar_cat' => array(
                            'class'         => 'layout',
                            'label'         => esc_html__('Sidebar Layout', 'redmag'),
                            'priority'      =>3,
                            'choices'       => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'right'        => get_template_directory_uri().'/assets/images/right.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                            ),
                            'params' => array(
                                'default' => 'right',
                            ),
                        ),
                        'redmag_siderbar_cat_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'redmag'),
                            'description' => esc_html__( 'Please goto Appearance > Widgets > drop drag widget to the sidebar Article.', 'redmag' ),
                            'priority' => 4,
                        ),
                        //post-layout-cat
                        'redmag_title_cat_heading' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post Title Category', 'redmag'),
                            'priority' =>5,
                        ),
                        'redmag_cat_image' => array(
                            'class'         => 'image',
                            'priority'      =>6,
                            'label'         => esc_html__('Background Image', 'redmag'),
                            'params'        => array(
                                'default'   => '',
                            ),
                            'sanitize_callback' =>0,
                        ),
                        'redmag_cat_bg' => array(
                            'label'         => esc_html__('Background - Color', 'redmag'),
                            'description'   => '',
                            'class'         => 'color',
                            'priority'      => 6,
                            'params'        => array(
                                'default'   => '',
                            ),

                        ),
                        'redmag_post_title_heading' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Title Category ','redmag'),
                            'priority' => 7,
                            'params' => array(
                                'default' => true,
                            ),
                        ),

                        'redmag_post_cat_layout' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Category layout', 'redmag'),
                            'priority' =>8,
                        ),
                        'redmag_layout_cat_content' => array(
                            'class'         => 'layout',
                            'priority'      =>9,
                            'choices'       => array(
//                                'tran'        => get_template_directory_uri().'/assets/images/box-tran.jpg',
                                'grid'        => get_template_directory_uri().'/assets/images/box-grid.jpg',
                                'list'        => get_template_directory_uri().'/assets/images/box-list.jpg',
                            ),
                            'params' => array(
                                'default' => 'list',
                            ),
                        ),
                        'redmag_number_post_cat' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Number post on a row', 'redmag'),
                            'description' => '',
                            'priority' =>10,
                            'choices' => array(
                                'max' => 4,
                                'min' => 1,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' =>1
                            ),
                        ),

                        //post meta
                        'redmag_cat_meta' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Post meta', 'redmag'),
                            'priority' =>13,
                        ),
                        'redmag_post_meta_share' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share ','redmag'),
                            'priority' => 14,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_post_meta_author' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Author ','redmag'),
                            'priority' => 15,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'redmag_post_meta_date' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Date ','redmag'),
                            'priority' => 16,
                            'params' => array(
                                'default' => true,
                            ),
                        ),
                        'redmag_post_meta_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Comment ','redmag'),
                            'priority' => 17,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_post_meta_view' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('View ','redmag'),
                            'priority' => 18,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    ),
                ),
//6.Single blog ========================================================================================================
                'redmag_blog_single' => array(
                    'title' => esc_html__('Blog Single', 'redmag'),
                    'description' => '',
                    'priority' => 6,
                    'settings' => array(
                        'redmag_sidebar_single' => array(
                            'class'         => 'layout',
                            'label'         => esc_html__('Sidebar Layout', 'redmag'),
                            'priority'      =>13,
                            'choices'       => array(
                                'left'         => get_template_directory_uri().'/assets/images/left.png',
                                'right'        => get_template_directory_uri().'/assets/images/right.png',
                                'full'         => get_template_directory_uri().'/assets/images/full.png',
                            ),
                            'params' => array(
                                'default' => 'right',
                            ),
                        ),

                        'redmag_siderbar_single_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'redmag'),
                            'description' => esc_html__('Please goto Appearance > Widgets > drop drag widget to the sidebar Blog.', 'redmag' ),
                            'priority' => 14,
                        ),
                        //layout
                        'redmag_single_own' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Use Single sidebar','redmag'),
                            'priority' => 15,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_single_own_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'redmag'),
                            'description' => esc_html__( 'When you activate the single page will use sidebar Single  independently. Please goto Appearance > Widgets > drop drag widget to the sidebar Single.', 'redmag' ),
                            'priority' => 16,
                        ),
                        //single top
                        'redmag_single_top' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Enable/Disable Top Single ', 'redmag'),
                            'priority' =>19,
                        ),

                        //share
                        'redmag_single_share' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Share', 'redmag'),
                            'priority' =>19,
                        ),
                        'redmag_share_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Facebook  ','redmag'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_share_twitter' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Twitter  ','redmag'),
                            'priority' => 22,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_share_google' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Google  ','redmag'),
                            'priority' => 23,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'redmag_share_linkedin' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Linkedin  ','redmag'),
                            'priority' => 24,
                            'params' => array(
                                'default' => false,
                            ),
                        ),

                        'redmag_share_pinterest' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Share Pinterest  ','redmag'),
                            'priority' => 25,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        //comments
                        'redmag_single_comments' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Comments', 'redmag'),
                            'priority' =>28,
                        ),
                        'redmag_comments_single_facebook' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Enable Facebook Comments ','redmag'),
                            'priority' => 29,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_comments_single' => array(
                            'type'          => 'text',
                            'label'         => esc_html__('Your app id :', 'redmag'),
                            'priority'      => 30,
                            'params'        => array(
                                'default'   => '',
                            ),
                        ),
                        'redmag_comments_single_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'redmag'),
                            'description' => esc_html__('If you want show notification on  your facebook , please input app id ...', 'redmag' ),
                            'priority' => 31,
                        ),
                    ),
                ),
//7.Adsense blog ========================================================================================================
                'redmag_ads' => array(
                    'title' => esc_html__('Adsense Setting', 'redmag'),
                    'description' => '',
                    'priority' => 7,
                    'settings' => array(

                        'redmag_ads_rectangle' => array(
                            'type' => 'textarea',
                            'label' => esc_html__(' ADS Size: Large Rectangle', 'redmag'),
                            'description' => '',
                            'priority' => 1,
                        ),
                        'redmag_ads_rectangle_info' => array(
                            'class' => 'info',
                            'label' => esc_html__('Info', 'redmag'),
                            'description' => esc_html__('Add code adsbygoogle with the size is: 250x360,336x280 ,300x250 ...', 'redmag' ),
                            'priority' => 2,
                        ),
                        'redmag_ads_leaderboard' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('ADS Size: Leaderboard', 'redmag'),
                            'description' => 'Add code adsbygoogle with the size is: 468x60 ,728x90, 920x180 ...',
                            'priority' => 3,
                        ),
                        'redmag_heading_ads_single' => array(
                            'class' => 'heading',
                            'label' => esc_html__('Single', 'redmag'),
                            'priority' =>20,
                        ),
                        'redmag_ads_single_article' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ads at the end of the article ','redmag'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                        'redmag_ads_single_comment' => array(
                            'class' => 'toggle',
                            'label' => esc_html__('Ads at the top of the Comment ','redmag'),
                            'priority' => 21,
                            'params' => array(
                                'default' => false,
                            ),
                        ),
                    )
                ),
//Font   ===============================================================================================================
                'redmag_new_section_font_size' => array(
                    'title' => esc_html__('Font', 'redmag'),
                    'priority' => 8,
                    'settings' => array(
                        'redmag_body_font_google' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Use Google Font', 'redmag'),
                            'choices'       => redmag_googlefont(),
                            'priority'      => 0,
                            'params'        => array(
                                'default'       => 'Poppins',
                            ),

                        ),
                        'redmag_body_font_size' => array(
                            'class' => 'slider',
                            'label' => esc_html__('Font size ', 'redmag'),
                            'description' => '',
                            'priority' =>8,
                            'choices' => array(
                                'max' => 30,
                                'min' => 10,
                                'step' => 1
                            ),
                            'params'      => array(
                                'default' => 14,
                            ),
                        ),
                        'redmag_title_font_google' => array(
                            'type'          => 'select',
                            'label'         => esc_html__('Title Font', 'redmag'),
                            'choices'       => redmag_googlefont(),
                            'priority'      => 9,
                            'params'        => array(
                                'default'       => 'Oswald',
                            ),
                        )
                    )
                ),
//Style  ===============================================================================================================


            );
        }

        public function redmag_customizer_script()
        {
            // Register
            wp_enqueue_style('na-customize', get_template_directory_uri() . '/inc/customize/assets/css/customizer.css', array(),null);
            wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/inc/customize/assets/css/jquery-ui.min.css', array(),null);
            wp_enqueue_script('na-customize', get_template_directory_uri() . '/inc/customize/assets/js/customizer.js', array('jquery'), null, true);
        }

        public function add_customize($customizers) {
            $this->customizers = array_merge($this->customizers, $customizers);
        }


        public function redmag_register_theme_customizer()
        {
            global $wp_customize;

            foreach ($this->customizers as $section => $section_params) {

                //add section
                $wp_customize->add_section($section, $section_params);
                if (isset($section_params['settings']) && count($section_params['settings']) > 0) {
                    foreach ($section_params['settings'] as $setting => $params) {

                        //add setting
                        $setting_params = array();
                        if (isset($params['params'])) {
                            $setting_params = $params['params'];
                            unset($params['params']);
                        }
                        $wp_customize->add_setting($setting, array_merge( array( 'sanitize_callback' => null ), $setting_params));
                        //Get class control
                        $class = 'WP_Customize_Control';
                        if (isset($params['class']) && !empty($params['class'])) {
                            $class = 'WP_Customize_' . ucfirst($params['class']) . '_Control';
                            unset($params['class']);
                        }

                        //add params section and settings
                        $params['section'] = $section;
                        $params['settings'] = $setting;

                        //add controll
                        $wp_customize->add_control(
                            new $class($wp_customize, $setting, $params)
                        );
                    }
                }
            }

            foreach($this->panels as $key => $panel){
                $wp_customize->add_panel($key, $panel);
            }

            return;
        }

        public function remove_default_customize_section()
        {
            global $wp_customize;
//            // Remove Sections
//            $wp_customize->remove_section('title_tagline');
            $wp_customize->remove_section('header_image');
            $wp_customize->remove_section('nav');
            $wp_customize->remove_section('static_front_page');
            $wp_customize->remove_section('colors');
            $wp_customize->remove_section('background_image');
        }
    }
}