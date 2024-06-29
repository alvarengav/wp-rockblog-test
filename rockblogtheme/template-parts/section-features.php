<section class="features">
	<?php
	$article_slugs = array( 'fully-responsive', 'easily-customizable', 'seo-friendly' );

	$args = array(
		'post_type'      => 'cpt-article',
		'posts_per_page' => 3,
		'post_name__in'  => $article_slugs,
		'orderby'        => 'post__in',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post();
			$slug = get_post_field( 'post_name', get_post() );
			$icon = '';
			switch ( $slug ) {
				case 'fully-responsive':
					$icon = 'expand-icon.svg';
					break;
				case 'easily-customizable':
					$icon = 'search-white-icon.svg';
					break;
				case 'seo-friendly':
					$icon = 'map-marker-icon.svg';
					break;
			}
			?>
		<div class="features__item">
		<div class="features__icon-wrapper">
			<?php
 			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo get_inline_svg( get_template_directory() . '/assets/images/' . $icon, 'features__icon' );
			?>
		</div>
		<h3 class="features__title"><?php the_title(); ?></h3>
		<p class="features__description">
			<?php the_excerpt(); ?>
		</p>
		<a href="<?php the_permalink(); ?>" class="features__button">Read Articles</a>
		</div>
			<?php
	endwhile;
		wp_reset_postdata();
	else :
		?>
	<p><?php esc_html_e( 'No articles found.', 'textdomain' ); ?></p>
	<?php endif; ?>
</section>
