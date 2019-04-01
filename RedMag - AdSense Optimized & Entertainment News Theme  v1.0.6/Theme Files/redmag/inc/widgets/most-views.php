<?php
/**
 * @package     redmag
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */
class redmag_most_views extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'redmag_most_views',__('+NA: Most Views','redmag'),
            array('description'=>__(' Most Views post for last week , month', 'redmag'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $posts = $instance['posts'];
        $dates = $instance['dates'];
        $title = apply_filters('widget_title', $instance['title']);

            echo ent2ncr($args['before_widget']);
            if($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
            }
            ?>
            <div class="most-views-content">
                <?php
                $popular_posts = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'post_status'    => 'publish',
                        'posts_per_page' => $posts,
                        'meta_key'       => 'post_views_count',
                        'orderby'       =>'meta_value_num',
                        'order'         =>'DESC',
                        'date_query' => array( array( 'after' =>  $dates ) ),
                    )
                );
                $j=1;
                if($popular_posts->have_posts()):
                    ?>
                    <div class="post-widget archive-blog posts-listing">
                        <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                            <?php if ($j==1){?>
                                <?php get_template_part( 'templates/layout/content-grid'); ?>
                            <?php }
                            else { ?>
                                <?php get_template_part( 'templates/layout/content-sidebar'); ?>
                            <?php } ?>
                            <?php  $j++; endwhile;   wp_reset_postdata();?>
                    </div>
                <?php endif; ?>
            </div>

        <?php
        echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title'       =>  esc_html__('Most Views','redmag'),
            'posts'       => 3,
            'dates'       => '-2 year',
        ));
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <strong><?php esc_html_e('Title', 'redmag') ?>:</strong>
            </label>
        </p>

        <p>
                <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php if (isset($instance['title'])) echo esc_attr($instance['title']); ?>"/>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts')); ?>"><?php echo esc_html__('Number of Most Views posts:', 'redmag' ); ?></label>
        </p>
        <p>
            <input class="widefat" type="text"  id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('dates')); ?>">
                <strong><?php esc_html_e('Most popular post for', 'redmag') ?>:</strong>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('dates')); ?>">
                    <option
                        value="-1 days"<?php echo (isset($instance['dates']) && $instance['dates'] == '-1 week') ? ' selected="selected"' : '' ?>><?php esc_html_e('Last Week', 'redmag') ?></option>
                    <option
                        value="-2 week"<?php echo (isset($instance['dates']) && $instance['dates'] == '-2 week') ? ' selected="selected"' : '' ?>><?php esc_html_e('Two Weeks ago', 'redmag') ?></option>
                    <option
                        value="-1 month"<?php echo (isset($instance['dates']) && $instance['dates'] == '-1 month') ? ' selected="selected"' : '' ?>><?php esc_html_e('Last Month', 'redmag') ?></option>
                    <option
                        value="-2 year"<?php echo (isset($instance['dates']) && $instance['dates'] == '-2 year') ? ' selected="selected"' : '' ?>><?php esc_html_e('Last Years', 'redmag') ?></option>
                </select>
            </label>
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['posts'] = $new_instance['posts'];
        $instance['dates'] = $new_instance['dates'];
        return $instance;

    }
}
function redmag_most_views(){
    register_widget('redmag_most_views');
}
add_action('widgets_init','redmag_most_views');
