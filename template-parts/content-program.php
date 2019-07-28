<div class="col-md-6 mt-3">
    <div class="card">
        <div class="card-horizontal">
            <?php if(has_post_thumbnail()): ?>
            <div class="img-square-wrapper">
                <a href="<?php the_permalink(); ?>"><img class="card-img-top" src="<?php the_post_thumbnail_url('arya-multipurpose-thumbnail-five'); ?>" alt="<?php the_title(); ?>"></a>
            </div>
            <?php endif; ?>
            <div class="card-body">
                <a href="<?php the_permalink(); ?>"><h5 class="card-title"><?php the_title(); ?></h5></a>
                <p class="card-text"><?php echo wp_trim_words( get_the_content(), 25, '...' ); ?></p>
            </div>
        </div>
    </div>
</div>