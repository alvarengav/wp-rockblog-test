<?php
if ( ! function_exists( 'rockblog_meta_description' ) ) {
	function rockblog_meta_description() {
		$description = get_bloginfo( 'description' );

		echo '<meta name="description" content="' . esc_attr( $description ) . '">';
	}
}
