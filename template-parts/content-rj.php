<div class="col-md-6 mt-4">
	<div class="card profile-card-5">
		<?php if(has_post_thumbnail()): ?>
		<div class="card-img-block">
			<a href="<?php the_permalink(); ?>"><img class="card-img-top" src="<?php the_post_thumbnail_url('arya-multipurpose-thumbnail-five'); ?>" alt="<?php the_title(); ?>"></a>
		</div>
		<?php endif; ?>
		<div class="card-body pt-0">
			<a href="<?php the_permalink(); ?>"><h5 class="card-title"><?php the_title(); ?></h5></a>
			<p class="card-text"><?php echo wp_trim_words( get_the_content(), 10, '...' ); ?></p>
			<a href="<?php the_permalink(); ?>" class="btn btn-primary">View</a>
		</div>
	</div>
</div>