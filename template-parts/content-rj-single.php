<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Arya_Multipurpose
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-blog-post">
		<?php 
			arya_multipurpose_post_thumbnail(); 	
		?>
	    <div class="post-details">
	        <a href="<?php the_permalink(); ?>">
	            <h1><?php the_title(); ?></h1>
	        </a>
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'arya-multipurpose' ),
					'after'  => '</div>',
				) );

				if ( get_edit_post_link() ) :

					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'arya-multipurpose' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
				endif;
				?>
			</div><!-- .entry-content -->
	    </div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
