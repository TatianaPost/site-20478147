
    <?php if (has_tag()) { ?>
        <div class="tags-wrap">
            <span class="tags-title"> <?php esc_html_e('Tags: ','redmag')?></span>
            <span class="tags">
                <?php the_tags('', ',', ''); ?>
            </span>
        </div>
    <?php } ?>

