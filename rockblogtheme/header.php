<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php rockblog_meta_description(); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="header">
		<nav class="header__nav">
			<a class="header__brand" href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="header__logo">
			</a>
			<button class="header__toggle" id="menu-toggle">
				<span class="header__icon">☰</span>
			</button>
			<div class="header__menu" id="header__menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'header__menu-list',
						'fallback_cb'    => '__return_false',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'          => 2,
						'walker'         => '',
						'add_li_class'   => 'header__menu-item',
						'add_a_class'    => 'header__menu-link',
					)
				);
				?>
				<div class="header__search">
					<button class="header__search-toggle" id="search-toggle">
						<?php
						// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo get_inline_svg( get_template_directory() . '/assets/images/search-icon.svg' );
						?>
					</button>
					<form class="header__search-form" id="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="search" class="header__search-input" name="s" placeholder="Search...">
					</form>
				</div>
			</div>
		</nav>
	</header>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
</body>

</html>
