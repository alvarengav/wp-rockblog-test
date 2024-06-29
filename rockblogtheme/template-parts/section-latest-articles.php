<section class="latest-articles">
	<h2 class="latest-articles__title">Latest Articles</h2>
	<div class="latest-articles__grid">
		<?php
		$args = array(
			'post_type'      => 'cpt-article',
			'posts_per_page' => 4,
		);

		$query = new WP_Query( $args );
		// TODO: Add the author's image and validate if it is the default Gravatar image to display the custom one or the user's image
		$default_avatar_url = get_inline_svg( get_template_directory() . '/assets/images/author-avatar-icon.svg', 'latest-articles__author-avatar' );

		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) :
				$query->the_post();
				$author_id  = get_the_author_meta( 'ID' );
				$avatar_url = get_avatar_url( $author_id );
				?>
				<article class="latest-articles__item">
					<div class="latest-articles__image-wrapper">
						<div class="latest-articles__image-backdrop"></div>
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'medium', array( 'class' => 'latest-articles__image' ) ); ?>
							<?php
						else :
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo get_inline_svg( get_template_directory() . '/assets/images/photo-icon.svg', 'latest-articles__image latest-articles__image--no-thumbnail' );
						endif;
						?>
					</div>
					<div class="latest-articles__content">
						<span class="latest-articles__tag"><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></span>
						<h3 class="latest-articles__heading">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<p class="latest-articles__date">
							Added: <?php echo esc_html( get_the_date() ); ?>
							<span class="latest-articles__comments">
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/comments-icon.svg" alt="Comments" class="latest-articles__comments-icon">
								<?php echo esc_html( get_comments_number() ); ?>
							</span>
						</p>
						<p class="latest-articles__excerpt"><?php the_excerpt(); ?></p>
						<div class="latest-articles__author">
							<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo $default_avatar_url;
							?>
							<span class="latest-articles__author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></span>
						</div>
					</div>
				</article>
				<?php
			endwhile;
			wp_reset_postdata();
		else :
			?>
			<p><?php esc_html_e( 'No articles found.', 'textdomain' ); ?></p>
		<?php endif; ?>
	</div>
</section>
