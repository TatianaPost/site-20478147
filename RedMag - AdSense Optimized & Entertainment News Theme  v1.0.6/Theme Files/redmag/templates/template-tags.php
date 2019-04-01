<?php
/**
 * Custom template tags for redmag
 */

if ( ! function_exists( 'redmag_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since redmag 1.0
 */
function redmag_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" >
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'redmag' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'redmag' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'redmag' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'redmag_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since redmag 1.0
 */
function redmag_entry_meta() {
	$author 	= get_theme_mod('redmag_post_meta_author',true);
	$date 		= get_theme_mod('redmag_post_meta_date',true);
	$views 		= get_theme_mod('redmag_post_meta_view',false);
	$comments 	= get_theme_mod('redmag_post_meta_comment',false);

	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post"> <i class="fa fa-bell"></i> %s</span>', esc_html__( 'Featured', 'redmag' ) );
	}

	if ( 'post' == get_post_type() && $author) {
		printf( '<span class="byline"><i class="ti-user" aria-hidden="true"></i><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
			_x( 'Author', 'Used before post author name.', 'redmag' ),

			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);

	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) && $date ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><i class="ti-alarm-clock" aria-hidden="true"></i><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'redmag' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}


	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'redmag' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}?>

	<?php if($views):?>
		<span class="total-view">
			<?php
				$count = redmag_get_PostViews(get_the_ID());
				if(empty($count)){
					$count='0';
				}
			?>
			<i class="ti-eye"></i> <?php echo esc_attr($count);?>
		</span>
	<?php endif;?>
	<?php if (! post_password_required() && ( comments_open() || get_comments_number() ) && $comments) {?>
		<span class="comments-link">
			<a href="<?php echo esc_url(comments_link());?>" class="text-comment"><i class="ti-comment" aria-hidden="true"></i> <?php comments_number( '0', '1', '%' ); ?></a>
		</span>
	<?php } ?>

<?php
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since redmag 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function redmag_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'redmag_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'redmag_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so redmag_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so redmag_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see redmag_categorized_blog()}.
 *
 * @since redmag 1.0
 */
function redmag_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'redmag_categories' );
}
add_action( 'edit_category', 'redmag_category_transient_flusher' );
add_action( 'save_post',     'redmag_category_transient_flusher' );

if ( ! function_exists( 'redmag_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since redmag 1.0
 */
function redmag_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'redmag_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since redmag 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function redmag_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'redmag_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since redmag 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function redmag_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( esc_html__( 'Continue reading %s', 'redmag' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'redmag_excerpt_more' );
endif;
