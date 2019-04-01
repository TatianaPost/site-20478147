<div class="entry_pagination">
	<div class="post-pagination pagination clearfix">

		<?php
		$prev_post = get_previous_post();
		$next_post = get_next_post();
		?>

		<?php if (!empty( $prev_post )) : ?>
			<a class="page-numbers pull-left page-prev" title="prev post" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
				<span class="btn-prev"><?php esc_html_e('Preview post','redmag')?></span>
				<p class="title-pagination"><?php echo esc_attr($prev_post->post_title); ?></p>
			</a>
		<?php endif; ?>

		<?php if (!empty( $next_post )) : ?>
			<a class="page-numbers pull-right page-next" title="next post" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
				<span class="btn-next"><?php esc_html_e('Next post','redmag')?></span>
				<i class="fa fa-arrow-right" aria-hidden="true"></i>
				<p class="title-pagination"><?php echo esc_attr($next_post->post_title); ?></p>
			</a>
		<?php endif; ?>

	</div>
</div>