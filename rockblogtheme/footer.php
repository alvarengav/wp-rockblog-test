<footer class="footer">
	<div class="footer__top">
		<div class="footer__column footer__column--logo">
			<img class="footer__logo" src="
			<?php
			echo esc_url(
				get_template_directory_uri()
			)
			?>
			/assets/images/logo.svg" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
			<p class="footer__description">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis eros sed risus sollicitudin fringilla dictum in metus. Sed ultrices mauris a facilisis varius.
			</p>
			<div class="footer__social">
				<a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/facebook-icon.svg" alt="Facebook" class="footer__social-icon"></a>
				<a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/twitter-icon.svg" alt="Twitter" class="footer__social-icon"></a>
				<a href="#"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/instagram-icon.svg" alt="Instagram" class="footer__social-icon"></a>
			</div>
		</div>
		<div class="footer__column">
			<h3 class="footer__heading">About me</h3>
			<ul class="footer__list">
				<li class="footer__item"><a href="#">My Team</a></li>
				<li class="footer__item"><a href="#">History</a></li>
				<li class="footer__item"><a href="#">My Products</a></li>
				<li class="footer__item"><a href="#">Blogging</a></li>
			</ul>
		</div>
		<div class="footer__column">
			<h3 class="footer__heading">Resources</h3>
			<ul class="footer__list">
				<li class="footer__item"><a href="#">Webinars</a></li>
				<li class="footer__item"><a href="#">Courses</a></li>
				<li class="footer__item"><a href="#">Books</a></li>
				<li class="footer__item"><a href="#">Marketing</a></li>
			</ul>
		</div>
		<div class="footer__column">
			<h3 class="footer__heading">Contact</h3>
			<ul class="footer__list">
				<li class="footer__item"><a href="#">Privacy Policy</a></li>
				<li class="footer__item"><a href="#">Terms of use</a></li>
			</ul>
		</div>
	</div>
	<div class="footer__bottom">
		<p class="footer__copyright">Blog Rock © 2020 All Right Reserved</p>
	</div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
